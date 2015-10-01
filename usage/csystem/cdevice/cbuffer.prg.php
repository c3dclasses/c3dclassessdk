<?php
//---------------------------------------------------------------------------
// name: cbuffer.prg.php
// desc: demonstrates how to use a buffer
//---------------------------------------------------------------------------

// includes
include_program( "CBufferProgram" );

//---------------------------------------------------
// name: cbufferProgram
// desc: hello world program
//---------------------------------------------------
class CBufferProgram extends CProgram{
	public function cbufferProgram(){ 
		parent :: CProgram();	
	} // end cbufferProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>cbuffer.js</b>" );
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>cbuffer.php</b>"); 
return ob_end();
	} // end innerhtml()
} // end CBufferProgram
?>