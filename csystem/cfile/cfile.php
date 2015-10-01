<?php
//------------------------------------------------------------------------------------
// file: cfile.php
// desc: opens input and/or output files that can be used globally throughout the SDK
//------------------------------------------------------------------------------------

//-------------------------------------------------------
// name: CFile
// desc: input and output file resource
//-------------------------------------------------------
class CFile extends CResource {
	// members
	protected 		 $m_file;				
	// methods
	public function CFile(){
		parent :: CResource();
		$this->m_file = NULL;
	} // end CFile()
	public function open( $strpath, $params ){
		return ( !( $this->m_file = fopen( $strpath, $params["mode"] ) ) ) ? false : 
		( parent :: open( $strpath, $params ) );	
	} // end open()
	public function close(){
		if( $this->m_file )
			fclose( $this->m_file );
	} // end close()	
	public function printbr( $str="" ){ 
		if( $this->m_file )
			fwrite( $this->m_file, $str . "<br />" ); 
	} // end printbr()
	public function println( $str="" ){
		if( $this->m_file )
			fwrite( $this->m_file, $str . "\n" ); 
	} // end println()
} // end CFile

function include_file($strid, $strpath, $strmode){
	$params = array( "mode"=>$strmode, "cresource_type"=>"CFile" );
	return include_resource( $strid, $strpath, $params );
} // end includeiofile()

function use_file($strid){
	return use_resource( $strid );
} // end includeiofile()
?>