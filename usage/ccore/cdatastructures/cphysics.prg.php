<?php
//---------------------------------------------------------------------------
// name: cphysics.prg.php
// desc: demonstrates how to use the geometry objects
//---------------------------------------------------------------------------

// includes
include_program( "CPhysicsProgram" );

//---------------------------------------------------
// name: CPhysicsProgram
// desc: hello world program
//---------------------------------------------------
class CPhysicsProgram extends CProgram{
	public function CPhysicsProgram(){ 
		parent :: CProgram();
		$this->css("background", "grey");	
		$this->css("width", "100%");	
		$this->css("height", "1000px");	
		$this->css("border", "1px solid black" );
		$this->css("position", "relative" );
		$this->css("overflow", "auto" );
		$this->css("z-index", "-10" );
	} // end CGeometryProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr("", this.getElement() );
	printbr( "<b>cgeometry.js - testing</b>", this.getElement() );
	var xoffset=600;
	var cpoint = new CPoint();
	cpoint.set( xoffset + 300, 300, 300 );
	drawCPoint( cpoint, "red", 0, this.getElement() );
		
	var crectangle = new CRectangle();
	crectangle.set( xoffset + 100, 100, 0, 200, 200, 200 );
	drawCRectangle( crectangle, "blue", 1, this.getElement() );
	
	var crectangle2 = new CRectangle();
	crectangle2.set( xoffset + 120, 120, 0, 50, 50, 50 );
	crectangle2.align( crectangle, CConstants.BOTTOM | CConstants.RIGHT );
	drawCRectangle( crectangle2, "orange", 2, this.getElement() );

	crectangle2.inset( 10, 10, 10 );
	drawCRectangle( crectangle2, "pink", 3, this.getElement() );
		
	var crectangle3 = new CRectangle();
	crectangle3.set( xoffset + 350, 350, 0, 30, 30, 30 );
	crectangle3.adjust( crectangle, CConstants.WIDTH );
	drawCRectangle( crectangle3, "green", 4, this.getElement() );
		
	var crectangle4 = new CRectangle();
	crectangle4.set( xoffset + 800, 800, 0, 20, 100, 30 );
	drawCRectangle( crectangle4, "purple", 5, this.getElement() );
	crectangle4.pos.set( xoffset + 50,50,50);
	crectangle4.map( crectangle );
	drawCRectangle( crectangle4, "gold", 6, this.getElement() );	
		
	// check intersection
	if( crectangle.intersectCRectangle( crectangle2 ) )
		printbr("1 and 2 intersect", this.getElement());
	else printbr("1 and 2 don't rectangles intersect", this.getElement());
	if( crectangle.intersectCRectangle( crectangle4 ) )
		printbr("1 and 4 intersect",this.getElement() );
	else printbr("1 and 4 dont rectangles intersect", this.getElement());	
	if( crectangle.intersectCPoint( cpoint ) )
		printbr("1 and cpoint intersect", this.getElement());
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
		ob_start();
		printbr( "<b>cgeometry.php - testing</b>" );
		print( "<span style='position:absolute; right:0; bottom:0;'>(500,500)</span>" );
		
		$cpoint = new CPoint();
		$cpoint->set( 300, 300, 300 );
		drawCPoint( $cpoint, "red", 0 );
		
		$crectangle = new CRectangle();
		$crectangle->set( 100, 100, 0, 200, 200, 200 );
		drawCRectangle( $crectangle, "blue", 1 );
		
		$crectangle2 = new CRectangle();
		$crectangle2->set( 120, 120, 0, 50, 50, 50 );
		$crectangle2->align( $crectangle, CConstants :: $BOTTOM | CConstants :: $RIGHT );
		drawCRectangle( $crectangle2, "orange", 2 );

		$crectangle2->inset( 10, 10, 10 );
		drawCRectangle( $crectangle2, "pink", 3 );
		
		$crectangle3 = new CRectangle();
		$crectangle3->set( 350, 350, 0, 30, 30, 30 );
		$crectangle3->adjust( $crectangle, CConstants :: $WIDTH );
		drawCRectangle( $crectangle3, "green", 4 );
		
		$crectangle4 = new CRectangle();
		$crectangle4->set( 800, 800, 0, 20, 100, 30 );
		drawCRectangle( $crectangle4, "purple", 5 );
		$crectangle4->pos->set(50,50,50);
		$crectangle4->map( $crectangle );
		drawCRectangle( $crectangle4, "gold", 6 );	
		
		// check intersection
		if( $crectangle->intersectCRectangle( $crectangle2 ) )
			printbr("1 and 2 intersect");
		else printbr("1 and 2 don't rectangles intersect");
		if( $crectangle->intersectCRectangle( $crectangle4 ) )
			printbr("1 and 4 intersect");
		else printbr("1 and 4 dont rectangles intersect");	
		if( $crectangle->intersectCPoint( $cpoint ) )
			printbr("1 and cpoint intersect");
		else printbr("1 and cpoint don't rectangles intersect");
		
		return ob_end();
	} // end innerhtml()
} // end CPhysicsProgram

//------------------------------------------------------
// name: drawCRectangle()
// desc: draws a rectangle
//------------------------------------------------------
function drawCRectangle( $crectangle, $color, $label ){
	$x = $crectangle->pos->x;
	$y = $crectangle->pos->y;
	$w = $crectangle->size->w;
	$h = $crectangle->size->h;
	$style = "position:absolute;top:{$y}px;left:{$x}px;width:{$w}px;height:{$h}px;background:{$color};border:1px solid #333;z-index:-1;";
	print("<div class='crectangle' style='{$style}'>{$label}</div>");
} // end drawCRectangle()

//------------------------------------------------------
// name: drawCPoint
// desc: draws a point
//------------------------------------------------------
function drawCPoint( $cpoint, $color, $label ){
	$size = 10;
	$crectangle = new CRectangle();
	$crectangle->set( $cpoint->x-($size/2), $cpoint->y-($size/2), $cpoint->z-($size/2), $size, $size, $size );
	drawCRectangle( $crectangle, $color, $label );
} // end drawCPoint()

// put script code here
ob_start();
?>
<script parse="true" location="footer">
//------------------------------------------------------
// name: drawCRectangle()
// desc: draws a rectangle
//------------------------------------------------------
function drawCRectangle( crectangle, color, label, dst ){
	var x = crectangle.pos.x;
	var y = crectangle.pos.y;
	var w = crectangle.size.w;
	var h = crectangle.size.h;
    var style = "position:absolute;\
    			 top:"+y+"px;\
                 left:"+x+"px;\
                 width:"+w+"px;\
                 height:"+h+"px;\
                 background:"+color+";\
                 border:1px solid #333;";
	var str = "<div class=\"crectangle\" style=\""+style+"\">"+label+"</div>";
	_print( str, dst );
} // end drawCRectangle()

//------------------------------------------------------
// name: drawCPoint
// desc: draws a point
//------------------------------------------------------
function drawCPoint( cpoint, color, label, dst ){
	var size = 10;
	crectangle = new CRectangle();
	crectangle.set( cpoint.x-(size/2), cpoint.y-(size/2), cpoint.z-(size/2), size, size, size );
	drawCRectangle( crectangle, color, label, dst );
} // end drawCPoint()
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later