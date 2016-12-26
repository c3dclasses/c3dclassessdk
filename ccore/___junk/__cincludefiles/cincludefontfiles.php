<?php
//-----------------------------------------------------------------------------------------------------------------
// file: cincludefontfiles.php
// desc: provides a class object to include and manipulate font files 
//----------------------------------------------------------------------------------------------------------------

//--------------------------------------------
// name: CIncludeFontFiles
// desc: includes font files
//--------------------------------------------
class CIncludeFontFiles extends CIncludeFiles {
} // end class CIncludeFontFiles

//-----------------------------------------------------------------------
// name: include_font()
// desc: includes files relative to the where all the files are located
//-----------------------------------------------------------------------
function include_font( $strfontname, $filenames, $params=NULL ){ 
	$params["src"]=$filenames;
	return CIncludeFiles :: includefiles( "CIncludeFontFiles", $strfontname, $params );	
} // end include_font()

function font_uri( $strfontfile, $strformat ){
	return array( "url" => $strfontfile, "format" => $strformat );
} // end font_uri()

// include the first css file
include_js(relname(__FILE__) . '/cincludefontfiles.js');	
?>