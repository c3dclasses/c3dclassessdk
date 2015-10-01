<?php
//---------------------------------------------------------
// file: csvggraphics.php
// desc: 
//---------------------------------------------------------
class CSVGElement{
	public function CSVGGraphics(){
		
	} // end CSVGGraphics()
	
	public function stroke($color,$thickness){} 
	public function opacity(){}
	public function fill($color){} 
	public function position( $posx, $posy ){}
	public function style(){} // stroke_width: 3; stroke: rgb(0,0,0); stoke_opacity: ; fill: blue; stroke:pink;
	
	
	
	public function begin(){}
	public function end(){}
	
	
	// draw
	public function drawCircle( $cx, $cy, $r ){}
	public function drawRect( $w, $h, $x, $y ){}
	public function drawEllipse( $cy, $cx, $rx, $ry ){}
	
	
	
	
} // end CSVGGrahics

?>