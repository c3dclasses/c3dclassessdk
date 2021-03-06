<?php
//--------------------------------------------------------------------------
// file: cconcurrentevent.drv.php
// desc: implement a concurrent event model for synchronous langauges
//--------------------------------------------------------------------------

//-------------------------------------------------------------------
// name: CConcurrentEvent
// desc: defines a concurrent event model for synchronous langauges
//-------------------------------------------------------------------
class CConcurrentEvent {
	protected static $m_cconcurrentevents = NULL;		// stores the concurrent event type instances
	protected static $m_cconcurrenteventsqueue = NULL; 	// represents the event queue
	protected static $m_counter = 0;					
	protected $m_params;
	protected $m_id;
	
	public function CConcurrentEvent() {
		$this->m_params = NULL;
		$this->m_id=-1;	
	} // end CConcurrentEvent()
	
	public function destroy() {
		CConcurrentEvent :: removeCConcurrentEvent($this);
	} // end destroy()
	
	public function getID() {
		return $this->m_id;
	} // end getID()
	
	public function getParams() { 
		return $this->m_params;
	} // end getParams()
	
	// produces and event and returns true if so otherwise false
	protected function produceEvent() {
		return false;
	} // end produceEvent()
	
	// consumes an event and returns true otherwise false
	protected function consumeEvent() {	
		return true;
	} // end consumeEvent()
	
	protected function init($params) {
		// check incoming params
		if($params == NULL )
			return false;
		$this->m_params = $params;
		return CConcurrentEvent :: addCConcurentEvent($this);
	} // end create()
	
	//////////////////////
	// static methods
	static protected function addCConcurentEvent($cconcurrentevent){
		if(!$cconcurrentevent)
			return false;
		$id = CConcurrentEvent :: $m_counter;
		$cconcurrentevent->m_id = $id;
		if(!CConcurrentEvent :: $m_cconcurrentevents)
			CConcurrentEvent :: $m_cconcurrentevents = array();
		CConcurrentEvent :: $m_cconcurrentevents[$id] = $cconcurrentevent;
		CConcurrentEvent :: $m_counter++;		
		return true;
	} // end addCConcurrentEvent()
	
	static protected function removeCConcurrentEvent($cconcurrentevent) {
		if(!$cconcurrentevent)
			return;
		$id = $cconcurrentevent->m_id;
		unset(CConcurrentEvent :: $m_cconcurrentevents[$id]);
		unset(CConcurrentEvent :: $m_cconcurrenteventsqueue[$id]);
		$cconcurrentevent->m_id = -1;
	} // removeCConcurrentEvent()
	
	// produces an event an stores it on the Queue
	static protected function produceEventToQueue() {
		if(!CConcurrentEvent :: $m_cconcurrentevents || empty(CConcurrentEvent :: $m_cconcurrentevents))
			return false;
		foreach(CConcurrentEvent :: $m_cconcurrentevents as $id=>$cconcurrentevent) {
			if($cconcurrentevent->produceEvent()){
				if(!CConcurrentEvent :: $m_cconcurrenteventsqueue || empty(CConcurrentEvent :: $m_cconcurrenteventsqueue))
					CConcurrentEvent :: $m_cconcurrenteventsqueue=array();
				array_push(CConcurrentEvent :: $m_cconcurrenteventsqueue, $cconcurrentevent);
			} // end if()
		} // end foreach()
		return true;
	} // end produceEventToQueue()
	
	// consumes the event from the Queue and handles it
	static protected function consumeEventFromQueue($numtoconsume=-1) {
		if(!CConcurrentEvent :: $m_cconcurrenteventsqueue)
			return false;
		$consumedcount=0;
		while(($cconcurrentevent = array_shift(CConcurrentEvent :: $m_cconcurrenteventsqueue)) != NULL) {
			$cconcurrentevent->consumeEvent();
			$consumedcount++;
			if($numtoconsume>1 && $consumedcount==$numtoconsume)
				break;
		} // end while
		return true;
	} // end consumeEventFromQueue()
	
	static public function doEventLoop($numtoconsume=-1) {
		while(true) {
			if(empty(CConcurrentEvent :: $m_cconcurrentevents)==true) {
				return false;
			} // end if
			CConcurrentEvent :: produceEventToQueue();
			CConcurrentEvent :: consumeEventFromQueue($numtoconsume);
		} // end while()
		return true;
	} // end doEventLoop()
} // end CConcurrentEvent

//------------------------------------------------------
// name: CConcurrentEvent_doEventLoop()
// desc: runs the event loop in the foot area of kernal
//------------------------------------------------------
function CConcurrentEvent_doEventLoop() {
	CConcurrentEvent :: doEventLoop();
	return "";
} // end CConcurrentEvent_doEventLoop()
CHook :: add("foot", "CConcurrentEvent_doEventLoop");
?>