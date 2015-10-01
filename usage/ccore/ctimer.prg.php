<?php
//---------------------------------------------------------------------------
// name: cconstants.prg.php
// desc: demonstrates how to use constants
//---------------------------------------------------------------------------

// includes
include_program( "CTimerProgram" );

//---------------------------------------------------
// name: CTimerProgram
// desc: hello world program
//---------------------------------------------------
class CTimerProgram extends CProgram{
	public function CTimerProgram(){ 
		parent :: CProgram();	
	} // end CTimerProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>ctimer.js</b>" );
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr( "<b>ctimer.php</b>" );
return ob_end();
	} // end innerhtml()
} // end CTimerProgram
?>