<?php
//---------------------------------------------------------------------------
// name: cconstants.prg.php
// desc: demonstrates how to use constants
//---------------------------------------------------------------------------

// includes
include_program("CIntervalProgram");

//---------------------------------------------------
// name:CIntervalProgram
// desc: hello world program
//---------------------------------------------------
class CIntervalProgram extends CProgram{
	public function CIntervalProgram(){ 
		parent :: CProgram();	
	} // endCIntervalProgram()
	
	public function c_main(){
return <<<SCRIPT
	var _this = this;
	printbr("<b>cinterval.js</b>", _this.getElement());
	setTimeout( function(){ printbr("callback1 - in js()", _this.getElement()); }, 2000);	
	setTimeout( function(){ printbr("callback2 - in js()", _this.getElement()); }, 200);	
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>cinterval.php</b>");
	//setTimeout('callback1', 50);
	//setTimeout('callback2', 50);
	//setTimeout('callback3', 100);
	printbr("hello, world");
return ob_end();
	} // end innerhtml()
} // end CIntervalProgram

///////////////////////////
// callbacks
function callback1(){
	$infile = fopen( dirname(__FILE__) . "/cinterval.prg.out.txt", "a");
	fwrite( $infile, "callback1 - in php()\n" );
	fclose( $infile );
} // end callback1()

function callback2(){
	$infile = fopen( dirname(__FILE__) . "/cinterval.prg.out.txt", "a");
	fwrite( $infile, "callback2 - in php()\n" );
	fclose( $infile );
} // end callback2()

function callback3(){
	$infile = fopen( dirname(__FILE__) . "/cinterval.prg.out.txt", "a");
	fwrite( $infile, "callback3 - in php()\n" );
	fclose( $infile );
} // end callback2()

?>