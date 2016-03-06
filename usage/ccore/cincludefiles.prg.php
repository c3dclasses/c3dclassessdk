<?php
//---------------------------------------------------------------------------
// name: cincludefilesprogram.prg.php
// desc: demonstates how to use cfiles functions
//---------------------------------------------------------------------------

// includes
include_program( "CIncludeFilesProgram" );
include_font( "mynewfont", array( font_uri( "http://themes.googleusercontent.com/static/fonts/drsugiyama/v2/rq_8251Ifx6dE1Mq7bUM6brIa-7acMAeDBVuclsi6Gc.woff", "woff" ) ) );
include_font( "mynewfont333", array( font_uri( "http://themes.googleusercontent.com/static/fonts/drsugiyama/v2/rq_8251Ifx6dE1Mq7bUM6brIa-7acMAeDBVuclsi6Gc.woff", "woff" ),
								  font_uri( "Graublauweb2.eot", "eot" ),
								  font_uri( "Graublauweb3.eot", "eot" ),
								  font_uri( "Graublauweb4.eot", "eot" ) ) );
								  
//---------------------------------------------------
// name: CIncludeFilesProgram
// desc: demonstatrates how to use cfiles functions
//---------------------------------------------------
class CIncludeFilesProgram extends CProgram{
	public function CIncludeFilesProgram(){ 
		parent :: CProgram();	
	} // end CIncludeFilesProgram()
	  
	public function c_main(){
return <<<SCRIPT
	this.css("background", "red");
	printbr(this.filename());
	printbr(this.urifilename());
	printbr(dirname(this.urifilename()));
	printbr("<b>cfiles.js</b>");
	printbr("Check <b style='font-family:mynewfont; font-size:50px;'>FireBug</b> to see the if the files where included");
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
} // end CIncludeFilesProgram
?>