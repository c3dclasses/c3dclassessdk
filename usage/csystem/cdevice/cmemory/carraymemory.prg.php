<?php
//---------------------------------------------------------------------------
// name: cbase.prg.php
// desc: demonstrates how to construct a basic hello, world!!! program
//---------------------------------------------------------------------------

// includes
include_program("CArrayMemoryProgram");
include_array_memory("mymemory", "session", $_SESSION, array("client"=>true));

//---------------------------------------------------
// name: CArrayMemoryProgram
// desc: hello world program
//---------------------------------------------------
class CArrayMemoryProgram extends CProgram{
	public function CArrayMemoryProgram(){ 
		parent :: CProgram();	
	} // end CArrayMemoryProgram()

	public function c_main(){
return <<<SCRIPT
	printbr( "<b>carraymemory.js</b>" );
	var cmemory = use_memory( "mymemory" );
	_if(function(){ return ( cmemory.cache() != null ); }, function(){ 		
		printbr( "Memory Before: ");
		printbr( cmemory._toString() );
		cmemory.create( "memory-3", "value-3", "string");
		printbr( cmemory._toString() );
		printbr( "Memory After: ");		
		cmemory.delete( "memory-1");
		printbr( cmemory._toString() );
		this._return();
	})._endif();
	
	printbr();
	
	cmemory.syncInterval(10000);
	
	// testing the sync function for every second
	/*setInterval( function() {
		var creturn = cmemory.sync();
		_if(function(){ return creturn.isdone();}, function(){
			printbr("cmemory.sync()");
			printbr( cmemory._toString() );
		})._endif();
	}, 15000 );
	*/
SCRIPT;
	} // end c_main()
	
	public function innerhtml(){
ob_start();
	printbr( "<b>carraymemory.php</b>" );
	if( $cmemory = use_memory( "mymemory" ) ){
		printbr( "Memory Before: ");
		printbr( $cmemory->toString() );
		printbr( "Memory After: ");
		$cmemory->create( "memory-1", "value-1", "string");
		$cmemory->create( "memory-2", "value-2", "string");
		printbr( $cmemory->toString() );		
	} // end if
return ob_end();
	} // end innerhtml()
} // end CArrayMemoryProgram
?>