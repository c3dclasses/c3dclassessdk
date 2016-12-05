<?php
//---------------------------------------------------------------------------
// name: cobqueue.prg.php
// desc: demonstrates how to use obqueue 
//---------------------------------------------------------------------------

// includes
include_program("CObqueueProgram");

//---------------------------------------------------
// name: CObqueueProgram
// desc: hello world program
//---------------------------------------------------
class CObqueueProgram extends CProgram {
	// constructor
	public function CObqueueProgram() { 
		parent :: CProgram();	
	} // end CObqueueProgram()
	
		public function c_main() {
return <<<SCRIPT
		/*
	ob_start();
		printbr("outer-hello1");
		printbr("outer-hello2");
		ob_start();
			printbr("inner-hello1");
			printbr("inner-hello2");
		_print(ob_end());
		printbr("outer-hello3");
		printbr("outer-hello4");
	_print(ob_end());
	*/
		ob_start();
		printbr("this is the queued contents1");
		ob_end_queue("foo");
		ob_start();
		printbr("this is the queued contents2");
		ob_end_queue("foo");
		ob_start();
		printbr("this is the queued contents3");
		ob_end_queue("foo");
		ob_start();
		printbr("this is the queued contents4");
		ob_end_queue("foo");
		ob_start();
		printbr("this is the queued contents5");
		ob_end_queue("foo");		
		ob_start();
		printbr("this is the queued contents1--7");
		ob_end_queue("foo7");
		ob_start();
		printbr("this is the queued contents2--7");
		ob_end_queue("foo7");
		ob_start();
		printbr("this is the queued contents3--7");
		ob_end_queue("foo7");
		ob_start();
		printbr("this is the queued contents4--7");
		ob_end_queue("foo7");
		ob_start();
		printbr("this is the queued contents5--7");
		ob_end_queue("foo7");

		printbr();
		printbr("<b>cobqueueprogram.js</b>");
		printbr(ob_queue_dump("foo"));
		printbr(ob_queue_dump("foo7"));

SCRIPT;
	} // end load()
	

	// rendering methods
	public function innerhtml() {	
		ob_start();
		printbr("this is the queued contents1");
		ob_end_queue("foo");
		ob_start();
		printbr("this is the queued contents2");
		ob_end_queue("foo");
		ob_start();
		printbr("this is the queued contents3");
		ob_end_queue("foo");
		ob_start();
		printbr("this is the queued contents4");
		ob_end_queue("foo");
		ob_start();
		printbr("this is the queued contents5");
		ob_end_queue("foo");		
		ob_start();
		printbr("this is the queued contents1--7");
		ob_end_queue("foo7");
		ob_start();
		printbr("this is the queued contents2--7");
		ob_end_queue("foo7");
		ob_start();
		printbr("this is the queued contents3--7");
		ob_end_queue("foo7");
		ob_start();
		printbr("this is the queued contents4--7");
		ob_end_queue("foo7");
		ob_start();
		printbr("this is the queued contents5--7");
		ob_end_queue("foo7");
		
		ob_start();
		printbr();
		printbr("<b>cobqueueprogram.php</b>");
		printbr(ob_queue_dump("foo"));
		printbr(ob_queue_dump("foo7"));
		return ob_end();
	} // end innerhtml()
} // end CObqueueProgram
?>