<?php
//---------------------------------------------------------------------------
// name: csetinterval.prg.php
// desc: demonstrates how to use setinterval
//---------------------------------------------------------------------------

// includes
include_program("CSetIntervalProgram");

//---------------------------------------------------
// name:CSetIntervalProgram
// desc: test the setinterval/timeout functionality
//---------------------------------------------------
class CSetIntervalProgram extends CProgram{
	public function CSetIntervalProgram(){ 
		parent :: CProgram();	
	} // end CSetIntervalProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr("<b>cinterval.js</b>");	
	var i1=0;
	var interval1 = setInterval(function(){
		printbr("setInterval - callback1 - in js() - " + i1);
		if(i1>1) {
			clearInterval(interval1);
			printbr("clearInterval - callback1 - in js()");
			printbr();
		} // end if()
		i1++;
	}, 100); // end setInterval()
	
	var i2=0;
	var interval2 = setInterval(function(){
		printbr("setInterval - callback2 - in js() - " + i2);
		if(i2>1) {
			clearInterval(interval2);
			printbr("clearInterval - callback2 - in js()");
			printbr();
		} // end if()
		i2++;
	}, 500); // end setInterval()
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>cinterval.php</b>");
	$i1=0;
	$interval1=NULL;
	$interval1 = setInterval(function() use(&$interval1, &$i1){
		printbr("setInterval - callback1 - in php() - " . $i1);
		if($i1>1) {
			clearInterval($interval1);
			printbr("clearInterval - callback1 - in php()");
			printbr();
		} // end if()
		$i1++;
	}, 100); // end setInterval()
	
	$i2=0;
	$interval2=NULL;
	$interval2 = setInterval(function() use(&$interval2, &$i2){
		printbr("setInterval - callback2 - in php() - " . $i2);
		if($i2>1) {
			clearInterval($interval2);
			printbr("clearInterval - callback2 - in php()");
			printbr();
		} // end if()
		$i2++;
	}, 500); // end setInterval()
	
return ob_end();
	} // end innerhtml()
} // end CSetIntervalProgram
?>