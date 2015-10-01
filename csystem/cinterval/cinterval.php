<?php
//------------------------------------------------------------------------------
// name: cinterval.php
// desc: defines an iterval object that forms the foundation for cthread class 
//------------------------------------------------------------------------------

// headers
include_json_memory( "cinterval", dirname(__FILE__) . "/cinterval.json" );
include_event( "oncinterval", "CInterval::onCInterval" );
include_file( "cfile", dirname(__FILE__) . "/cfile.txt", "w" );
//include_database_memory( "cinterval" );

//----------------------------------------------------------
// name: CInterval
// desc: 
//----------------------------------------------------------
class CInterval{
	// members
	protected $m_iid;			// stores the id of the interval
	protected $m_fncallback;	// stores the function to call when the interval expires
	protected $m_iinterval;		// stores the interval elasped time
	protected $m_istarttime;	// stores the this interval started
	protected $m_itimeout;		// stores the timeout value in seconds
	protected $m_object;				// stores the object to bind callback function
	protected $m_iintervalstarttime;  	// stores the time when the interval first started
	
	// constructor, creation
	public function CInterval(){ 
		$this->m_fncallback = ""; 
		$this->m_iinterval 	= 0; 
		$this->m_iid 		= -1; 
		$this->m_istarttime = -1; 
		$this->m_itimeout 	= 1;
		$this->m_iintervalstarttime = -1;
		$this->m_object 	= NULL; 
	} // end CInterval()
	
	public function getID(){
		return $this->m_iid;
	} // end getID()
	
	public function create( $strfncallback, 	// callback
							$iinterval, 		// time in milliseconds
							$binterval=false, 	// interval="true" timeout="false"
							$object=NULL, 		// object to bind to function
							$itimeout=10 ){ 	// time to run the method on the server, default 10 seconds if 
												// you think the method takes longer use a larger time
		if( $strfncallback == "" || $iinterval < 1 || function_exists( $strfncallback ) == false )
			return false;
		$this->m_fncallback = $strfncallback;
		$this->m_iinterval 	= $iinterval;
		$this->m_iid 		= getTimeInMilliseconds()*0.1; 
		$this->m_istarttime = getTimeInMilliseconds();
		$this->m_iintervalstarttime = $this->m_istarttime;
		$this->m_binterval	= $binterval;
		$this->m_object 	= $object;
		$this->m_itimeout	= $itimeout;	// set the amount of time to execute on the server 
		if( ( $cvar = newvar("cinterval","cinterval_".$this->m_iid,$this,"") ) == NULL )
			return false;
		$params["intervalid"]=$this->m_iid;
		$params = CEvent :: fire_async( "oncinterval", $params ); 
		return true; 
	} // end create()
	
	public function destroy(){
		if( ($cvar = getvar("cinterval","cinterval_".$this->m_iid )) == NULL )
			return false;
		delvar($cvar);
		return true;		
	} // end destroy()
	
	public function run(){		
		$callback = $this->m_fncallback;
		if( $callback == "" ) // check callback
			return false;
		if( $this->m_object ) // bind the object to the callback
			$callback = bind( $callback, $this->m_object );		
		set_time_limit($this->m_itimeout);	// set the timelimit for this interval to execute
		while( true ){
			$icurtime = getTimeInMilliseconds();
			$elaspedintervaltime = ($icurtime - $this->m_iintervalstarttime);
			$elaspedtime = ($icurtime - $this->m_istarttime);
			if( ( $elaspedintervaltime ) >= ($this->m_itimeout-1)*1000 )
				break;
			if( ( $elaspedtime ) <= $this->m_iinterval )
				continue;
			if( ($cvar = getvar("cinterval","cinterval_".$this->m_iid)) == NULL )
				break;
			call_user_func( $callback );
			if( $this->m_binterval == false ) 
				break;	
			$this->m_istarttime = getCurrentTimeInMilliseconds();
		} // end while()
		return true;
	} // end run()
	
	public static function onCInterval( $params ){	
		if( $params && isset( $params["intervalid"] ) == false )
			return false;	
		$memory = use_memory( "cinterval" );
		use_file("cfile")->println( "Before CInterval Contents: " . $memory->toString() );
		$intervalid = $params["intervalid"];
		$cvar = getvar("cinterval","cinterval_".$intervalid);
		if( $cvar == NULL || ($cinterval = $cvar->_()) == NULL )
			return false;
		$cinterval->run();
		$cinterval->destroy();
		use_file("cfile")->println( "After CInterval Contents: " . $memory->toString() );
		return true;
	} // end onCInterval()
} // end CInterval

function setInterval( $strfncallback, $iintervalms, $object=NULL, $itimeout=10 ){ 
	return ( ( $cinterval = new CInterval() ) != NULL && $cinterval->create( $strfncallback, $iintervalms, true, $object, $itimeout ) == true ) ? $cinterval->getID() : -1; 
} // end setInterval()

function clearInterval( $cinterval ){ 
	return $cinterval->destroy();
} // end clearInterval()

function setTimeout( $strfncallback, $iintervalms, $object=NULL, $itimeout=10 ){ 
	return ( ( $cinterval = new CInterval() ) != NULL && $cinterval->create( $strfncallback, $iintervalms, false, $object, $itimeout ) == true ) ? $cinterval->getID() : -1; 
} // end setTimeout()

function clearTimeout( $cinterval ){ 
	return $cinterval->destroy();
} // end clearTimeout()
?>