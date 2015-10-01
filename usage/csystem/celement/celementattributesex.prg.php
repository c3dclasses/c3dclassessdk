<?php
//---------------------------------------------------------------------------
// name: celementattributesex.prg.php
// desc: demonstrates how to use CElement
//---------------------------------------------------------------------------

// includes
include_program( "CElementAttributesExProgram" );

//---------------------------------------------------
// name: CElementAttributesExProgram
// desc: celementattributesex program demo
//---------------------------------------------------
class CElementAttributesExProgram extends CProgram{
	public function CElementAttributesExProgram(){ 
		parent :: CProgram();
		$this->html("hello, world");
		$this->css("height", "200px");
		$this->linearGradient( "45deg, red 30%, blue 30%, orange 40%");		// direction / degree / 
		//$this->linearGradient( "red 60%, blue 30%, orange 10%", "90deg");		// direction / degree / 
		//$this->radialGradient( "red, blue, green" );		// direction / degree / 
		
		$this->repeatingRadialGradient("red, yellow 10%, green 15%");
		
		
		
		//$this->backgroundColor("blue");
		$this->css("color","yellow");
		$this->pcss("hover", "color", "red");
		
		$this->transition("hover","height","500px","200px");
		$this->transition("hover","width","100%","50%");
		
		
		//$this->backgroundImage( array( "http://www.w3schools.com/cssref/img_tree.gif", "http://www.w3schools.com/cssref/img_flwr.gif" ));
		//$this->borderImage( "url(http://www.w3schools.com/cssref/border.png) 30 30 stretch" );
	} // end CElementProgram()
	
	public function c_main(){ 
return <<<JSCRIPT
JSCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("hello, inside the body of the element");
return ob_end();
	} // end innerhtml()
} // end CElementAttributesExProgram
?>