<?php
//---------------------------------------------------------------------------
// name: cpath.prg.php
// desc: demonstrates how to use obqueue 
//---------------------------------------------------------------------------

// includes
include_program( "CPathProgram" );

//---------------------------------------------------
// name: CPathProgram
// desc: hello world program
//---------------------------------------------------
class CPathProgram extends CProgram{
	// constructor
	public function CPathProgram(){ 
		parent :: CProgram();	
	} // end CPathProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr("<b>CPath.js</b>");
	include_path("CPathProgram", this.__FILE__ );
	printbr( "CPathProgram: " + CPath._("CPathProgram") );
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){			
ob_start();
	printbr("<b>CPath.php</b>");
	include_path("CPathProgram", __FILE__ );
	printbr( "CPathProgram: " . CPath :: _("CPathProgram") );
return ob_end();
	} // end innerhtml()
} // end CPathProgram
?>