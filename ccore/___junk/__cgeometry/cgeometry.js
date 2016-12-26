//-------------------------------------------------------------------------------
// file: cgeometry.js
// desc: defines a set of classes that describe an object's 2D or 3D geometry 
//-------------------------------------------------------------------------------

//--------------------------------------------------------
// name: CPoint
// desc: defines and object that stores position info
//--------------------------------------------------------
var CPoint = new Class({
	initialize : function( x, y, z ){
		this.set( x, y, z );
	}, // end CPoint()
	set : function( x, y, z ){ 
		this.x = x;
		this.y = y;
		this.z = z;	
	}, // end set()
	translate : function( dx, dy, dz ){ 
		this.x += dx; 
		this.y += dy; 
		this.z += dz; 
	}, // end translate()
	rotate : function(){
	} // end rotate()
}); // end CPoint

//------------------------------------------------------
// name: CSize
// desc: defines a object that stores size information
//------------------------------------------------------
var CSize = new Class({	
	initialize : function( w, h, l ){
		this.set( w, h, l ); 
	}, // end CPoint()
	set:function( w, h, l ){ 
		this.w = w; 
		this.h = h; 
		this.l = l; 
	}, // end set
	scale:function( sw, sh, sl ){ 
		this.w += sw; 
		this.h += sh; 
		this.l += sl; 
	} // end scale()
}); // end CSize

