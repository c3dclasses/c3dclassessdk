<?php
//---------------------------------------------------------------------------
// name: cbit.prg.php
// desc: demonstrates how to use bits in your program
//---------------------------------------------------------------------------

// includes
include_program( "CBitProgram" );

//---------------------------------------------------
// name: CBitProgram
// desc: hello world program
//---------------------------------------------------
class CBitProgram extends CProgram{
	public function CBitProgram(){ 
		parent :: CProgram();	
	} // end CBitProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>cbit.js</b>" );
	printbr( CBit.BIT[0] );
	printbr( CBit.BIT[1] );
	printbr( CBit.BIT[2] );
	printbr( CBit.BIT[3] );
	printbr( CBit.BIT[4] );
	printbr( CBit.BIT[5] );
	printbr();
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>cbit.php</b>"); 
	printbr(CBit::$BIT[0]); 
	printbr(CBit::$BIT[1]);
	printbr(CBit::$BIT[2]);
	printbr(CBit::$BIT[3]);
	printbr(CBit::$BIT[4]);
	printbr(CBit::$BIT[5]);
	printbr();
return ob_end();
	} // end innerhtml()
} // end CBitProgram
?>