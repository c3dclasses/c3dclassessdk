<?php
//---------------------------------------------------------------------------
// name: cbase.prg.php
// desc: demonstrates how to construct a basic hello, world!!! program
//---------------------------------------------------------------------------

// includes
include_program( "CStringProgram" );

//---------------------------------------------------
// name: CStringProgram
// desc: hello world program
//---------------------------------------------------
class CStringProgram extends CProgram{
	public function CStringProgram(){ 
		parent :: CProgram();	
	} // end CStringProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr("<b>cstring.js</b>");
	var str = "Hello,World";
	printbr("length: " + str.length);
	printbr("charAt(5): " + str.charAt(5));
	printbr("charCodeAt(5): " + str.charCodeAt(5));
	printbr("indexOf('ld'): " + str.indexOf("ld"));
	printbr("lastIndexOf(: " + str.lastIndexOf("ld"));
	printbr("valueOf(): " + str.valueOf());
	printbr("str.toUpperCase().valueOf(): " + str.toUpperCase().valueOf());
	printbr("str.toLowerCase().valueOf(): " + str.toLowerCase().valueOf());
	printbr("str.slice().valueOf(): " + str.slice( 1, 5 ).valueOf());
	printbr("str.subString().valueOf(): " + str.substring( 1, 5 ).valueOf());
	printbr("str.substr().valueOf(): " + str.substr( 1, 3 ).valueOf());
	printbr("str.concat(array('hello2, world2')): " + str.concat( ['hello2, world2', 'world3', 'world4']).valueOf());
//	printbr("str._()[0]=" . str._()[0] );
//	str._()[0] = '3';
//	printbr("str._()[0]=" . str._()[0] );
	printbr( str._() );
	printbr();
	
	printbr("Using Regular Expressions: ");
	var str2 = "This is my strong new string to strong manipulate!!!";
	printbr( "str2: " + str2.valueOf() );
	printbr( "str2.match(/strong/): " + str2.match(/strong/) );
	printbr( "str2.match(/manipulate/): " + str2.match(/manipulate/) );
	printbr( "str2.match(/strong/g): " + str2.match(/strong/g) );		
	printbr( "str2.match(/manipulate/g): " + str2.match(/manipulate/g) );
	printbr( "str2.replace(/strong/,weak): " + str2.replace(/strong/, 'weak') );
	printbr( "str2.replace(/strong/g,weak): " + str2.replace(/strong/g, 'weak') );
	var matches = str2.match(/strong/);
	printbr( "Matches: " + matches );
	printbr( "str2.replaceMatch(matches,small): " + str2.replaceMatch( matches, "small" ) );
	printbr();
	printbr();

SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>cstring.php</b>");
	$str = new CString("Hello,World");
	printbr("length: " . $str->length());
	printbr("charAt(5): " . $str->charAt(5));
	printbr("charCodeAt(5): " . $str->charCodeAt(5));
	printbr("indexOf('ld'): " . $str->indexOf("ld"));
	printbr("lastIndexOf(: " . $str->lastIndexOf("ld"));
	printbr("valueOf(): " . $str->valueOf());
	printbr("str->toUpperCase()->valueOf(): " . $str->toUpperCase()->valueOf());
	printbr("str->toLowerCase()->valueOf(): " . $str->toLowerCase()->valueOf());
	printbr("str->slice()->valueOf(): " . $str->slice( 1, 5 )->valueOf());
	printbr("str->subString()->valueOf(): " . $str->subString( 1, 5 )->valueOf());
	printbr("str->substr()->valueOf(): " . $str->substr( 1, 3 )->valueOf());
	printbr("str->concat(array('hello2, world2')): " . $str->concat( array('hello2, world2', 'world3', 'world4'))->valueOf());
//	printbr("str->_()[0]=" . $str->_()[0] );
//	$str->_()[0] = '3';
//	printbr("str->_()[0]=" . $str->_()[0] );
	printbr( $str->_() );
	printbr();
	
	printbr("Using Regular Expressions: ");
	$str2 = new CString("This is my strong new string to strong manipulate!!!");
	printbr( "str2: " . $str2->valueOf() );
	printbr( "str2->match(/strong/): " . print_r( $str2->match('/strong/'), true ) );
	printbr( "str2->match(/manipulate/): " . print_r( $str2->match('/manipulate/'), true ) );
	printbr( "str2->match(/strong/g): " . print_r( $str2->match('/strong/g'), true ) );
	printbr( "str2->match(/manipulate/g): " . print_r( $str2->match('/manipulate/g'), true ) );
	printbr( "str2->replace(/strong/,weak): " . print_r( $str2->replace('/strong/', 'weak'), true ) );
	printbr( "str2->replace(/strong/g,weak): " . print_r( $str2->replace('/strong/g', 'weak'), true ) );
	$matches = $str2->match('/strong/');
	printbr( "Matches: " . print_r( $matches, true ) );
	printbr( "str2->replaceMatch(/strong/,small): " . $str2->replaceMatch( $matches, "small" ) );
	printbr();
	printbr();
return ob_end();
	} // end innerhtml()
} // end CStringProgram
?>