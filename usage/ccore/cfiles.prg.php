<?php
//---------------------------------------------------------------------------
// name: cfiles.prg.php
// desc: demonstates how to use cfiles functions
//---------------------------------------------------------------------------

// includes
include_program( "CFilesProgram" );

//---------------------------------------------------
// name: CFilesProgram
// desc: demonstatrates how to use cfiles functions
//---------------------------------------------------
class CFilesProgram extends CProgram{
	public function CFilesProgram(){ 
		parent :: CProgram();	
	} // end CFilesProgram()
	  
	public function c_main(){
return <<<SCRIPT
	this.css("background", "red");
	printbr(this.filename());
	printbr(this.urifilename());
	printbr(dirname(this.urifilename()));
	printbr("<b>cfiles.js</b>");
	printbr("Check <b>FireBug</b> to see the if the files where included");
	printbr(relname(this.__FILE__) + "/script1.js");
	printbr(relname(this.__FILE__) + "/style1.css");	
	include_js(relname(this.__FILE__) + "/script1.js");	// including a cfile dynamically into the program
	include_css(relname(this.__FILE__) + "/style1.css");	// including a cfile dynamically into the program
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr($this->filename());
	printbr($this->urifilename());
	printbr(dirname($this->urifilename()));
	printbr("<b>cfiles.php</b>");
	printbr("Check <b>Page Source</b> to see the if the files where included");
	printbr( relname(__FILE__) . "/script2.js");
	printbr( relname(__FILE__) . "/style2.css");	
	include_js( relname(__FILE__) . "/script2.js" );	// including a cfile into the program
	include_css( relname(__FILE__) . "/style2.css" );	// including a cfile into the program
return ob_end();
	} // end innerhtml()
} // end CFilesProgram
?>