<?php
//-------------------------------------------------------------------------------
// name: cfile.prg.php
// desc: demonstrates how to use the use cfile object to write to output file
//-------------------------------------------------------------------------------

// includes
include_program( "CFileProgram" );
include_file( "foo", dirname(__FILE__) . "/foo.txt", "a" );

//---------------------------------------------------
// name: CFileProgram
// desc: hello world program
//---------------------------------------------------
class FileProgram extends CProgram{
	public function CFileProgram(){ 
		parent :: CProgram();	
	} // end CFileProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr("<b>cfile.js</b>");
SCRIPT;
	} // end load()
	
	public function innerhtml(){
ob_start();
	printbr("<b>cfile.php</b>");
	printbr("look for this file: " .  dirname(__FILE__) . "/foo.txt" );
	useiofile("foo")->println("writing to output file");
	useiofile("foo")->println("writing to output file again");
	useiofile("foo")->println("writing to output file again again");
	useiofile("foo")->println("This is a resources object that write information to.");
	
return ob_end();
	} // end innerhtml()
} // end CFileProgram
?>