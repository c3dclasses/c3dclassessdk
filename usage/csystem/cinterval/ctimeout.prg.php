<?php
//---------------------------------------------------------------------------
// name: csettimeout.prg.php
// desc: demonstrates how to use settimeout
//---------------------------------------------------------------------------

// includes
include_program("CSetTimeoutProgram");

//---------------------------------------------------
// name: CSetTimeoutProgram
// desc: test the settimeout/timeout functionality
//---------------------------------------------------
class CSetTimeoutProgram extends CProgram{
	public function CSetTimeoutProgram(){ 
		parent :: CProgram();	
	} // end CSetTimeoutProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr("<b>ctimeout.js</b>");
	setTimeout(function(){printbr("setTimeout - callback1 - in js()");}, 500);
	setTimeout(function(){printbr("setTimeout - callback2 - in js()");}, 2000);
	setTimeout(function(){printbr("setTimeout - callback3 - in js()");}, 200);
	setTimeout(function(){printbr("setTimeout - callback4 - in js()");}, 20);
	setTimeout(function(){printbr("setTimeout - callback5 - in js()");}, 100);
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>cinterval.php</b>");
	setTimeout(function(){printbr("callback1 - in php()");}, 500);
	setTimeout(function(){printbr("callback2 - in php()");}, 2000);
	setTimeout(function(){printbr("callback3 - in php()");}, 200);
	setTimeout(function(){printbr("callback4 - in php()");}, 20);
	setTimeout(function(){printbr("callback5 - in php()");}, 100);	
return ob_end();
	} // end innerhtml()
} // end CSetTimeoutProgram
?>