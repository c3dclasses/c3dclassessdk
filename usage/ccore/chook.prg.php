<?php
//---------------------------------------------------------------------------
// name: chook.prg.php
// desc: demos how to use the hook routines
//---------------------------------------------------------------------------

// includes
include_program( "CHookProgram" );

function foo_hook(){
	return "this is the foo hook"; 
} // end foo_hook()

CHook :: add("style", "foo_hook");

//---------------------------------------------------
// name: CHookProgram
// desc: hello world program
//---------------------------------------------------
class CHookProgram extends CProgram{
	public function CHookProgram(){ 
		parent :: CProgram();	
	} // end CHookProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr("<b>chook.js</b>");
	CHook.add( "hook_foo", chook_foo1 );
	CHook.add( "hook_foo", chook_foo2 );
	CHook.add( "hook_foo", chook_foo3 );
	CHook.fire( "hook_foo" );
	CHook.remove( "hook_foo", chook_foo3 );
	CHook.fire( "hook_foo" );
	CHook.remove( "hook_foo", chook_foo2 );
	CHook.fire( "hook_foo" );
	CHook.remove( "hook_foo" );
	CHook.fire( "hook_foo" );
	CHook.remove( "hook_foo" );
	CHook.fire( "hook_foo" );
	printbr();
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>chook.php</b>");
	CHook :: add( "hook_foo", "chook_foo1" );
	CHook :: add( "hook_foo", "chook_foo2" );
	CHook :: add( "hook_foo", "chook_foo3" );
	CHook :: fire( "hook_foo" );
	CHook :: remove( "hook_foo", "chook_foo3" );
	CHook :: fire( "hook_foo" );
	CHook :: remove( "hook_foo", "chook_foo2" );
	CHook :: fire( "hook_foo" );
	CHook :: remove( "hook_foo" );
	CHook :: fire( "hook_foo" );
	CHook :: remove( "hook_foo" );
	CHook :: fire( "hook_foo" );
	printbr();
return ob_end();
	} // end innerhtml()
} // end CHookProgram

// hook callback methods
function chook_foo1(){ printbr("in foo1"); }
function chook_foo2(){ printbr("in foo2"); }
function chook_foo3(){ printbr("in foo3"); }

ob_start();
?>
// hook callback methods
function chook_foo1(){ printbr("in foo1"); }
function chook_foo2(){ printbr("in foo2"); }
function chook_foo3(){ printbr("in foo3"); }	
<?php
ob_end_queue("script");
?>