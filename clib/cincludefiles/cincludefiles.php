<?php
//----------------------------------------------------------------------------------
// file: cincludefiles.php
// desc: provides a way to include files as resources to be used in application
//----------------------------------------------------------------------------------

//----------------------------------------------------------------------------------
// name: CIncludeFiles
// desc: provides a way to include files as resources to be used in application
//----------------------------------------------------------------------------------
class CIncludeFiles{
	// members
	static protected $m_cincludefiles=NULL;
	protected		 $m_filepathparams=NULL;
	
	// methods
	public function  add( $strfilename, $params ){ 
		$params["filename"] = $strfilename;
		$this->m_filepathparams[$strfilename]=$params; 
		return $strfilename;
	} // end add()
	
	public function 	compile(){
	} // end compile()
	
	public function 	getFilePathParams(){
		return $this->m_filepathparams;
	} // end getFilePathParams()
	
	public static function includefiles( $includefiletype, $strfilename, $params=NULL ){
		if( $strfilename == "" || $strfilename == NULL )
			return "";
		if( CIncludeFiles :: $m_cincludefiles == NULL )
			CIncludeFiles :: $m_cincludefiles = array();
		if( isset( CIncludeFiles :: $m_cincludefiles[$includefiletype] ) == false )
			CIncludeFiles :: $m_cincludefiles[$includefiletype] = new $includefiletype();
		CIncludeFiles :: $m_cincludefiles[$includefiletype]->add( $strfilename, $params );
		return $strfilename;
	} // end includefiles()
	
	public static function getCIncludeFiles( $includefiletype ){
		return ( $includefiletype != NULL && CIncludeFiles :: $m_cincludefiles && isset( CIncludeFiles :: $m_cincludefiles[$includefiletype]) ) ? CIncludeFiles :: $m_cincludefiles[$includefiletype] : NULL;
	} // end getCIncludeFiles()
} // end class CIncludeFiles

// includes
function include_minify_path( $path ){ 
	include_path( "cincludefiles.min.path", $path, array("client"=>"false") ); 
} // end include_minify_path()

// include the others
include_once("cincludejsfiles.php");
include_once("cincludecssfiles.php");
include_once("cincludephpfiles.php");
include_once("cincludexmlfiles.php");
include_once("cincludefontfiles.php");
?>