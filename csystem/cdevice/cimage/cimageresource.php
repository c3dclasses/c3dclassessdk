<?php
//---------------------------------------------------------
// file: cimageresource.php
// desc: defines image resource object
//---------------------------------------------------------

//---------------------------------------------------------
// file: CImageResource
// desc: defines image resource object
//---------------------------------------------------------
class CImageResource extends CResource{
	// members
	protected $m_cimage;
	public function CImageResource(){
		$this->m_cimage = NULL;
	} // end CImage()	
	
	public function open( $strpath, $params ){
		return $params && 
		isset( $params["cimage_type"] ) &&
		( $cimage = new $params["cimage_type"] ) &&
		( $cimage->create( $strpath ) ) &&
		( parent :: open( $strpath, $params ) ) &&
		( $this->m_cimage = $cimage );
	} // end open()
	
	public function restore(){ 
		return $this->open( $this->m_hashparams->get( "cresource_path" ), $this->m_hashparams->valueOf() ); 
	} // end restore()
	
	public function toString(){ 
		return ""; 
	} // end toString() 
	
	public function get(){
		return $this->m_cimage;
	} // end _()
} // end CImage

function include_image( $strid, $strpath, $strtype, $params=NULL ){
	$params["cresource_type"] = "CImageResource";
	$params["cimage_type"] = $strtype;
	return include_resource( $strid, $strpath, $params );
} // end include_memory()

function use_image( $strid ){
	return use_resource( $strid );
} // end use_memory()
?>