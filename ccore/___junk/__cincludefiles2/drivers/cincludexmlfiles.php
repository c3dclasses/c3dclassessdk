<?php
//-----------------------------------------------------------------------------------------------------------------
// file: cincludexmlfiles.php
// desc: provides a class object to include and manipulate javascript files 
//----------------------------------------------------------------------------------------------------------------

//--------------------------------------------
// name: CIncludeXMLFiles
// desc: includes javascript files
//--------------------------------------------
class CIncludeXMLFiles extends CIncludeFiles{
	// members
	protected 	$m_references=NULL;
	
	// methods
	public function  	addReferenceID( $id, $strfilename ){ 	
		if( $id != NULL && isset( $id ) != false )
			$this->m_references[$id] = $this->m_filepathparams[$strfilename];	
		return true;
	} // end addEx()
	
	public function 	compile(){
	} // end compile()
	
	public function 	combine(){
	} // end combine()
	
	public function 	minimize(){
	} // end minimize()
	
	public function 	contents($id){
		return ( $id == NULL || isset( $id ) == false || !$this->m_references || 
				!( $params = $this->m_references[$id] ) || ( isset( $params["filename"] ) == false ) ) 
				? "" : file_get_contents( $params["filename"] );
	} // end contents()	
} // end class CIncludeXMLFiles

//-----------------------------------------------------------------------
// name: include_xml()
// desc: includes files relative to the where all the files are located
//-----------------------------------------------------------------------
function include_xml( $id, $strfilename, $params=NULL ){
	$ret = CIncludeFiles :: includefiles( "CIncludeXMLFiles", $strfilename, $params=NULL );
	$cincludefiles = CIncludeFiles :: getCIncludeFiles( "CIncludeXMLFiles" );
	if( $cincludefiles )
		$cincludefiles->addReferenceID( $id, $strfilename );
	return $ret;
} // end include_xml()

//--------------------------------------------------------------
// name: contents_xml()
// desc: returns the contents of the included xml
//--------------------------------------------------------------
function contents_xml( $id ){
	return CIncludeXMLFiles :: contents($id);
} // end usexml()

// include the first js file
include_js(relname(__FILE__).'/cincludexmlfiles.js');	
?>