<?php
//-----------------------------------------------------------------------------------------------------------------
// file: cincludecssfiles.php
// desc: provides a class object to include and manipulate javascript files 
//----------------------------------------------------------------------------------------------------------------

//--------------------------------------------
// name: CIncludeCSSFiles
// desc: includes css files
//--------------------------------------------
class CIncludeCSSFiles extends CIncludeFiles {
} // end class CInclude

//-----------------------------------------------------------------------
// name: include_css()
// desc: includes files relative to the where all the files are located
//-----------------------------------------------------------------------
function include_css( $strfilename, $params=NULL ){ 
	return CIncludeFiles :: includefiles( "CIncludeCSSFiles", $strfilename, $params );	
} // end include_css()

//--------------------------------------------------------------------------------
// name: include_sass()
// desc: includes a sass file by compiling it and converting it into a css files
//--------------------------------------------------------------------------------
function include_sass( $strfilename, $params=NULL ){ 
	$strbasename = basename( $strfilename, ".scss" );
	if( CSASS::scssFileToCSSFile( $strfilename, dirname( $strfilename ) . "\\$strbasename.css" ) )
		return include_css( relname( $strfilename ) . "/$strbasename.css", $params ); 
} // end include_sass()

// include the first css file
include_js(relname(__FILE__) . '/cincludecssfiles.js');	
?>