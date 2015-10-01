<?php
//-------------------------------------------------------------------------------
// file: cgeometry.php
// desc: defines a set of classes that describe an object's 2D or 3D geometry 
//-------------------------------------------------------------------------------

// includes
include_js( relname(__FILE__) . '/cgeometry.js' ); 

//--------------------------------------------------------
// name: CPoint
// desc: defines and object that stores position info
//--------------------------------------------------------
class CPoint{
	public function CPoint( $x=0, $y=0, $z=0 ){ 
		$this->set( $x, $y, $z ); 
	} // end CPoint()
	public function set( $x, $y, $z ){ 
		$this->x = $x; 
		$this->y = $y; 
		$this->z = $z; 
	} // end set()
	public function translate( $dx, $dy, $dz ){ 
		$this->x += $dx; 
		$this->y += $dy; 
		$this->z += $dz; 
	} // end translate()
	public function rotate(){
	} // end rotate()
	public 	$x;
	public 	$y;
	public  $z;	
} // end CPoint

//------------------------------------------------------
// name: CSize
// desc: defines a object that stores size information
//------------------------------------------------------
class CSize{
	public function CSize( $w=0, $h=0, $l=0 ){ 
		$this->set( $w, $h, $l ); 
	} // end CSize()
	public function set( $w, $h, $l ){ 
		$this->w = $w; 
		$this->h = $h; 
		$this->l = $l; 
	} // end set
	public function scale( $sw, $sh, $sl ){ 
		$this->w += $sw; 
		$this->h += $sh; 
		$this->l += $sl; 
	} // end scale()
	public $w;
	public $h;
	public $l;	
} // end CSize

//--------------------------------------------------------------
// name: CRectangle
// desc: defines an region that consist of a position and size
//--------------------------------------------------------------
class CRectangle{
	public function CRectangle(){ 
		$this->pos = new CPoint(); 
		$this->size = new CSize(); 
	} // end CRectangle()
	
	public function set( $x, $y, $z, $w, $h, $l ){ 
		if( getClassOf( $x ) == "CRectangle" )
			return $this->set( $x->pos->x, $x->pos->y, $x->pos->z, $x->size->w, $x->size->h, $x->size->l ); 
		$this->pos->set( $x, $y, $z ); 
		$this->size->set( $w, $h, $l ); 
		return $this;
	} // end set()
	
	//----------------------------------------------------------------------------------
	// name: align()
	// desc: aligns a rectamgle in relation to another rect
	// input: increct - the to align this rect against, inialignment - how to align
	// output: this
	//----------------------------------------------------------------------------------
	public function align( $increct, $inialignment ){
		if( $increct == NULL || $increct == $this )
			return $this;
		$c = CConstants :: $ABOVE | CConstants :: $BELOW | CConstants :: $RSIDE | CConstants :: $LSIDE;
		$x1 = $this->pos->x; 
		$y1 = $this->pos->y; 
		$z1 = $this->pos->z; 
		$w1 = $this->size->w; 
		$h1 = $this->size->h;
		$l1 = $this->size->l;
		$x2 = $increct->pos->x; 
		$y2 = $increct->pos->y; 
		$z2 = $increct->pos->z; 
		$w2 = $increct->size->w; 
		$h2 = $increct->size->h;
		$l2 = $increct->size->l;

		// do inside alignment
		if( !( $inialignment &  $c ) ) {
			// horizontal alignment
			if( $inialignment & CConstants :: $LEFT ) $x1 = $x2;
			else if( $inialignment & CConstants :: $RIGHT ) $x1 = $x2 + abs( $w2 - $w1 );
			else if( $inialignment & CConstants :: $HCENTER ) $x1 = $x2 + ( abs( $w2 - $w1 ) >> 1 );
			// vertical alignment
			if( $inialignment & CConstants :: $TOP ) $y1 = $y2;
			else if( $inialignment & CConstants :: $BOTTOM ) $y1 = $y2 + abs( $h2 - $h1 );
			else if( $inialignment & CConstants :: $VCENTER ) $y1 = $y2 + ( abs( $h2 - $h1 ) >> 1 );		
		} // end if()
		
		// do outside alignment
		else{
			// verticle
			if( $inialignment & CConstants :: $ABOVE ){
				$y1 = $y2 - $h1;
				if( $inialignment & CConstants :: $LEFT ) $x1 = $x2;
				else if( $inialignment & CConstants :: $RIGHT ) $x1 = $x2 + $w2 - $w1;
				else if( $inialignment & CConstants :: $CENTER ) $x1 = $x2 + ( ( $w2 - $w1 ) >> 1 );
			} // end if	
			else if( $inialignment & CConstants :: $BELOW ){
				$y1 = $y2 + $w2;
				if( $inialignment & CConstants :: $LEFT ) $x1 = $x2;
				else if( $inialignment & CConstants :: $RIGHT ) $x1 = $x2 + $w2 - $w1;
				else if( $inialignment & CConstants :: $CENTER ) $x1 = $x2 + ( ( $w2 - $w1 ) >> 1 );
			} // end if
			// horizontal
			if( $inialignment & CConstants :: $LSIDE ){
				$x1 = $x2 - $w1;
				if( $inialignment & CConstants :: $TOP ) $y1 = $y2;	
				else if( $inialignment & CConstants :: $BOTTOM ) $y1 = $y2 + $w2 - $h1;
				else if( $inialignment & CConstants :: $CENTER ) $y1 = $y2 + ( ( $w2 - $h1 ) >> 1 );
			} // end if
			else if( $inialignment & CConstants :: $RSIDE ){
				$x1 = $x2 + $w2;
				if( $inialignment & CConstants :: $TOP ) $y1 = $y2;
				else if( $inialignment & CConstants :: $BOTTOM ) $y1 = $y2 + $w2 - $h1;
				else if( $inialignment & CConstants :: $CENTER ) $y1 = $y2 + ( ( $w2 - $h1 ) >> 1 );
			} // end if
		} // end else		
		
		$this->pos->x = $x1;
		$this->pos->y = $y1;
		$this->pos->z = $z1;
		$this->size->w = $w1;
		$this->size->h = $h1;
		$this->size->l = $l1;
		return $this;
	} // end align()
	
