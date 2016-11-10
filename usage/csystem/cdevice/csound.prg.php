<?php
//---------------------------------------------------------------------------
// name: csound.prg.php
// desc: demonstrates how to construct a basic hello, world!!! program
//---------------------------------------------------------------------------

// includes
include_program( "CSoundProgram" );

//---------------------------------------------------
// name: CSoundProgram
// desc: hello world program
//---------------------------------------------------
class CSoundProgram extends CProgram{
	public function CSoundProgram(){ 
		parent :: CProgram();	
	} // end CSoundProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>csound.js</b>" );
	csound = new CSound();
	csound.createFromURI("http://www.w3schools.com/tags/movie.ogg", "mysound");
	csound.load();
	csound.play();
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr( "<b>csound.php</b>" );
return ob_end();
	} // end innerhtml()
} // end CSoundProgram
?>