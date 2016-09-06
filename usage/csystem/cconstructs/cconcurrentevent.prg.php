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
	$foo2->create(400, "myTimeout0");
	
	$foo3 = new CIntervalConcurrentEvent();
	$foo3->create(5050, "myTimeout1");

	$foo4 = new CIntervalConcurrentEvent();
	$foo4->create(30, "myTimeout2");
	
	//CConcurrentEvent :: doEventLoop();
	//alert("done with loop");
return ob_end();
	} // end innerhtml()
} // end CConcurrentEventProgram

function myTimeout0(){
	printbr("timeout-0");
}

function myTimeout1(){
	printbr("timeout-1");
}

function myTimeout2(){
	printbr("timeout-2");
}
?>