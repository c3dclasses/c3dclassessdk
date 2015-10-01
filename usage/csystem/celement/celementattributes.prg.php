<?php
//---------------------------------------------------------------------------
// name: celementattributes.prg.php
// desc: demonstrates how to use CElement
//---------------------------------------------------------------------------

// includes
include_program( "CElementAttributesProgram" );

//---------------------------------------------------
// name: CElementAttributesProgram
// desc: celementattributesex program demo
//---------------------------------------------------
class CElementAttributesProgram extends CProgram{
	public function CElementAttributesProgram(){ 
		parent :: CProgram();
	} // end CElementProgram()
	
	public function c_main(){ 
return <<<JSCRIPT
JSCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){
ob_start();
return ob_end();
	} // end innerhtml()
} // end CElementAttributesProgram
?>