	//-----------------------------------------------------------------------------------------
	// name: inset()
	// input: iniinsetx, iniinsety, iniinsetz - the amount to adjust
	// output: none
	// desc: adjust the inset dimension of this region by shrinking or growing the rect
	//-----------------------------------------------------------------------------------------
	public function inset( $iniinsetx=0, $iniinsety=0, $iniinsetz=0 ){
		if ( !$iniinsetx || !$iniinsety || !$iniinsetz )
			return $this;
		$this->pos->translate( $iniinsetx, $iniinsety, $iniinsetz );
		$this->size->scale( -($iniinsetx*2), -($iniinsety*2), -($iniinsetz*2) );
		return $this;
	} // end inset()
	
	//----------------------------------------------------------------------------------------------
	// name: adjust()
	// desc: aligns the size of this rectangle with another rectangle
	//----------------------------------------------------------------------------------------------
	public function adjust( $increct, $inialignmentsize ){
		if (!$increct || !$inialignmentsize || $increct==$this)
			return $this;
		$w1 = $this->size->w;
		$h1 = $this->size->h;
		$l1 = $this->size->l;
		$w2 = $increct->size->w;
		$h2 = $increct->size->h;
		$l2 = $increct->size->l;
		// adjust the width, height, length of region1
		if ($inialignmentsize & CConstants::$WIDTH) $w1 = $w2;
		if ($inialignmentsize & CConstants::$HEIGHT) $h1 = $h2;
		if ($inialignmentsize & CConstants::$LENGTH) $l1 = $l2;
		// set the size of region1
		$this->size->w = $w1;
		$this->size->h = $h1;
		$this->size->l = $h1;	
		return $this;
	} // end alignSize()
	
	//---------------------------------------------------------------------------------
	// name: map()
	// desc: readjust the dimensions of this region to fit within $increct region.
	// note: this region's porportions are maintained 
	//---------------------------------------------------------------------------------
	public function map( $increct ){
		if ( !$increct || $increct == $this)
			return $this;
		$w1 = $this->size->w;
		$h1 = $this->size->h;
		$l1 = $this->size->l;
		$w2 = $increct->size->w;
		$h2 = $increct->size->h;
		$l2 = $increct->size->l;
		
		// if the dimensions aren't don't do any adjustments 
		if( $w1 < 1 || $h1 < 1 || $w2 < 1 || $h2 < 1 )
			return $this;
		// if this dimension is bigger than the destination dimension don't do any adjustments 
		if( $w2 < $w1 && $h2 < $h1 ) 
			return $this;
		// do the mapping 
		if( $w1 >= $h1 ){
			$h1 = ( ( $h1 / $w1 ) * $w2 );
			$w1 = $w2;
		} // end if
		else {
			$w1 = ( ( $w1 / $h1 ) * $h2 );
			$h1 = $h2;
		} // else

		$this->size->w = $w1;
		$this->size->h = $h1;
		$this->size->l = $l1;
		return $this;
	} // end map()
	
	////////////////////////////////
	// intersection testing 

	//-----------------------------------------------------------------------------
	// name: intersectCPoint()
	// desc: test if a CPoint intersects a CRectangle or vice versa
	//-----------------------------------------------------------------------------
	public function intersectCPoint( $cpoint ){
		return ( $cpoint == NULL ) ? false : CMath::in( $cpoint->x, $this->pos->x, $this->pos->x + $this->size->w ) &&	// test x
			CMath::in( $cpoint->y, $this->pos->y, $this->pos->y + $this->size->h ); //test y		
	} // end intersectCPoint()
	
	//-----------------------------------------------------------------------------
	// name: intersectCRectangle()
	// desc: checks if the this rectangle intersects with the incoming rectangle
	//-----------------------------------------------------------------------------
	public function intersectCRectangle( $crectangle ){
		return ( $crectangle == NULL || $this == $crectangle ) ? false :
			( CMath::in( $crectangle->pos->x, $this->pos->x, $this->pos->x + $this->size->w ) ||
			CMath::in( $crectangle->pos->x + $crectangle->size->w, $this->pos->x, $this->pos->x + $this->size->w ) ) &&	// test x
			( CMath::in( $crectangle->pos->y, $this->pos->y, $this->pos->y + $this->size->h ) ||
			CMath::in( $crectangle->pos->y + $crectangle->size->h, $this->pos->y, $this->pos->y + $this->size->h ) ); // test y	  
	} // end intersectCRectangle()
	public $pos;
	public $size;
} // end CRectangle
?>