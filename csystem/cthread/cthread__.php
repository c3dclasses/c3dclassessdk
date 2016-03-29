<?php
//-----------------------------------------------------------
// name: cthread.php
// desc: defines a php version of the cthread object
//-----------------------------------------------------------

// includes
include_js( relname( __FILE__ ) . "/cthread.js" ); 
//$cthread_run = function(){ if( $this->m_fncallback != NULL ) $this->m_fncallback(); };

//--------------------------------------------------------
// name: CThread
// desc: defines the cthread class
//--------------------------------------------------------
class CThread{
	protected $m_iid=-1;
	protected $m_iintervalid = -1; 
	protected $m_iintervalms = 0; 
	protected $m_fncallback = null; 
	protected $m_iexitcode = 0; 
	protected $m_fnlock = null;
	protected $m_objcontext = null;
		
	public function CThread(){
		$this->m_iid=-1;
		$this->m_iintervalid = -1; 
		$this->m_iintervalms = 0; 
		$this->m_fncallback = NULL; 
		$this->m_iexitcode = 0; 
		$this->m_fnlock = NULL;
		$this->m_objcontext = NULL;	
	} // end CThread
	
	public function create( $iintervalms, $fncallback ){
		if( $iintervalms < 1 || $fncallback == NULL /*|| function_exists( $fncallback )*/ )//gettype( $fncallback ) != "function" ) 
			return false;
		$this->m_fncallback = bind( $fncallback, $this );
		$this->m_iintervalms = $iintervalms;
		//CThread :: createContext( $this );
		return true;
	} // end create()
	
	public function context(){ 
		return $this->m_objcontext; 
	} // end context()
	public function destroy( $iexitcode ){ 
		/*CThread::destroyContext($this);*/ 
		$this->exit( iexitcode ); 
		$this->initialize(); 
	} // end destroy()
	public function start(){ 
		global $cthread_run; 
		return ($this->m_iintervalid=setInterval(bind($cthread_run, $this),$this->m_iintervalms))>-1; 
	} // end start()
	public function stop(){ 
		if( $this->m_iintervalid > -1 ) 
			clearInterval( $this->m_iintervalid ); 
		$this->m_iintervalid=-1; 
	} // end stop()
	public function run(){ 
		/*CThread::runContext( $this );*/ 
		if( $this->m_fncallback != null ) 
			$this->m_fncallback(); 
	} // end run()
	/*public function _exit( $iexitcode ){ 
		if( $this->m_iintervalid > -1 ) 
			clearInterval( $this->m_iintervalid ); 
		if( $iexitcode ) 
			$this->m_iexitcode = $iexitcode; 
		$this->unlock() 
	} // end_exit()*/
	public function jump( $fncallback ){ 
		$this->m_fncallback = bind( fncallback, $this ); 
	} // end jump()
	public function priority( $ipriority ){
	} // end priority()
	public function _sleep( $iintervalms ){ 
		$this->m_iintervalms = $iintervalms; 
		$this->stop(); 
		$this->start(); 
	} // end_sleep()
} // end CThread
/*
function setInterval( $fncallback, $iintervalms, $object=NULL, $itimeout=10 ){ 
	include_once( "cinterval.php" ); 
	return CInterval :: sendRequest( $fncallback, $iintervalms, true, $object, $itimeout ); 
} // end setInterval()

function clearInterval( $intervalid ){ 
	include_once( "cinterval.php" ); 
	return CInterval :: clearRequest( $intervalid ); 
} // end clearInterval()

function setTimeout( $fncallback, $iintervalms, $object=NULL, $itimeout=10 ){ 
	include_once( "cinterval.php" ); 
	return CInterval :: sendRequest( $fncallback, $iintervalms, false, $object, $itimeout ); 
} // end setTimeout()

function clearTimeout( $intervalid ){ 
	include_once( "cinterval.php" ); 
	return CInterval :: clearRequest( $intervalid ); 
} // end clearTimeout()
*/
?>