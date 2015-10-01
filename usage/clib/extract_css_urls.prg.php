<?php
//---------------------------------------------------------------------------
// name: extract_css_urls.prg.php
// desc: demonstates how to use extract_css_urls
//---------------------------------------------------------------------------

// includes
include_program("extract_css_urls");

//---------------------------------------------------
// name: extract_css_urls
// desc: demonstatrates how to use extract_css_urls
//---------------------------------------------------
class extract_css_urls extends CProgram{
	public function extract_css_urls(){ 
		parent :: CProgram();	
	} // end extract_css_urls()
		
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>extract_css_urls</b>");
	printbr("<b>css: </b>http://creedsoflove.com/wp-content/themes/maya/style.css");
	$text = file_get_contents( "http://creedsoflove.com/wp-content/themes/maya/style.css" );
	printbr( "<b>file_get_contents:</b> " . $text );
	$urls = extract_css_urls( $text );
	printbr();
	printbr("<b>urls:</b> ");
	foreach( $urls as $index1=>$links )
		foreach( $links as $index2=>$link )
			printbr($index1.":".$index2.": ".$link);	
	printbr();
return ob_end();
	} // end innerhtml()
} // end extract_css_urls
?>