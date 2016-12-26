<?php
//-----------------------------------------------------------------------------------------------------------------
// file: cincludejsfiles.php
// desc: provides a class object to include and manipulate javascript files 
//----------------------------------------------------------------------------------------------------------------

//--------------------------------------------
// name: CIncludeJSFiles
// desc: includes javascript files
//--------------------------------------------
class CIncludeJSFiles extends CIncludeFiles {
} // end class CIncludeJSFiles

//-----------------------------------------------------------------------
// name: include_js()
// desc: includes files relative to the where all the files are located
//-----------------------------------------------------------------------
function include_js( $strfilename, $params=NULL ){
	return CIncludeFiles :: includefiles( "CIncludeJSFiles", $strfilename, $params );	
} // end include_js()

// include the first js file
include_js(relname(__FILE__) . '/cincludejsfiles.js');	
?>