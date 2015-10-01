<?php
//---------------------------------------------------------------------------
// name: cbase.prg.php
// desc: demonstrates how to construct a basic hello, world!!! program
//---------------------------------------------------------------------------

// includes
include_program( "CJSONMemoryProgram" );

//---------------------------------------------------
// name: CJSONMemoryProgram
// desc: hello world program
//---------------------------------------------------
class CJSONMemoryProgram extends CProgram{
	public function CJSONMemoryProgram(){ 
		parent :: CProgram();	
	} // end CJSONMemoryProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>cjsonmemory.js</b>" );
	var cmemory = use_memory( "cjsonmemory" );
	_if( function(){ return ( cmemory.data() != null ); }, function(){ 
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
	printbr( "<b>cjsonmemory.php</b>" );
	if( $cmemory = use_memory( "cjsonmemory" ) ){
		printbr( "Memory Before: ");
		printbr( $cmemory->toString() );
		printbr( "Memory After: ");
		$cmemory->create( "memory-1", "value-1", "string");
		$cmemory->create( "memory-2", "value-2", "string");
		printbr( $cmemory->toString() );		
	} // end if
return ob_end();
	} // end innerhtml()
} // end CJSONMemoryProgram
?>