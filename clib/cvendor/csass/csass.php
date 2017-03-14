<?php
//----------------------------------------------------------
// file: csass.php
// desc: provides methods to compile into css
//----------------------------------------------------------

// includes
include_once("PHamIP/PHamlP_3.2/haml/HamlParser.php");
include_once("PHamIP/PHamlP_3.2/sass/SassParser.php");

//-------------------------------------------------
// name: CSASS
// desc: provides methods to compile into css
//-------------------------------------------------
class CSASS {
	//-----------------------------------------------------------------------------
	// name: scssFileToString()
	// desc: compiles the sccss formated file into a string with css content
	//-----------------------------------------------------------------------------
	static public function scssFileToString( $strscssfilename ){	
		$prev = ini_get("error_reporting");
		error_reporting(0);
		$sass = new SassParser(array('style'=>'nested'));
		$css = $sass->toCss($strscssfilename);	
		error_reporting($prev);
		return $css;
	} // end scssFileToString()
	
	//-----------------------------------------------------------------------------
	// name: scssFileToString()
	// desc: compiles the sccss formated file into a string with css content
	//-----------------------------------------------------------------------------
	static public function scssFileToCSSFile( $strscssfilename, $strcssfilename ){
		$strcss = CSASS :: scssFileToString( $strscssfilename );
		if( $strcss == "" || !( $outfile = fopen( $strcssfilename, "w" ) ) )
			return false;
		fwrite( $outfile, $strcss );
		fclose( $outfile );
		return true;		
	} // end scssFileToString()
} // end CSASS
?>