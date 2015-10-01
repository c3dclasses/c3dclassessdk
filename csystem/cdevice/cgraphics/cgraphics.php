<?php
//---------------------------------------------------------
// file: cgraphics.php
// desc: 
//---------------------------------------------------------

class C2DGraphics{
	
	// create overlays in images on serverside
	// strokelinecap
	// strokedasharray
	// filter
	// iphoto
	
	protected $m_image;
	public function width(){ return imagex( $this->m_image ); }
	public function height(){ return imagey( $this->m_image ); }
	 
	public function create(){ imagecreatefromjpeg(); }
	public function create(){ imagecreatetruecolor(); }
	public function destoy(){ imagedestroy(); }
	
	public function saveToJPEG(){ imagejpeg(); }
	public function saveToPNG(){ imagepng(); }
	
	// imageddashline	
	public function stroke($color,$thickness){} // m_attr[fill], m_attr[stroke], 
	public function opacity(){}
	public function fill($color){} 
	public function position( $posx, $posy ){}
	public function style(){} // stroke_width: 3; stroke: rgb(0,0,0); stoke_opacity: ; fill: blue; stroke:pink;
	public function font( $size, $family ){}
	
	public function transform(){;} // rotate(30,20,40))
	public function begin( $width, $height ){}
	public function end(){}
	
	// imagecolorallocate(); 
	// imagecopy()
	
	public function moveTo(){}
	public function lineTo(){}
	public function horizontalLineTo(){}
	public function verticalLineTo(){}
	public function verticalLineTo(){}
	public function curveTo(){}
	public function smoothCurveTo(){}
	public function ellipticalAve(){}
	public function closePath(){}
	
	
	// draw
	public function drawCircle( $cx, $cy, $r ){}
	public function drawRect( $w, $h, $x, $y ){}
	public function drawEllipse( $cy, $cx, $rx, $ry ){}
	public function drawLine( $cy, $cx, $rx, $ry ){ imageline(); }		// x1,x2, y1,y2, style 	
	public function drawPolygon( $cy, $cx, $rx, $ry ){}		// points = 200,10,250,190,160,210
	public function drawPolyline( $cy, $cx, $rx, $ry ){}	// points = 200,10,250,190,160,210	fill-rule: none-zero, even-odd
	public function drawText( $strtext ){ imagestring(); }
	public function resize(){ imagecopyresize(); }
		
} // end CGraphics

?>