<?php
//---------------------------------------------------------------------------
// name: csetinterval.prg.php
// desc: demonstrates how to use setinterval
//---------------------------------------------------------------------------

// includes
include_program("CSetIntervalProgram");

//---------------------------------------------------
// name:CIntervalProgram
// desc: hello world program
//---------------------------------------------------
class CSetIntervalProgram extends CProgram{
	public function CSetIntervalProgram(){ 
		parent :: CProgram();	
	} // endCIntervalProgram()
	
	public function c_main(){
return <<<SCRIPT
	var _this = this;
	printbr("<b>cinterval.js</b>", _this.getElement());
	setTimeout( function(){ printbr("callback1 - in js()", _this.getElement()); }, 500);
	setTimeout( function(){ printbr("callback2 - in js()", _this.getElement()); }, 2000);	
	setTimeout( function(){ printbr("callback3 - in js()", _this.getElement()); }, 200);
	setTimeout( function(){ printbr("callback4 - in js()", _this.getElement()); }, 20);
	
		
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>cinterval.php</b>");
	setTimeout("callback1", 500);
	setTimeout("callback2", 2000);
	setTimeout("callback3", 200);
	setTimeout("callback4", 20);
	
return ob_end();
	} // end innerhtml()
} // end CIntervalProgram
function callback1(){printbr("callback1 - in php()");}
function callback2(){printbr("callback2 - in php()");}
function callback3(){printbr("callback3 - in php()");}
function callback4(){printbr("callback4 - in php()");}
	
?>