<?php
//----------------------------------------------------------
// file: cminify.php
// desc: provides minify methods
//----------------------------------------------------------

// includes
include_once("minify-2.1.7/min/utils.php");
include_once("cssmin-v3.0.1.php");

//-------------------------------------------------
// name: CMinify
// desc: provides minify methods
//-------------------------------------------------
class CMinify {
	//------------------------------------------------------
	// name: cssToString()
	// desc: returns a minified string with style content
	//------------------------------------------------------
	static public function cssToString( $str ){
		$minifier = new CssMinifier($str);
		return $minifier->getMinified();
	} // end cssToString()
	
	//---------------------------------------------------------
	// name: jsToString()
	// desc: returns a minified string with javascript content
	//---------------------------------------------------------
	static public function jsToString( $str ){
		return ($str) ? JSMin::minify($str) : "";
	} // end jsToString()
	
	//---------------------------------------------------------
	// name: htmlToString()
	// desc: returns a minified string with javascript content
	//---------------------------------------------------------
	static public function htmlToString( $str ){
		return Minify_HTML :: minify($str);
	} // end htmlToString()

	//--------------------------------------------------------------------
	// name: filesToString()
	// desc: returns a minfied string containing the contents of all the 
	//       relative files that where passed in
	//--------------------------------------------------------------------
	static public function filesToString( $strfilesnames ){
		if( !$strfilesnames || $strfilesnames == NULL )
			return "";
		$str = implode( ",", $strfilesnames );
		return file_get_contents( relname( __FILE__, true ). "/minify-2.1.7/min/?f=" . $str );
	} // end filesToString()
	
	//--------------------------------------------------------------------
	// name: filesToFile()
	// desc: stores a minfied string containing the contents of all the 
	//       relative files into a single minified file
	//--------------------------------------------------------------------
	static public function filesToFile( $strfilesnames, $strminfilename ){
		$strmin = CMinify :: filesToString( $strfilesnames ); 
		if( $strmin == "" || !( $outfile = fopen( $strminfilename, "w" ) ) )
			return false;
		fwrite( $outfile, $strmin );
		fclose( $outfile );
		return true;
	} // end filesToFile()
} // end CMinify
?>