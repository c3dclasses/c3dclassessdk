<?php
//-----------------------------------------------------------------------------------------------------------------
// file: cincludefontfile.drv.php
// desc: includes font files
//----------------------------------------------------------------------------------------------------------------

// include the first css file
include_js(relname(__FILE__) . '/cincludefontfiles.drv.js');

//--------------------------------------------
// name: CIncludeFontFile
// desc: includes font files
//--------------------------------------------
class CIncludeFontFile extends CIncludeFile {
} // end class CIncludeFontFiles

//-----------------------------------------------------------------------
// name: include_font()
// desc: includes files relative to the where all the files are located
//-----------------------------------------------------------------------
function include_font($strfontname, $strfilename, $params=NULL){
	return include_resource($strfontname, $strfilename, "CIncludeFontFile", $params);
} // end include_font()

function font_uri( $strfontfile, $strformat ){
	return array( "url" => $strfontfile, "format" => $strformat );
} // end font_uri()

///////////////////
// hooks

//-------------------------------------------------------------------
// name: CIncludeFontFiles_toString()
// desc: hooks into the head of the html page to include the font
//-------------------------------------------------------------------
CHook :: add("head", "CIncludeFontFiles_toString");
function CIncludeFontFiles_toString() {
	$cincludefiles = CIncludeFiles :: getCIncludeFiles( "CIncludeFontFiles" );
	if( $cincludefiles == NULL )
		return "";
	$str = "<style>\n";
	$fontparams = $cincludefiles->getFilePathParams();
	foreach( $fontparams as $strfontname=>$params )
		$str .= toFontString( $params ) . "\n";
	$str .= "</style>\n";
	return $str;
} // end CIncludeFontFiles_toString()

//-------------------------------------------------------------
// name: toCSSString()
// desc: returns the style properties containing the css file
//-------------------------------------------------------------
function toFontString( $params ){
	$strfontfamily = $params["filename"];
	$strsrc = NULL;
	if( gettype( $params["src"] ) == "array" ){
		foreach( $params["src"] as $params )
			$strsrc[] = "url('".$params['url']."') format('".$params['format']."')";
		$strsrc = implode(",", $strsrc );
	} // end if
	else{
	 	$strsrc = $params["src"];
		$strsrc = "url('$strsrc')";
	} // end else
	return <<<CSS
@font-face {
	font-family: '$strfontfamily';
  	src: $strsrc;
}
CSS;
} // end toCSSString()
?>