//---------------------------------------------------------------------------
// name: CRectangle
// desc: defines an region that consist of a position and size
//---------------------------------------------------------------------------
var CRectangle = new Class({
	initialize : function(){
		this.pos = new CPoint();
		this.size = new CSize();
	}, // end CRectangle()
	
	set : function( x, y, z, w, h, l ){
		if( getClassOf( x ) == "CRectangle" )
			return this.set( x.pos.x, x.pos.y, x.pos.z, x.size.w, x.size.h, x.size.l );
		this.pos.set(x,y,z);
		this.size.set(w,h,l);
		return this;
	}, // end set()
	
	//----------------------------------------------------------------------------------
	// name: align()
	// desc: aligns a rectamgle in relation to another rect
	// input: increct - the to align this rect against, inialignment - how to align
	// output: this
	//----------------------------------------------------------------------------------
	align: function (increct, inialignment) {
		if (increct == null || this == increct)
			return this;
		var c = CConstants.ABOVE | CConstants.BELOW | CConstants.RSIDE | CConstants.LSIDE;
		var x1 = this.pos.x;
		var y1 = this.pos.y;
		var z1 = this.pos.z;
		var w1 = this.size.w;
		var h1 = this.size.h;
		var l1 = this.size.l;
		var x2 = increct.pos.x;
		var y2 = increct.pos.y;
		var z2 = increct.pos.z;
		var w2 = increct.size.w;
		var h2 = increct.size.h;
		var l2 = increct.size.l;
	
		// do inside alignment
		if (!(inialignment & c)) {
			// horizontal alignment
			if (inialignment & CConstants.lEFT) x1 = x2;
			else if (inialignment & CConstants.RIGHT) x1 = x2 + Math.abs(w2 - w1);
			else if (inialignment & CConstants.HCENTER) x1 = x2 + (Math.abs(w2 - w1) >> 1);
	
			// vertical alignment
			if (inialignment & CConstants.TOP) y1 = y2;
			else if (inialignment & CConstants.BOTTOM) y1 = y2 + Math.abs(h2 - h1);
			else if (inialignment & CConstants.VCENTER) y1 = y2 + (Math.abs(h2 - h1) >> 1);
		} // end if()
		// do outside alignment
		else {
			// verticle
			if (c & CConstants.ABOVE) {
				y1 = y2 - h1;
				if (inialignment & CConstants.lEFT) x1 = x2;
				else if (inialignment & CConstants.RIGHT) x1 = x2 + w2 - w1;
				else if (inialignment & CConstants.CENTER) x1 = x2 + ((w2 - w1) >> 1);
			} // end if	
			else if (inialignment & CConstants.BELOW) {
				y1 = y2 + w2;
				if (inialignment & CConstants.lEFT) x1 = x2;
				else if (inialignment & CConstants.RIGHT) x1 = x2 + w2 - w1;
				else if (inialignment & CConstants.CENTER) x1 = x2 + ((w2 - w1) >> 1);
			} // end if
			// horizontal
			if (inialignment & CConstants.LSIDE) {
				x1 = x2 - w1;
				if (inialignment & CConstants.TOP) y1 = y2;
				else if (inialignment & CConstants.BOTTOM) y1 = y2 + w2 - h1;
				else if (inialignment & CConstants.CENTER) y1 = y2 + ((w2 - h1) >> 1);
			} // end if
			else if (inialignment & CConstants.RSIDE) {
				x1 = x2 + w2;
				if (inialignment & CConstants.TOP) y1 = y2;
				else if (inialignment & CConstants.BOTTOM) y1 = y2 + w2 - h1;
				else if (inialignment & CConstants.CENTER) y1 = y2 + ((w2 - h1) >> 1);
			} // end if
		} // end else
	
		this.pos.x = x1;
		this.pos.y = y1;
		this.pos.z = z1;
		this.size.w = w1;
		this.size.h = h1;
		this.size.l = l1;
		return this;
	}, // end align()

	//-----------------------------------------------------------------------------------------
	// name: inset()
	// input: iniinsetx, iniinsety, iniinsetz - the amount to adjust
	// output: this
	// desc: adjust the inset dimension of this region by shrinking or growing the rect
	//-----------------------------------------------------------------------------------------
	inset: function (iniinsetx, iniinsety, iniinsetz) {
		if(!iniinsetx || !iniinsety || !iniinsetz)
			return this;
		this.pos.translate(iniinsetx, iniinsety, iniinsetz);
		this.size.scale(-(iniinsetx*2), -(iniinsety*2), -(iniinsetz*2));
		return this;
	}, // end inset()
	
	//----------------------------------------------------------------------------------------------
	// name: adjust()
	// desc: aligns the size of this region with another region
	//----------------------------------------------------------------------------------------------
	adjust: function (increct, inialignmentsize) {
		if (!increct || !inialignmentsize)
			return this;
		var w1 = this.size.w;
		var h1 = this.size.h;
		var l1 = this.size.l;
		var w2 = increct.size.w;
		var h2 = increct.size.h;
		var l2 = increct.size.l;
		// adjust the width, height, length of region1
		if (inialignmentsize & CConstants.WIDTH) w1 = w2;
		if (inialignmentsize & CConstants.HEIGHT) h1 = h2;
		if (inialignmentsize & CConstants.LENGTH) l1 = l2;
		// set the size of region1
		this.size.w = w1;
		this.size.h = h1;
		this.size.l = h1;	
		return this;
	}, // end alignSize()
	
	//---------------------------------------------------------------------------------
	// name: map()
	// desc: readjust the dimensions of this region to fit within increct region.
	// note: this region's porportions are maintained 
	//---------------------------------------------------------------------------------
	map: function (increct) {
		if (!increct)
			return this;
		var w1 = this.size.w;
		var h1 = this.size.h;
		var l1 = this.size.l;
		var w2 = increct.size.w;
		var h2 = increct.size.h;
		var l2 = increct.size.l;
			
		// if the dimensions aren't don't do any adjustments 
		if (w1 < 1 || h1 < 1 || w2 < 1 || h2 < 1)
			return this;
		// if this dimension is bigger than the destination dimension don't do any adjustments 
		if (w2 < w1 && h2 < h1)
			return this;
		// do the mapping 
		if (w1 >= h1) {
			h1 = ((h1 / w1) * w2);
			w1 = w2;
		} // end if
		else {
			w1 = ((w1 / h1) * h2);
			h1 = h2;
		} // else
	
		this.size.w = w1;
		this.size.h = h1;
		this.size.l = l1;
		return this;
	}, // end map()
	
	////////////////////////////////
	// intersection testing 
	
	//-----------------------------------------------------------------------------
	// name: intersectCPoint()
	// desc: test if a CPoint intersects a CRectangle or vice versa
	//-----------------------------------------------------------------------------
	intersectCPoint: function (cpoint) {
		return (cpoint == null) ? false : CMath. in (cpoint.x, this.pos.x, this.pos.x + this.size.w) && // test x  
			CMath.in (cpoint.y, this.pos.y, this.pos.y + this.size.h); //test y		
	}, // end intersectCPoint()
	
	//-----------------------------------------------------------------------------
	// name: intersectCRectangle()
	// desc: checks if the this rectangle intersects with the incoming rectangle
	//-----------------------------------------------------------------------------
	intersectCRectangle: function (crectangle) {
		return (crectangle == null || this == crectangle) ? false :
			(CMath.in (crectangle.pos.x, this.pos.x, this.pos.x + this.size.w) ||
			CMath.in (crectangle.pos.x + crectangle.size.w, this.pos.x, this.pos.x + this.size.w)) && // test x
			(CMath.in (crectangle.pos.y, this.pos.y, this.pos.y + this.size.h) ||
			CMath.in (crectangle.pos.y + crectangle.size.h, this.pos.y, this.pos.y + this.size.h)); // test y	  
	} // end intersectCRectangle()
}); // end CRectangle