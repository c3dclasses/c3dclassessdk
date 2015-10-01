<?php
//---------------------------------------------------------------------------
// name: cminify.prg.php
// desc: demonstates how to use extract_css_urls
//---------------------------------------------------------------------------

// includes
include_program("CMinifyProgram");

//---------------------------------------------------
// name: CMinifyProgram
// desc: demonstatrates how to use extract_css_urls
//---------------------------------------------------
class CMinifyProgram extends CProgram{
	public function CMinifyProgram(){ 
		parent :: CProgram();	
	} // end CMinifyProgram()
		
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>cminify.php</b>");
	$strcss = CMinify :: cssToString( file_get_contents( "http://solarsimplified.org/components/com_rsform/assets/css/front.css" ) );	
	$strjs = CMinify :: jsToString( file_get_contents( "http://localhost/ccore/cincludefiles/cincludejsfiles.js" ) );	
	
	printbr( "<h1>Minify CSS</h1>" );
	printbr( $strcss );
	printbr();
	printbr();
	
	
	printbr( "<h1>Minify JS</h1>" );
	printbr( $strjs );
	
return ob_end();
	} // end innerhtml()
} // end CMinifyProgram
?>