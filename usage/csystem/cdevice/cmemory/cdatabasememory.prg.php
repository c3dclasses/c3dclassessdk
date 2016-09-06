<?php
//---------------------------------------------------------------------------
// name: cbase.prg.php
// desc: demonstrates how to construct a basic hello, world!!! program
//---------------------------------------------------------------------------

// includes
include_program( "CDatabaseMemoryProgram" );
//include_memory( "cdatabasememory", "localhost/c3dclassessdk/cdatabasememory", "CDatabaseMemory", array("username"=>"root", "password"=>"") );
//include_memory( "cdatabasememory", "localhost/prac/cdatabasememory", "CDatabaseMemory", array("username"=>"root", "password"=>"","client"=>true ) );


//---------------------------------------------------
// name: CDatabaseMemoryProgram
// desc: hello world program
//---------------------------------------------------
class CDatabaseMemoryProgram extends CProgram{
	public function CDatabaseMemoryProgram(){ 
		parent :: CProgram();	
	} // end CDatabaseMemoryProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>cdatabasememory.js</b>" );
	var cmemory = use_memory( "cdatabasememory" );
	_if( function(){ return ( cmemory.cache() != null ); }, function(){ 
		printbr( "Memory Before: ");
		cmemory.create( "memory-3", "value-3", "string");
		printbr( cmemory._toString() );
		printbr( "Memory After: ");		
		cmemory.delete( "memory-1");
		printbr( cmemory._toString() );
		this._return();
	})._endif();
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr( "<b>cdatabasememory.php</b>" );
	if( $cmemory = use_memory( "cdatabasememory" ) ){
		printbr( "Memory Before: ");
		printbr( $cmemory->toString() );
		printbr( "Memory After: ");
		$cmemory->create( "memory-1", "value-1", "string");
		$cmemory->create( "memory-2", "value-2", "string");
		printbr( $cmemory->toString() );		
	} // end if
return ob_end();
	} // end innerhtml()
} // end CDatabaseMemoryProgram
?>