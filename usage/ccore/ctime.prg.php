<?php
//---------------------------------------------------------------------------
// name: ctime.prg.php
// desc: usage of time class
//---------------------------------------------------------------------------

// includes
include_program( "CTimeProgram" );

//---------------------------------------------------
// name: CTimeProgram
// desc: hello world program
//---------------------------------------------------
class CTimeProgram extends CProgram{
	public function CTimeProgram(){ 
		parent :: CProgram();	
	} // end CTimeProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr("<b>ctime.js</b>");
	printbr("CTime.us() = " + CTime.us());
	printbr("CTime.ms() = " + CTime.ms());
	printbr("CTime.s() = " + CTime.s());
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>ctime.php</b>");
	printbr("CTime::us() = " . CTime::us());
	printbr("CTime::ms() = " . CTime::ms());
	printbr("CTime::s() = " . CTime::s());
return ob_end();
	} // end innerhtml()
} // end CTimerProgram
?>