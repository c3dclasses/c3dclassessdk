//---------------------------------------------------------
// file: cimageresource.js
// desc: defines image resource object
//---------------------------------------------------------

//---------------------------------------------------------
// file: CImageResource
// desc: defines image resource object
//---------------------------------------------------------
var CImageResource = new Class({
	Extends: CResource,  
	intialize : function() { 
		this.parent();
		this.m_cimage=null;
	}, // end CImageResource() 
	
	open : function(strpath, params){
		var cimage=null;
		if(( params && 
			( params["cimage_type"] ) &&
			( cimage = new window[params["cimage_type"]] ) &&
			( cimage.create( strpath ) ) &&
			( this.parent( strpath, params ) ) &&
			( this.m_cimage = cimage )))
			return true;
		else
			return false;
	}, // end open()
	
	restore : function(){ 
		return this.open( this.m_hashparams.get( "cresource_path" ), this.m_hashparams.valueOf() ); 
	}, // end restore()
	
	_toString : function(){ 
		return ""; 
	}, // end toString() 
	
	get : function(){
		return this.m_cimage;
	} // end _()
}); // end CImageResource

function include_image( strid, strpath, strtype, params ) {
	if(!params) params = {};
	params["cresource_type"] = "CImageResource";
	params["cimage_type"] = strtype;
	return include_resource( strid, strpath, params );
} // end include_memory()

function use_image( strid ){
	return use_resource( strid );
} // end use_memory()
