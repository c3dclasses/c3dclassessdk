<?php
//------------------------------------------------------------------------------
// name: cinterval.php
// desc: defines an iterval object that forms the foundation for cthread class 
//------------------------------------------------------------------------------

// headers
include_once( dirname( dirname( dirname(__FILE__) ) ) . "/c3dclassessdk.php" );
include_json_memory( "cinterval", dirname(__FILE__) . "/cinterval.json" );

//----------------------------------------------------------
// name: CInterval
// desc: 
//----------------------------------------------------------
class CInterval{
	// members
	protected $m_fncallback;	// stores the function to call when the interval expires
	protected $m_iid;			// stores the id of the interval
	protected $m_iinterval;		// stores the interval elasped time
	protected $m_istarttime;	// stores the this interval started
	protected $m_itimeout;		// stores the timeout value in seconds
	protected $m_iintervalstarttime;  // stores the time when the interval first started
	protected $m_object;		// stores the object to bind callback function
	
	// constructor
	public function CInterval(){ 
		$this->m_fncallback = ""; 
		$this->m_iinterval 	= 0; 
		$this->m_iid = -1; 
		$this->m_istarttime 	= -1; 
		$this->m_itimeout = 1;
		$this->m_iintervalstarttime = -1;
		$this->m_object = NULL; 
	} // end CInterval()
	
	public function create( $strfncallback, $iinterval, $binterval=false, $object=NULL, $itimeout=10 ){
		if( $strfncallback == "" || $iinterval < 1 ||
			( $strfncallback = functionToString( $strfncallback ) ) == "" )
			return false;

		$this->m_fncallback = $strfncallback;
		$this->m_iinterval 	= $iinterval;
		$this->m_iid 		= getCurrentTimeMS()*0.1; 
		$this->m_istarttime = getCurrentTimeMS();
		$this->m_iintervalstarttime = $this->m_istarttime;
		$this->m_binterval	= $binterval;
		$this->m_object 	= $object;
		$this->m_itimeout	= $itimeout;
		
		if( ( $cvar = newvar("cinterval","cinterval_{$this->m_iid}",$this,"") ) == NULL )
			return false;

		$strrequest = absname( __FILE__ ) . "/" . basename( __FILE__ ) . "?intervalid={$this->m_iid}&init=true";
		
		if( ($ch = curl_init()) == NULL ){	
			delvar( $cvar );
			return false;
		} // end if
	
		curl_setopt($ch, CURLOPT_URL, $strrequest);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 1);
		$str = curl_exec($ch);
		
		if( strpos( $str, "SUCCESS" ) < 0 ){
			delvar( $cvar );
			return false;
		} // end if
		
		curl_close($ch);
		
		return true; 
	} // end create()
	
	public function setTimeout( $itimeout ){
		return $this->m_itimeout = $itimeout;
	} // end setTimeout()
		
	public function getID(){ 
		return $this->m_iid; 
	} // end getID()	
	
	public function run(){
		
		// set up the function to call
		if( $this->m_fncallback != "" && ( $callback = stringToFunction( $this->m_fncallback ) ) != NULL ){
			if( $this->m_object )
				$callback = bind( $callback, $this->m_object );
		} // end if
		else return false;
		
		// set the timelimit for this interval to execute
		set_time_limit($this->m_itimeout);
		
		while( true ){
			$elaspedintervaltime = (getCurrentTimeMS() - $this->m_iintervalstarttime);
			$elaspedtime = (getCurrentTimeMS() - $this->m_istarttime);
			if( ( $elaspedintervaltime ) >= ($this->m_itimeout-1)*1000 )
				break;
			if( ( $elaspedtime ) <= $this->m_iinterval )
				continue;
			if( ($cvar = getvar("cinterval","cinterval_".$this->m_iid)) == NULL )
				break;
			$callback();
			if( $this->m_binterval == false ) 
				break;	
			$this->m_istarttime = getCurrentTimeMS();
		} // end while()
		return true;
	} // end run()
	
	static function sendRequest( $strfncallback, $iinterval, $binterval=false, $object=NULL, $itimeout=10 ){ 
		return ( ( $cinterval = new CInterval() ) != NULL && $cinterval->create( $strfncallback, $iinterval, $binterval, $object, $itimeout ) == true ) ? $cinterval->getID() : -1; 
	} // sendRequest()
	
	static function recieveRequest(){	
		if( isset( $_REQUEST["intervalid"] ) == false && isset( $_REQUEST["init"] ) == false )
			return false;	
		$intervalid = $_REQUEST["intervalid"];
		$cvar = getvar("cinterval","cinterval_".$intervalid);
		if( $cvar == NULL || ($cinterval = $cvar->_()) == NULL ){
			return false;
		} // end if
		$cinterval->run();
		delvar($cvar);
		return true;
	} // end recieveRequest()
	
	static function clearRequest( $iintervalid ){
		if( ($cvar = getvar("cinterval","cinterval_".$iintervalid )) == NULL )
			return false;
		$cinterval = $cvar->_();
		delvar($cvar);
		return true;		
	} // end clearRequest()
} // end CInterval

CInterval :: recieveRequest();
?>