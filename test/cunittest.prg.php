<?php
//---------------------------------------------------------------------------
// name: cunittestprogram.prg.php
// desc: the program that runs the unit test for c3dclassessdk
//---------------------------------------------------------------------------

// includes
include_program("CUnitTestProgram");

//---------------------------------------------------
// name: CUnitTestProgram
// desc: demonstatrates how to use minify_prg
//---------------------------------------------------
class CUnitTestProgram extends CProgram{
	public function CUnitTestProgram(){ 
		parent :: CProgram();	
	} // end minify_prg()
	
	public function c_main(){
return <<<SCRIPT
	CUnitTest.doTest(this.jq());	// run test and show results
SCRIPT;
	} // end c_main()
	
	public function innerhtml(){
ob_start();
	CUnitTest :: doTest(); // run test and show results
return ob_end();
	} // end innerhtml()
} // end CUnitTestProgram
?>