<?php
//---------------------------------------------------------------------------
// name: chash.prg.php
// desc: demos how to use the basic hash object
//---------------------------------------------------------------------------

// includes
include_program( "CHashProgram" );

//---------------------------------------------------
// name: CHashProgram
// desc: hello world program
//---------------------------------------------------
class CHashProgram extends CProgram{
	public function CHashProgram(){ 
		parent :: CProgram();	
	} // end CHashProgram()
	
	public function c_main(){
return <<<SCRIPT
	var chash_foo = function( index, value ){ printbr( "a[" + index + "] = " + value ); }
	var chash_foo_tostring = function( index, value ){ return "in the chash_foo_toString<br />"; }
	printbr("<b>chash.js</b>");
	var chash = new CHash();
	printbr( "chash.size() = " + chash.size() );
	chash.set("01", "1234");
	chash.set("02", "1235");
	chash.set("03", "1235");
	print_r( chash._() );
	printbr();
	printbr( "chash.size() = " + chash.size() );
	printbr(chash.get("01"));
	chash.remove("01");
	print_r( chash._() );
	printbr();
	chash.clear();
	print_r( chash._() );
	printbr();
	chash.set("01", "1234");
	print_r( chash._() );
	printbr();
	chash.set("01", "1234");
	chash.set("02", "1235");
	chash.set("03", "1235");
	printbr( chash.keys()._() );
	printbr( chash.values()._() );
	if( chash.containsKey( "03" ) )
		printbr("contains key 01");
	if( chash.containsValue( "1235" ) )
		printbr("contains value 1235");
	chash.visit(chash_foo);
	printbr(chash.toStringVisit(chash_foo_tostring));
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>chash.php</b>");
	$chash = new CHash();
	printbr( "chash->size() = " . $chash->size() );
	$chash->set("01", "1234");
	$chash->set("02", "1235");
	$chash->set("03", "1235");
	print_r( $chash->valueOf() );
	printbr();
	printbr( "chash->size() = " . $chash->size() );
	printbr($chash->get("01"));
	$chash->remove("01");
	print_r( $chash->valueOf() );
	printbr();
	
	$chash->clear();
	print_r( $chash->valueOf() );
	printbr();
	$chash->set("01", "1234");
	print_r( $chash->valueOf() );
	printbr();
	
	$chash->set("01", "1234");
	$chash->set("02", "1235");
	$chash->set("03", "1235");
	print_r( $chash->keys()->valueOf() );
	printbr();
	print_r( $chash->values()->valueOf() );
	printbr();
	if( $chash->containsKey( "03" ) )
		printbr("contains key 01");
	if( $chash->containsValue( "1235" ) )
		printbr("contains value 1235");
	$chash->visit("chash_foo");
	printbr( $chash->toStringVisit("chash_foo_tostring") );
	printbr();
return ob_end();
	} // end innerhtml()
} // end CHashProgram
function chash_foo( $index, $value ){ printbr( "a[" . $index . "] = " . $value ); }
function chash_foo_tostring( $index, $value ){ return "in the chash_foo_toString<br />"; }
?>