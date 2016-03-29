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
		if( ii == 2 || ii == 5 || ii == 8 ){
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
	
	//--------------------------------------
	// name: foo2()
	// desc: runnable function for cthread
	//--------------------------------------
	$foo2 = _fn(function(){ 
		$i = $this->getIteration();
		printbr("foo2() - CThread " . $this->getID() . " is running foo2 on " . $i . " iteration.");
		if($i>=9) {
			printbr("foo2() - this->destroy() - CThread " . $this->getID() . " destroyed on iteration: " . $i);		
			$this->destroy();
		} // end if
	}); // end foo2()
	
	//--------------------------------------
	// name: foo1()
	// desc: runnable function for cthread
	//--------------------------------------
	$foo1 = _fn(function() use(&$foo2){
		$i = $this->getIteration();
		printbr("foo1() - CThread " . $this->getID() . " is running foo1 on " . $i . " iteration.");
		if($i >= 3) {
			printbr("foo1() - this->jump( foo2 ) - CThread " . $this->getID() . " jumps to foo2 on iteration: " . $i);		
			$this->jump($foo2);
		} // end if
	}); // end foo1() 
	$foo1->synchronize;
	
	///////////////////////
	// cthread objects
	$cthread = new CThread();    
	if(!$cthread) {
		printbr("ERROR: cthread = new CThread()");
		return;
	}
	else printbr("cthread = new CThread()");
	
	if(!$cthread->create( 50, $foo1 )) {
		printbr("ERROR: cthread->create( 50, foo1 )");
		return;
	}
	else printbr("cthread->create( 50, foo1 )");
	
	if(!$cthread->start()) {
		printbr("ERROR: cthread->start()");
		return;
	}
	else printbr("cthread->start() - CThread " . $cthread->getID());
	
	$cthread2 = new CThread();    
	$cthread2->create( 75, $foo1 );
	$cthread2->start();
	/*
	$cthread2 = new CThread();    
	if(!$cthread2) {
		printbr("ERROR: cthread2 = new CThread()");
		return;
	}
	else printbr("cthread2 = new CThread()");
	
	if(!$cthread2->create( 50, $foo11 )) {
		printbr("ERROR: cthread2->create( 50, foo11 )");
		return;
	}
	else printbr("cthread2->create( 50, foo11 )");
	
	if(!$cthread2->start()) {
		printbr("ERROR: cthread2->start()");
		return;
	}
	else printbr("cthread2->start() - CThread " . $cthread2->getID());
	
	/*
	$cthread2 = new CThread();    
	$cthread2->create( 50, $foo2 );
	$cthread2->start();
	$cthread3 = new CThread();    
	$cthread3->create( 50, $foo2 );
	$cthread3->start();
	*/
/*	
	_fn(function(){ alert("anonymous function");})->_();
	
	$fn = function(){ alert("anonymous function number 2");};
	_function($fn)->_();
	
	_function("namedfn")->_();
	
	$fn = function() use(&$cfn){ alert($cfn->m_data);};
	$cfn = _function($fn);
	$cfn->m_data = "this is the data79879879";
	$cfn->_();

	$cfn = _function("namedfn");
	$cfn->m_data = "this is the data";
	
	alert($cfn->m_data);
*/	
	
	/*
	$cthread2 = new CThread();    
	$cthread2->create( 50, $foo2 );
	$cthread2->start();
	$cthread3 = new CThread();    
	$cthread3->create( 50, $foo2 );
	$cthread3->start();
	*/
	
	printbr();	
return ob_end();
	} // end innerhtml()
} // end CThreadProgram

function namedfn() {
	alert("named function");
} // end foo()

function foo44() {
	printbr("hello, world");
	$this->destroy();
}
?>