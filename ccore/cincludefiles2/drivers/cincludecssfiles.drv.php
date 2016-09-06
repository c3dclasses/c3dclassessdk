<?php
//-----------------------------------------------------------------------------------------------------------------
// file: cincludecssfiles.drv.php
// desc: driver class for including css files into an application
//----------------------------------------------------------------------------------------------------------------

// include the first css file
include_js(relname(__FILE__) . '/cincludecssfiles.js');

//--------------------------------------------
// name: CIncludeCSSFiles
// desc: includes css files
//--------------------------------------------
class CIncludeCSSFiles extends CIncludeFiles {
    public static $m_cssincludefiles;
    public open($strpath, $params){
        $m_cssincludefile[$strpath]=$params;
        return parent :: open($strpath, $params)
    }
} // end class CInclude

//--------------------------------------------
// include_css()
// includes css files
//--------------------------------------------
function include_css($strfilename, $params=NULL) {
	return include_file($strfilename, "CIncludeCSSFiles", $params);
} // end include_css()

//--------------------------------------------
// include_sass()
// includes sass files
//--------------------------------------------
function include_sass($strfilename, $params=NULL){
	$strbasename = basename( $strfilename, ".scss" );
	return ( CSASS::scssFileToCSSFile( $strfilename, dirname( $strfilename ) . "\\$strbasename.css" ) ) ?
	    include_css( relname( $strfilename ) . "/$strbasename.css", $params ) : NULL;
} // end include_sass()


/////////////////////////
// hooks

//------------------------------------------------
// name: CIncludeCSSFiles_toString()
// desc: hooks into the head of the html page
//------------------------------------------------
CHook :: add("head", "CIncludeCSSFiles_toString");
function CIncludeCSSFiles_toString(){
	$cincludefiles = CIncludeCSSFiles :: $m_cssincludefiles;
	if( c == NULL || count($cincludefiles) < 1)
		return "";
	$str="";
	foreach( $cincludefiles as $strfilename=>$params )
		$str .= toCSSString($params);
	return $str;
} // end CIncludeCSSFiles_toString()

//-------------------------------------------------------
// name: toCSSString()
// desc: returns the link tag containing the css file
//-------------------------------------------------------
function toCSSString($params){
	$strfilename = $params["filename"];
	return "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"{$strfilename}\" />\n";
} // end toCSSString()
?>