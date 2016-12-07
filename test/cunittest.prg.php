<?php
//---------------------------------------------------------------------------
// name: cunittestprogram.prg.php
// desc: the program that runs the unit test for c3dclassessdk
//---------------------------------------------------------------------------

// includes
include_program("CUnitTestProgram");

//---------------------------------------------------
// name: CUnitTestProgram
// desc: the program that runs the unit test
//---------------------------------------------------
class CUnitTestProgram extends CProgram{
	public function CUnitTestProgram(){ 
		parent :: CProgram();	
	} // end minify_prg()
	
	public function c_main(){
return <<<SCRIPT
	printbr("<h1>Client-Side</h1>");
	CUnitTest.doTest(this.jq()); // run test and show results
SCRIPT;
	} // end c_main()
	
	public function innerhtml(){
ob_start();
	printbr("<h1>Server-Side</h1>");
	CUnitTest :: doTest(); // run test and show results
return ob_end();
	} // end innerhtml()
} // end CUnitTestProgram
?>