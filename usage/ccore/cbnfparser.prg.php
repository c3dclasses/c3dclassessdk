<?php
//---------------------------------------------------------------------------
// name: cbnfparser.prg.php
// desc: demonstrates how to use the cbnfparser class
//---------------------------------------------------------------------------

// includes
include_program( "CBNFParserProgram" );

//---------------------------------------------------
// name: CBNFParserProgram
// desc: 
//---------------------------------------------------
class CBNFParserProgram extends CProgram{
	public function CBNFParserProgram(){ 
		parent :: CProgram();	
	} // end CBNFParserProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>cbnfparser.js</b>" );
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr( "<b>cbnfparser.php</b>" );
	
	// construct a simple BNF
	$P['CLASS'] = "<<ATTR>>(class\s+(foo)\s*{\s*)<<BODY>>(})";
	$P['BODY']  = "hello||<<CLASS>>||<<NULL>>";
	$P['ATTR']  = "public ||protected ||private ||static ||<<NULL>>";
		
	// create the BNF parser object
	$p = new CBNFParser();
	$p->create($P, "CLASS");
	printbr("Input string");
	printbr( "static class foo     {public class foo{hello}}" );
	printbr();
	
	// parse the string
	$p->parse("static class foo    {       public class foo{hello}}");
	echo $p->toString();
	
	printbr();
	printbr();
	printbr();
	printbr("Next one");
	
	// create the BNF parser object
	$P = NULL;
	/*
	$P['_IF']  = "_if\s*<<EXP>>\s*{\s*<<BODY>>\s*}"; 
	$P['EXP'] = "\((?P<expr>.+)\)";
	$P['BODY'] = "<<NULL>>||<<_IF>>||(.*)";
	*/
	
	//$P['START'] = "(.*)<<_IF>>";
	$P['_IF']  = "(?<s_content>.*)_if\s*<<EXP>>\s*<<BODY>>"; 
	$P['EXP'] = "\((?P<expr>.+)\)";
	$P['BODY'] = "{\s*(?P<body>.+)\s*}(?<e_content>.*)||<<NULL>>||<<_IF>>";
	
	$p = new CBNFParser();
	$p->create($P, "_IF");
	//$p->create($P, "START");

	// parse the string
	$p->parse("hgjkhdfjk _if(hello(foo)||hello(foo,foo)||a==9||10=9){bodystuffff;}_if(hello){}");
	echo $p->toString();
	
return ob_end();
	} // end innerhtml()
} // end CBNFParserProgram
?>