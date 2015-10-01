<?php
//---------------------------------------------------------------------------
// name: cconstants.prg.php
// desc: demonstrates how to use constants
//---------------------------------------------------------------------------

// includes
include_program( "CConstantsProgram" );

//---------------------------------------------------
// name: CConstantsProgram
// desc: hello world program
//---------------------------------------------------
class CConstantsProgram extends CProgram{
	public function CConstantsProgram(){ 
		parent :: CProgram();	
	} // end CConstantsProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>cconstants.js</b>" );
	printbr( "(CConstants::TOP) = " + CConstants.TOP );
	printbr( "(CConstants::BOTTOM) = " + CConstants.BOTTOM );
	printbr( "(CConstants::LEFT) = " + CConstants.LEFT );
	printbr( "(CConstants::RIGHT) = " + CConstants.RIGHT );
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr( "<b>cconstants.php</b>" );
	printbr( "(CConstants::TOP) = " . CConstants :: $TOP );
	printbr( "(CConstants::BOTTOM) = " . CConstants :: $BOTTOM );
	printbr( "(CConstants::LEFT) = " . CConstants :: $LEFT );
	printbr( "(CConstants::RIGHT) = " . CConstants :: $RIGHT );
return ob_end();
	} // end innerhtml()
} // end CConstantsProgram
?>