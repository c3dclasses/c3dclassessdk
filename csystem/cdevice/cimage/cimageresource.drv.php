<?php
//---------------------------------------------------------
// file: cimageresource.drv.php
// desc:
//---------------------------------------------------------

//------------------------------------------------------
// name: CImageResource_preLoad_toString()
// desc: creates a script to preload images
//------------------------------------------------------
function CImageResource_preLoad_toString( $id, $cresource ){ 
	$p = $cresource->getParams();
	if( !$p || !($p->get("cresource_type") == "CImageResource") ) // check if the resource is an image object
		return "";
	$json = $cresource->getParams()->toJSON();
	$str = "include_image(\"{$id}\",\"".uri_name($cresource->path())."\",'CImage'," . $cresource->getParams()->toJSON() . ")";
	$str .= "\n";
	return $str;		
} // end CImageResource_preLoad_toString()

// add a hook to preload memory 
function cimageresource_preload(){ return CResource :: toStringVisit( "CImageResource_preLoad_toString" ); }  
CHook :: add( "script", "cimageresource_preload" ); 
?>