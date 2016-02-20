<?php
//---------------------------------------------------------------------------
// name: celement.prg.php
// desc: demonstrates how to use CElement
//---------------------------------------------------------------------------

// includes
include_program( "CProgramProgram" );

//---------------------------------------------------
// name: CProgramProgram
// desc: celement program demo
//---------------------------------------------------
class CProgramProgram extends CProgram{
	protected $m_celement;
	public function CProgramProgram(){ 
		parent :: CProgram();
	} // end CProgramProgram()
	
	public function c_main(){ 
return <<<JSCRIPT
	printbr("<b>cprogram.js</b>");
	alert("running CProgramProgram");
JSCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>cprogram.php</b>");
return ob_end();
	} // end innerhtml()
} // end CProgramProgram
?>