<?php
//---------------------------------------------------------------------------
// name: cbase.prg.php
// desc: demos hows to use cmemory object to store data on server / client
//---------------------------------------------------------------------------

// includes
include_program( "CMemoryProgram" );

//---------------------------------------------------
// name: CMemoryProgram
// desc: hello world program
//---------------------------------------------------
class CMemoryProgram extends CProgram{
	public function CMemoryProgram(){ 
		parent :: CProgram();	
	} // end CMemoryProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr();
	printbr( "<b>cmemory.js</b>" );
	printbr("opening \"cjsonmemory\" location");
	printbr();
	var cmemory = use_memory( "cjsonmemory" );
	if( !cmemory ){
		alert("cmemory is not availiable");
		return;
	}
	
	_if( function(){ return ( cmemory.data() != null ); }, function(){ 
		printbr( "cmemory = use_memory( cjsonmemory ):");
		printbr( cmemory._toString() );		
		printbr();
		
		// create memory location
		if( cmemory.create( "foo55666", "Hello, World!!!!! Man!!!!", "string" ) ){
			printbr( "cmemory.create( 'foo55666', 'Hello, World!!!!! Man!!!!', 'string'): " );
			printbr( cmemory._toString() );
		} // end if
		else printbr( "cmemory.create( 'foo55666', 'Hello, World!!!!! Man!!!!', 'string'): ERROR: Memory is not availible or has already been create." );
		printbr();		
		
		// update memory location
		var num = CMath.rand();
		if( cmemory.update( "foo55666", "Number: " + num, "string" ) ){
			printbr( "cmemory.update( 'foo55666', 'Number: ' " + num + ", 'string'): SUCCESS!" );
			printbr( cmemory._toString() );
		} // end if
		else printbr( "cmemory.update( 'foo55666', 'Number: ' " + num + ", 'string'): ERROR - memory location is not available!" );
		printbr();
			
		// retrieve memory location
		var cvar = null;
		if( cvar = cmemory.retrieve( "foo55666" ) ){
			printbr( "cmemory.retrieve( 'foo55666' ): " );
			printbr( print_r( cvar, true ) );
		} // end if
		else printbr( "cmemory.retrieve( 'foo556' ): ERROR - memory location is not available!" ); 
		printbr();
		
		// delete memory location
		if( cmemory.delete( "foo556" ) ){
			printbr( "cmemory.delete( foo556 ): " );
			printbr( cmemory.toString() );
		} // end if
		else printbr( "cmemory.delete( 'foo556' ): ERROR - memory location is not available!" ); 
		if( cmemory.delete( "foo55____" ) ){
			printbr( "cmemory.delete( foo55____ ): " );
			printbr( cmemory.toString() );
		} // end if
		else printbr( "cmemory.delete( 'foo556____' ): ERROR - memory location is not available!" ); 
		printbr();	
		
		this._return();
	})._elseif( function(){ return (cmemory.data() == null); }, function(){
	})._endif();
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr( "<b>cmemory.php</b>" );
	printbr("opening \"cjsonmemory\" location");
	printbr();
	
	// open memory
	if( $cmemory = use_memory( "cjsonmemory" ) ){
		printbr( "cmemory = use_memory(cjsonmemory):");
		printbr( $cmemory->toString() );
	} // end if
	else printbr( "cmemory = use_memory(cjsonmemory): ERROR memory not availiable");
	printbr();	
	
	// create memory locatin
	if( $cmemory->create( "foo55666", "Hello, World!!!!! Man!!!!", "string" ) ){
		printbr( "cmemory->create( 'foo55666', 'Hello, World!!!!! Man!!!!', 'string'): " );
		printbr( $cmemory->toString() );
	} // end if
	else printbr( "cmemory->create( 'foo55666', 'Hello, World!!!!! Man!!!!', 'string'): ERROR: Memory is not availible or has already been create." );
	printbr();		
	
	// update memory locatin
	$num = rand();
	if( $cvar = $cmemory->update( "foo55666", "Number: " . $num, "string" ) ){
		printbr( "cmemory->update( 'foo55666', 'Number: ' " . $num . ", 'string'): " );
		printbr( print_r( $cvar, true ) );
		printbr( $cmemory->toString() );
	} // end if
	else printbr( "cmemory->update( 'foo55666', 'Number: ' " . $num . ", 'string'): ERROR - memory location is not available!" );
	printbr();
		
	// retrieve memory locatin
	if( $cvar = $cmemory->retrieve( "foo556" ) ){
		printbr( "cmemory->retrieve( 'foo556' ): " );
		printbr( print_r( $cvar, true ) );
	} // end if
	else printbr( "cmemory->retrieve( 'foo556' ): ERROR - memory location is not available!" ); 
	printbr();
	
	// delete memory location
	if( $cmemory->delete( "foo556" ) ){
		printbr( "cmemory->delete( foo556 ): " );
		printbr( $cmemory->toString() );
	} // end if
	else printbr( "cmemory->delete( 'foo556' ): ERROR - memory location is not available!" ); 
	
	if( $cmemory->delete( "foo55____" ) ){
		printbr( "cmemory->delete( foo55____ ): " );
		printbr( $cmemory->toString() );
	} // end if
	else printbr( "cmemory->delete( 'foo556____' ): ERROR - memory location is not available!" ); 
	printbr();
	
return ob_end();
	} // end innerhtml()
} // end CMemoryProgram
?>