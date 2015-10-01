<?php
//---------------------------------------------------------------------------
// name: cconstants.prg.php
// desc: demonstrates how to use constants
//---------------------------------------------------------------------------

// includes
include_program( "CThreadProgram" );

//---------------------------------------------------
// name: CThreadProgram
// desc: hello world program
//---------------------------------------------------
class CThreadProgram extends CProgram{
	public function CThreadProgram(){ 
		parent :: CProgram();	
 	} // end CThreadProgram()
	
	public function c_main(){
return <<<SCRIPT
	var i=0;
	var foo1 = function(){ 
		printbr("CThread " + this.getID() + " is running foo1: " + i );
		i++;
		if( i==3 ) 
			this.jump( foo2 );
	} // end foo1() 
	
	var ii=0;
	var foo2 = function(){ 
		if( !this.lock(foo2) ){
			printbr("CThread " + this.getID() + " cant run foo2 because theres a lock");	
			return;
		} // end if
		printbr("CThread " + this.getID() + " is running foo2: " + (i+ii) );
		ii++;
		if( ii == 3 || ii == 15 || ii == 25 ){
			printbr("CThread " + this.getID() + " is being destroyed in foo2!!"); 	
			this.destroy();
		} // end if	
	} // end foo2
	printbr( "<b>cthread.js</b>" );
	var cthread = new CThread();    
	if( cthread != null )
		printbr("created the thread");	
	cthread.create( 500, foo1 );
	if( cthread.start() )
		printbr("started");
	var cthread2 = new CThread();    
	cthread2.create( 500, foo2 );
	cthread2.start();
	var cthread3 = new CThread();    
	cthread3.create( 500, foo2 );
	cthread3.start();
	printbr();
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr( "<b>cthread.php</b>" );
return ob_end();
	} // end innerhtml()
} // end CThreadProgram
?>