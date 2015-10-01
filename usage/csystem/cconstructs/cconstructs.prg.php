<?php
//---------------------------------------------------------------------------
// name: cconstants.prg.php
// desc: demonstrates how to use constants
//---------------------------------------------------------------------------

// includes
include_program( "CConstructsProgram" );

//---------------------------------------------------
// name: CConstructsProgram
// desc: hello world program
//---------------------------------------------------
class CConstructsProgram extends CProgram{
	public function CConstructsProgram(){ 
		parent :: CProgram();	
	} // end CConstructsProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>cconstructs.js</b>", this.getElement() );
	var _this = this; 
	var i=1;
	
	// while
	_while( 10000, function(){
		if( this.getIteration() == 3 ){
			printbr( "_while(10000): ended on 3th iteration.", _this.getElement() );
			this._return();
		}
		else printbr( "_while(10000): " + this.getIteration(), _this.getElement() );
	}); // end _while()
	
	// for
	_for( 2000, function(){
		if( this.getIteration() == 4 ){
			printbr( "_for(2000): ended on 4th iteration.", _this.getElement() );
			this._return();
		}
		else printbr( "_for(2000): " + this.getIteration(), _this.getElement() );
	}); // end _while()
	/*
	// if/else
	_if( function(){ return (i%5)==0; }, function(){
		printbr( "_if("+(i%5)+")", _this.getElement() );
		this._return();
	})._else( function(){
		printbr( "_else("+(i%5)+")", _this.getElement() );
	})._endif(); // end _if()
	*/
	
	// do while
	_do( function(){ 
		printbr( "_while(5000): " + i, _this.getElement() );
		i++;
		if( i == 5 ){
			printbr( "_do_while(5000): ended on 5th iteration.", _this.getElement() );
			this._return();
		}
	})._while(5000, function(){ return true; });
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr( "<b>cconstructs.php</b>" );
return ob_end();
	} // end innerhtml()
} // end CConstructsProgram

function foo300(){
	alert("in the foo function");
} // end foo()
?>