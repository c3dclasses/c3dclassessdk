//---------------------------------------------------
// file: csize.js
// desc: defines a size object 
//---------------------------------------------------

//------------------------------------------------------
// name: CSize
// desc: defines a object that stores size information
//------------------------------------------------------
var CSize = new Class({	
	initialize : function(w, h, l) {
		this.set(w, h, l) ; 
	}, // end CPoint()
	set:function(w, h, l) { 
		this.w = w; 
		this.h = h; 
		this.l = l; 
	}, // end set
	scale:function(sw, sh, sl) { 
		this.w *= sw; 
		this.h *= sh; 
		this.l *= sl; 
	} // end scale()
}); // end CSize