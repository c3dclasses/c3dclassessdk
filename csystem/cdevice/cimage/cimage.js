//---------------------------------------------------------
// file: cimage.js
// desc: defines an image object
//---------------------------------------------------------

//---------------------------------------------------------
// file: CImage
// desc: defines an image object
//---------------------------------------------------------
var CImage = new Class({
	intialize : function() { 
		this.m_image=null;
	}, // end CImage() 
	
	createBlank : function(width,height){
		var image = new Image(width, height);
		if(!image)
			return false;
		this.m_image=image;
		return true;
	}, // end createBlank()
	
	create : function(strfilename) {
		var ret = this.createBlank();
		if(!strfilename)
			return ret;
		this.m_image.src = strfilename;
		return ret;
	}, // end create()
	
 	getSize : function() { 
		return new CSize( this.m_image.naturalHeight, this.m_image.naturalWidth );
	}, // end getSize()
	
	saveToFile : function( $strfilename ){
	} // end saveToFile()	
}); // end CImage