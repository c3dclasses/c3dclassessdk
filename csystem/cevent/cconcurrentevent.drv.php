<?php
//------------------------------------------------------------------------------
// name: cconcurrentevent.drv.php
// desc: defines a conccurent event interval object
//------------------------------------------------------------------------------



//----------------------------------------------
// name: CIntervalConcurrentEvent
// desc: implements an interval event object 
//----------------------------------------------
class CIntervalConcurrentEvent extends CConcurrentEvent {	
	// members
	protected $m_starttime = -1;
	protected $m_starttimeinterval = -1;
	protected $i=0;
	static protected $m_timelimit=30;
	
	public function CIntervalConcurrentEvent() { 
		parent :: CConcurrentEvent(); 
	} // end CIntervalConcurrentEvent()
	
	public function create2($ms, $callback) {
		if(!parent :: create(array("ms"=>$ms, "callback"=>$callback)))
			return false;
		$this->m_starttimeinterval = $this->m_starttime = microtime(true)*1000; 
		
		if($ms>CIntervalConcurrentEvent :: $m_timelimit*1000) {
			//printbr("bigger: " . $ms);
			CIntervalConcurrentEvent :: $m_timelimit = $ms/1000;
			set_time_limit ( CIntervalConcurrentEvent :: $m_timelimit );
		} // end if
		//set_time_limit (60000);
		return true;
	} // end create()
	
	protected function consumeEvent() {  
		$callback = $this->m_params["callback"];
		$callback();
		$this->destroy();
		/* 
		 if($this->i>=2){
		 	printbr("done-" . $this->m_id . " time elapsed: " . ((microtime(true)*1000) - $this->m_starttime) );
		 	$this->destroy();
			return true;
		 }
		 $this->i++;
		 */
		 return true;	 
	} // consumeEvent()
	
	protected function produceEvent() { 
		//alert("delay");
		//alert("elasped: " . ((microtime(true)*1000)-$this->m_starttimeinterval));
		//alert("ms: " . $this->m_params["ms"]);
		
		if( ((microtime(true)*1000) - $this->m_starttimeinterval) < $this->m_params["ms"]){
			//alert("could not produce produceEvent");
			return false;
		}
		else $this->m_starttimeinterval = (microtime(true)*1000);
		//alert("produceEvent");
		return true;
	} // end produceEvent()
			
} // end CFooConcurrentEvent

function setTimeout($callback, $timeinms) {
	$cconcurrentevent = new CIntervalConcurrentEvent();
	$cconcurrentevent->create2($timeinms, $callback);
	return $cconcurrentevent;
}

function clearTimeout($cconcurrentevent) {
	$cconcurrentevent->destroy();
} // end clearInterval()
?>