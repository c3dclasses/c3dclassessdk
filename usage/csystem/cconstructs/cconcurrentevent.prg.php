<?php
//---------------------------------------------------------------------------
// name: cconcurrenteventprogram.prg.php
// desc: demonstrates how to use constants
//---------------------------------------------------------------------------

// includes
include_program( "CConcurrentEventProgram" );

// create a concurrent event type
class CFooConcurrentEvent extends CConcurrentEvent {
	public function CFooConcurrentEvent() { parent :: CConcurrentEvent(); }
	protected function produceEvent() { printbr("produced an event" . $this->m_id . $this->m_params); return true; }
	protected function consumeEvent() { printbr("consumed an event: " . $this->m_id . $this->m_params ); $this->destroy(); return false; }	
} // end CFooConcurrentEvent

/*
// create a concurrent event type
class CIntervalConcurrentEvent extends CConcurrentEvent {
	protected $m_starttime = -1;
	protected $m_starttimeinterval = -1;
	protected $i=0;
	static protected $m_timelimit=30;
	public function CIntervalConcurrentEvent() { 
		parent :: CConcurrentEvent(); 
	}
	public function create2($ms, $callback) {
		if(!parent :: create(array("ms"=>$ms, "callback"=>$callback)))
			return false;
		$this->m_starttimeinterval = $this->m_starttime = microtime(true)*1000; 
		
		if($ms>CIntervalConcurrentEvent :: $m_timelimit*1000) {
			printbr("bigger: " . $ms);
			CIntervalConcurrentEvent :: $m_timelimit = $ms/1000;
			set_time_limit ( CIntervalConcurrentEvent :: $m_timelimit );
		} // end if
		//set_time_limit (60000);
		return true;
	}
	
	//protected function produceEvent() { alert("produced an event" . $this->m_id . $this->m_params); return true; }
	protected function consumeEvent() {  
		$callback = $this->m_params["callback"];
		 $callback();
		 if($this->i>=2){
		 	printbr("done-" . $this->m_id . " time elapsed: " . ((microtime(true)*1000) - $this->m_starttimeinterval) );
		 	$this->destroy();
			return true;
		 }
		 $this->i++;
		 return true;
		 
	} 
	protected function produceEvent() { 
		//alert("delay");
		//alert("elasped: " . ((microtime(true)*1000)-$this->m_starttime));
		//alert("ms: " . $this->m_params["ms"]);
		
		if( ((microtime(true)*1000) - $this->m_starttime) < $this->m_params["ms"]){
			//alert("could not produce produceEvent");
			return false;
		}
		else $this->m_starttime = (microtime(true)*1000);
		//alert("produceEvent");
		return true;
	}*/
	/*
	protected function consumeEvent() { 
		 $callback = $this->m_params["callback"];
		 $callback();
		 return true;
		//alert("consumed an event: " . $this->m_id . $this->m_params ); 
		//$this->destroy(); 
		//return false; 
	}*/
		
//} // end CFooConcurrentEvent

//---------------------------------------------------
// name: CConcurrentEventProgram
// desc: hello world program
//---------------------------------------------------
class CConcurrentEventProgram extends CProgram{
	public function CConcurrentEventProgram(){ 
		parent :: CProgram();	
	} // end CConstructsProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>cconcurrenteventprogram.js</b>", this.getElement() );
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr( "<b>cconcurrenteventprogram.php</b>" );
	//$foo = new CFooConcurrentEvent();
	//$foo->create("Foo Params");
	
	$foo2 = new CIntervalConcurrentEvent();
	$foo2->create2(40, "myTimeout");
	
	$foo3 = new CIntervalConcurrentEvent();
	$foo3->create2(5050, "myTimeout2");

	$foo4 = new CIntervalConcurrentEvent();
	$foo4->create2(30, "myTimeout3");
	
	//CConcurrentEvent :: doEventLoop();
	//alert("done with loop");
return ob_end();
	} // end innerhtml()
} // end CConcurrentEventProgram

function myTimeout(){
	printbr("timeout-0");
}

function myTimeout2(){
	printbr("timeout-1");
}

function myTimeout3(){
	printbr("timeout-2");
}

?>