<?php
//-----------------------------------------------------------
// name: cthread.php
// desc: defines a php version of the cthread object
//-----------------------------------------------------------

// includes
include_js( relname( __FILE__ ) . "/cthread.js" ); 

//--------------------------------------------------------
// name: CThread
// desc: defines the cthread class
//--------------------------------------------------------
class CThread {
	// members
	public $m_iid;
	protected $m_iintervalid; 
	protected $m_iintervalms; 
	protected $m_cfunction;
	protected $m_function; 
	protected $m_iexitcode; 
	protected $m_fnlock;
	protected $m_objcontext;
	protected $m_iteration;
	
	public function CThread() {
		$this->initialize();
	} // end CThread()
	
	public function create( $iintervalms, $cfunction ){
		if($iintervalms < 1 || !CFunction :: isACFunction($cfunction)) 
			return false;
		$this->m_cfunction = $cfunction;
		$this->m_function = $cfunction->bind($this);
		$this->m_iintervalms = $iintervalms;
		$this->createContext();
		return true;
	} // end create()

	public function destroy( $iexitcode=0 ){ 
		$this->_exit( $iexitcode );
		//$this->destroyContext(); 
		//$this->initialize(); 
	} // end destroy()
	
	public function start() { 
		return ($this->m_iintervalid=setInterval(bind($this->run(),$this),$this->m_iintervalms)); 
	} // end start()
	
	public function stop() { 
		if($this->m_iintervalid)
			clearInterval($this->m_iintervalid); 
		$this->m_iintervalid=NULL; 
	} // end stop()
	
	protected function run() { 
		return function() {
			if(!$this->m_function){
				return;
			}
			
			$function = $this->m_function;
			$function();
			
			//$this->runContext();
			//$this->m_cfunction->_(); 
			printbr("running callback");
			$this->m_iteration++;
		}; // end function()
	} // end run()
	
	public function _exit($iexitcode=0) { 
		$this->stop();
		if($iexitcode) 
			$this->m_iexitcode = $iexitcode; 
		$this->unlock(); 
	} // end _exit()
	
	public function jump($cfunction) { 
		if(!CFunction :: isACFunction($cfunction))
			return false;
		//$this->m_cfunction = $cfunction->bind($this); 
		$this->m_cfunction = $cfunction;
		$this->m_function = $cfunction->bind($this); 
		return true;
	} // end jump()
	
	public function priority($ipriority) {
	} // end priority()
	
	public function _sleep($iintervalms) { 
		$this->m_iintervalms = $iintervalms; 
		$this->stop(); 
		$this->start();
 	} // end _sleep()
	
	public function _wait(){
		if( $this->m_childthreadcount == 0 )
			$this->_exit( 0 );
	} // end _wait()
	
	public function lock ( $fnlock ){ 
		if( $fnlock == NULL ) 
			return true; 
		if( !isset($fnlock->cthread) ){ // no thread has a lock on this function
			$fnlock->cthread = $this;
			$this->m_fnlock = $fnlock;
		} // end if
		if( $fnlock->cthread == $this )
			return true;
		return false;
	} // end lock()
	
	public function unlock (){
		$fnunlock = $this->m_fnlock;
		if( $fnunlock == NULL && !isset($fnunlock->cthread) )
			return true;
		if( $fnunlock->cthread != $this )
			return false;
		$fnunlock->cthread = NULL;
		unset($fnunlock->cthread);
		$this->m_fnlock = NULL;
		return true;
	} // end unlock()
	
	protected function initialize() {
		$this->m_iid = -1;
		$this->m_iintervalid = NULL; 
		$this->m_iintervalms = 0; 
		$this->m_cfunction = NULL; 
		$this->m_function = NULL; 
		$this->m_iexitcode = 0; 
		$this->m_fnlock = NULL;
		$this->m_objcontext = NULL;
		$this->m_iteration = 0;
	} // end initialize()
	
	public function getExitCode (){ return $this->m_iexitcode; }
	public function getID (){ return $this->m_iid; }
	public function getIteration (){ return $this->m_iteration; }
	public function context() { return $this->m_objcontext; } 
	
	//-----------------------------------------------------
	// name: ClassMethods
	// desc: stores all the static members and methods
	//-----------------------------------------------------
	
	// class members
	protected static $m_cthread_cur 	= NULL;			// current thread that's running
	protected static $m_objcontext_cur 	= NULL;			// current context the thread is running
	protected static $m_fncontext_cur 	= NULL;			// current function the thread is running
	protected static $m_icthread_count 	= 0;			// the number of threads that are currently running
	protected static $m_icthread_id_counter = 0;		// generates an id for each thread created
	
	public function loadContext( $objcontext, $fncontext ){
		if( !$objcontext || !$fncontext )
			return false;
		$objcontext->m_icthread_count = 0; // set the cthread count to 0 - haven't found no thread yet
		CThread :: $m_objcontext_cur = objcontext;	// make this object context be the current object context	
		fncontext(); // run the function to find thread that have started with code	
		CThread :: $m_objcontext_cur=NULL;	// set this to NULL for next time 
		return true;
	} // end loadContext()
	
	protected function createContext(){
		$this->m_iid = CThread :: $m_icthread_id_counter;
		CThread :: $m_icthread_count++;
		CThread :: $m_icthread_id_counter++;
		
		$objcontext = NULL; // get the current object context - what object does this thread belong to?
		if( CThread :: $m_objcontext_cur ) // check the current object
			$objcontext = CThread :: $m_objcontext_cur;	
		else if( CThread :: $m_cthread_cur && CThread :: $m_cthread_cur.m_objcontext ) // check the thread's current object
			$objcontext = CThread :: $m_cthread_cur.m_objcontext;
		
		if($objcontext) {	// if we have an object
			$this->m_objcontext->m_icthread_count++; // update this object's thread count
			$cthread->m_objcontext = objcontext;	 // make this thread point to that object
		} // end if
		
		return true;
	} // end createCreate()
	
	public function destroyContext(){
		CThread :: $m_icthread_count--;
		if(CThread :: $m_cthread_cur == $this)
			CThread :: $m_cthread_cur = NULL;
		if(!$this->m_objcontext)
			return true;	
		$objcontext = $this->m_objcontext;	// update the object that runs the thread 
		$this->m_objcontext = NULL;
		return ( $objcontext->m_icthread_count && --$objcontext->m_icthread_count > 0 );
	} // end destroyContext()
	
	public function runContext(){
		CThread :: $m_cthread_cur = $this;
		if(CThread :: $m_fncontext_cur)
			CThread :: $m_fncontext_cur($this);
	} // end runContext()			
	
	public static function getCurrentCThread(){ return CThread :: $m_cthread_cur; }
	public static function getCThreadCount(){ return CThread :: $m_icthread_count; }
	public static function getCThreadIDCounter(){ return CThread :: $m_icthread_id_counter; }
	public static function getCurrentObject(){ return CThread :: $m_objcontext_cur; }
	public static function getCurrentFunction(){ return CThread :: $m_fncontext_cur; }
	public static function setCurrentFunction( $fncontext ){ CThread :: $m_fncontext_cur = fncontext; }
} // end CThread
?>
