<?php
//----------------------------------------------------------------
// file: cconcurrentevent.drv.php
// desc: defines concurrentevent objects
//----------------------------------------------------------------

//----------------------------------------------
// name: CIntervalConcurrentEvent
// desc: implements an interval event object 
//----------------------------------------------
class CIntervalConcurrentEvent extends CConcurrentEvent {	
	// members
	protected $m_starttime = -1;
	protected $m_starttimeinterval = -1;
	static protected $m_timelimit=30;
	
	public function CIntervalConcurrentEvent() { 
		parent :: CConcurrentEvent(); 
	} // end CIntervalConcurrentEvent()

	public function create($imilliseconds, $callback) {
		if($callback == "" || $imilliseconds < 1 || 
			(getTypeOf($callback) != "function" && getTypeOf($callback) != "closure")) {
			return false;
		} // end if
		if(!parent :: init(array("imilliseconds"=>$imilliseconds, "callback"=>$callback)))
			return false;
		$this->m_starttimeinterval = $this->m_starttime = microtime(true)*1000; 
		if($imilliseconds>CIntervalConcurrentEvent :: $m_timelimit*1000) {
			CIntervalConcurrentEvent :: $m_timelimit = $imilliseconds/1000;
		} // end if
		return true;
	} // end create()
	
	public function getStartTime() {return $this->m_starttime; }
	public function getStartTimeInterval() {return $this->m_starttimeinterval; }
	public function getTimeLimit() {return $this->m_timelimit; }
		
	protected function consumeEvent() {  
		if(!($callback = $this->m_params["callback"]))
			return false;
		$callback();
		//$this->destroy();
		return true;	 
	} // consumeEvent()
	
	protected function produceEvent() { 
		if(((microtime(true)*1000) - $this->m_starttimeinterval) < $this->m_params["imilliseconds"]){
			return false;
		} // end if
		else $this->m_starttimeinterval = (microtime(true)*1000);
		return true;
	} // end produceEvent()	
} // end CFooConcurrentEvent

//////////////////////////////

//--------------------------------------------------------
// name: CTimeoutConcurrentEvent 
// desc: create a concurrent timeout object
//--------------------------------------------------------
class CTimeoutConcurrentEvent extends CIntervalConcurrentEvent {
	protected function consumeEvent() {  
		if(($ret = parent :: consumeEvent()))
			$this->destroy();
		return $ret;	 
	} // consumeEvent()
} // end CTimeoutConcurrentEvent

//--------------------------------------------------------
// name: setTimeout() 
// desc: sets the timeout 
//--------------------------------------------------------
function setTimeout($callback, $timeinms) {
	$cconcurrentevent = new CTimeoutConcurrentEvent();
	$cconcurrentevent->create($timeinms, $callback);
	return $cconcurrentevent;
} // end setTimeout()

//--------------------------------------------------------
// name: clearTimeout()
// desc: clears the timeout
//--------------------------------------------------------
function clearTimeout($cconcurrentevent) {
	$cconcurrentevent->destroy();
} // end clearTimeout()

//--------------------------------------------------------
// name: setInterval() 
// desc: sets the interval 
//--------------------------------------------------------
function setInterval($callback, $timeinms) {
	$cconcurrentevent = new CIntervalConcurrentEvent();
	$cconcurrentevent->create($timeinms, $callback);
	return $cconcurrentevent;
} // end setTimeout()

//--------------------------------------------------------
// name: clearInterval()
// desc: clears the interval
//--------------------------------------------------------
function clearInterval($cconcurrentevent) {
	$cconcurrentevent->destroy();
} // end clearInterval()
?>