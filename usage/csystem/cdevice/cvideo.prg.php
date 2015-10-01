<?php
//---------------------------------------------------------------------------
// name: cbase.prg.php
// desc: demonstrates how to construct a basic hello, world!!! program
//---------------------------------------------------------------------------

// includes
//include_program( "CVideoProgram" );

//---------------------------------------------------
// name: CVideoProgram
// desc: hello world program
//---------------------------------------------------
class CVideoProgram extends CProgram{
	public function CVideoProgram(){ 
		parent :: CProgram();	
	} // end CVideoProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>cvideo.js</b>" );
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr( "<b>cvideo.php</b>" );
return ob_end();
	} // end innerhtml()
} // end CVideoProgram
?>