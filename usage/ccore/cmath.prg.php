<?php
//---------------------------------------------------------------------------
// name: cbase.prg.php
// desc: demonstrates how to construct a basic hello, world!!! program
//---------------------------------------------------------------------------

// includes
include_program( "CMathProgram" );

//---------------------------------------------------
// name: CMathProgram
// desc: hello world program
//---------------------------------------------------
class CMathProgram extends CProgram{
	public function CMathProgram(){ 
		parent :: CProgram();	
	} // end CMathProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr("<b>cmath.js</b>"); 
	printbr(CMath.abs(-4.0));
	printbr(CMath.acos(-4.0));
	printbr(CMath.asin(-4.0));
	printbr(CMath.sin(-4.0));
	printbr(CMath.cos(-4.0));
	printbr(CMath.max(5,7,2,8,6));
	printbr(CMath.min(5,7,2,8,6));
	printbr(CMath.pow(2,4));
	printbr(CMath.PI);
	printbr(CMath.floor((CMath.rand()*10)+1)); 
	printbr(CMath.floor((CMath.rand()*10)+1)); 
	printbr(CMath.round(5.666)); 
	printbr(CMath.round(8.266)); 
	printbr(CMath.in(7,8,10));
	printbr(CMath.in(11,9,10));
	printbr(CMath.in(9,8,10));
	printbr(CMath.bound(7,8,10));
	printbr(CMath.bound(11,9,10));
	printbr(CMath.bound(9,8,10));
	printbr();	
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>cmath</b>"); 
	printbr(CMath::abs(-4.0));
	printbr(CMath::acos(-4.0));
	printbr(CMath::asin(-4.0));
	printbr(CMath::sin(-4.0));
	printbr(CMath::cos(-4.0));
	printbr(CMath::max(array(5,7,2,8,6)));
	printbr(CMath::min(array(5,7,2,8,6)));
	printbr(CMath::pow(2,4));
	printbr(CMath::$PI);
	printbr(CMath::floor((CMath::rand()*10)+1)); 
	printbr(CMath::floor((CMath::rand()*10)+1)); 
	printbr(CMath::round(5.666)); 
	printbr(CMath::round(8.266)); 
	printbr(CMath::in(7,8,10));
	printbr(CMath::in(11,9,10));
	printbr(CMath::in(9,8,10));
	printbr(CMath::bound(7,8,10));
	printbr(CMath::bound(11,9,10));
	printbr(CMath::bound(9,8,10));
	printbr(CMath::round(8.266)); 
	printbr();		
return ob_end();
	} // end innerhtml()
} // end CMathProgram
?>