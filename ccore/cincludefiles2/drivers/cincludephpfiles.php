<?php
//-----------------------------------------------------------------------------------------------------------------
// file: cincludephpfiles.php
// desc: provides a class object to include and manipulate javascript files 
//----------------------------------------------------------------------------------------------------------------

//--------------------------------------------
// name: CIncludePHPFiles
// desc: includes css files
//--------------------------------------------
class CIncludePHPFiles extends CIncludeFiles {
	public function	includephpfiles( $strext ){
		if( $this->m_filepathparams == NULL || $strext == NULL )
			return false;  
		foreach( $this->m_filepathparams as $strfilename=>$params )
			if( stripos( $strfilename, $strext ) )
				include_once( $strfilename );
		return true;
	} // includephpfiles()
} // end class CIncludePHPFiles

//-----------------------------------------------------------------------
// name: include_php()
// desc: includes only files with a given extension
//-----------------------------------------------------------------------
function include_php( $strfileextension, $params=NULL ){ 
	return CIncludeFiles :: includefiles( "CIncludePHPFiles", $strfilename, $params );	
	//return CPHPFiles :: includephpfiles( $strfilename, $params ); 
} // end include_php()

//----------------------------------------------------------------------------------------
// name: includephpfilesfrompath()
// desc: include a bunch of php files with a given extension and from a given path 
//----------------------------------------------------------------------------------------
function includephpfilesfrompath( $strpath, $strext ){
	if ( is_dir($strpath) == false || ($handle = opendir($strpath)) == NULL )
		return false; 
	while (false !== ($file = readdir($handle))){
		if( $file == "." || $file == ".." )
			continue;
		if( is_dir( "".$strpath."/".$file ) )
			includephpfilesfrompath( "".$strpath."/".$file, $strext );
		if( stripos( $file, $strext ) ){
			include_once( "$strpath/$file" );
		} // end if
    } // end while()
	closedir($handle);	
	return true;
} // end includephpfilesfrompath()

//---------------------------------------------------------------------
// name: includeifurlcontains()
// desc: includes the php file if the url contains the right keyword
//---------------------------------------------------------------------
function includephpifurlcontains( $strfilename, $strtofind ){
	// check if the url contains the string
	if( strpos( $_SERVER["REQUEST_URI"], $strtofind ) >= 0 ){
		// if it does then include the file	
		include_once( $strfilename );
		return true;
	} // end if
	return false;
} // end includeifurlcontains()
?>