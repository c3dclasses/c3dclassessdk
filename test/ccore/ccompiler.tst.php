<?php
//---------------------------------------------------------------------------
// file: ccompiler.tst.php
// desc: demonstrates how to to use the ccompiler object
//---------------------------------------------------------------------------

// includes
include_unittest("CCompilerUnitTest");

//-----------------------------------------------------
// name: CCompilerUnitTest
// desc: demonstrates how to to use the cconstant object
//-----------------------------------------------------
class CCompilerUnitTest extends CUnitTest {
	public function CConstantUnitTest() { 
		parent :: CUnitTest();	
	} // end CCompilerUnitTest()
	
	// test method
	public function testCCompiler() {	
		// get the input
		$strinput1 = inputToCompare(); // file_get_contents(relname(__FILE__, true) . "/test.js");
		$strinput2 = inputToCompare();
		$strinput3 = inputToCompare2();
		
		$this->assertTrue($strinput1 != "");
		$this->assertTrue($strinput2 != "");
		$this->assertTrue($strinput1 == $strinput2);
		$this->assertTrue($strinput3 != $strinput2);
		
		// construct the compiler object
		$ccompiler1 = new CCompiler();
		$ccompiler2 = new CCompiler();
		$ccompiler3 = new CCompiler();
		$this->assertTrue($ccompiler1 != NULL);
		$this->assertTrue($ccompiler2 != NULL);
		$this->assertTrue($ccompiler3 != NULL);
		
		// add the token types
		$ctokenizer = $ccompiler1->getTokenizer();
		$this->assertTrue($ctokenizer != NULL);
		$ctokenizer->addTokenType("comment1", "/*", "*/");
		$ctokenizer->addTokenType("comment2", "//",  PHP_EOL); 
		$ctokenizer->addTokenType("comment3", "//",  PHP_EOF);
		$ctokenizer->addTokenType("_if", "_if", "");
		$ctokenizer->addTokenType("_elseif", "_elseif", "");
		$ctokenizer->addTokenType("_else", "_else", "");
		$ctokenizer->addTokenType("_while", "_while", "");
		$ctokenizer->addTokenType("(", "(", "");
		$ctokenizer->addTokenType(",", ",", "");
		$ctokenizer->addTokenType(";", ";", "");
		$ctokenizer->addTokenType(")", ")", "");
		$ctokenizer->addTokenType("{", "{", "");
		$ctokenizer->addTokenType("}", "}", "");
		$ctokenizer->addTokenType("[", "[", "");
		$ctokenizer->addTokenType("]", "]", "");
		$ctokenizer = $ccompiler2->getTokenizer();
		$this->assertTrue($ctokenizer != NULL);
		$ctokenizer->addTokenType("comment1", "/*", "*/");
		$ctokenizer->addTokenType("comment2", "//",  PHP_EOL); 
		$ctokenizer->addTokenType("comment3", "//",  PHP_EOF);
		$ctokenizer->addTokenType("_if", "_if", "");
		$ctokenizer->addTokenType("_elseif", "_elseif", "");
		$ctokenizer->addTokenType("_else", "_else", "");
		$ctokenizer->addTokenType("_while", "_while", "");
		$ctokenizer->addTokenType("(", "(", "");
		$ctokenizer->addTokenType(",", ",", "");
		$ctokenizer->addTokenType(";", ";", "");
		$ctokenizer->addTokenType(")", ")", "");
		$ctokenizer->addTokenType("{", "{", "");
		$ctokenizer->addTokenType("}", "}", "");
		$ctokenizer->addTokenType("[", "[", "");
		$ctokenizer->addTokenType("]", "]", "");
		$ctokenizer = $ccompiler3->getTokenizer();
		$this->assertTrue($ctokenizer != NULL);
		$ctokenizer->addTokenType("comment1", "/*", "*/");
		$ctokenizer->addTokenType("comment2", "//",  PHP_EOL); 
		$ctokenizer->addTokenType("comment3", "//",  PHP_EOF);
		$ctokenizer->addTokenType("_if", "_if", "");
		$ctokenizer->addTokenType("_elseif", "_elseif", "");
		$ctokenizer->addTokenType("_else", "_else", "");
		$ctokenizer->addTokenType("_while", "_while", "");
		$ctokenizer->addTokenType("(", "(", "");
		$ctokenizer->addTokenType(",", ",", "");
		$ctokenizer->addTokenType(";", ";", "");
		$ctokenizer->addTokenType(")", ")", "");
		$ctokenizer->addTokenType("{", "{", "");
		$ctokenizer->addTokenType("}", "}", "");
		$ctokenizer->addTokenType("[", "[", "");
		$ctokenizer->addTokenType("]", "]", "");
		
		// create the compiler object
		$this->assertTrue($ccompiler1->create($strinput1)==true);
		$this->assertTrue($ccompiler2->create($strinput2)==true);
		$this->assertTrue($ccompiler3->create($strinput3)==true);
		$this->assertTrue($ccompiler2->getTokenizer()->toString() == $ccompiler2->getTokenizer()->toString());
		$this->assertTrue($ccompiler2->getTokenizer()->toString() != $ccompiler3->getTokenizer()->toString());
		
		// parse the body of the program
		$this->assertTrue($ccompiler1->getParser()->parse("BODY") == true);
		$this->assertTrue($ccompiler2->getParser()->parse("BODY") == true);
		$this->assertTrue($ccompiler3->getParser()->parse("BODY") == true);
		$this->assertTrue(print_r($ccompiler1->getParser()->getParseTree(),true) == print_r($ccompiler2->getParser()->getParseTree(),true));	
		$this->assertTrue(print_r($ccompiler1->getParser()->getParseTree(),true) != print_r($ccompiler3->getParser()->getParseTree(),true));	
		$this->assertTrue($ccompiler1->getParser()->translate() == $ccompiler2->getParser()->translate());
		$this->assertTrue($ccompiler1->getParser()->translate() != $ccompiler3->getParser()->translate());
	} // end testCCompiler()
} // end CCompilerProgram

/////////////////////////////////////////
// Recursive Grammer for the program
/////////////////////////////////////////

//----------------------------------------------------------------------------------
// name: BODY()
// desc: BODY := ( [STOP|DONE] | _IF | _FOR | { BODY } | ( BODY ) | . ) BODY
//----------------------------------------------------------------------------------
function BODY($cparser, $terminateToken=NULL) {	
	$node = new CParseTreeNode("BODY");
	while(!$cparser->done()) {
		if($terminateToken && $cparser->check($terminateToken)) // STOP
			break;	
		if($_IF = $cparser->acceptNonToken("_IF")) { // _IF
			$node->add($_IF);
			continue;
		} // end if
		if($_FOR =  $cparser->acceptNonToken("_FOR")) { // _FOR
			$node->add($_FOR);
			continue;
			// _FOR($cparser, $terminateTokenType=NULL)
		} // end if
		if($BODY=$cparser->acceptTokenBlock("(", "BODY", ")")) { // ( BODY )
			$node->add($BODY);
			continue;
		} // end if
		if($BODY=$cparser->acceptTokenBlock("{", "BODY", "}")) { // { BODY }
			$node->add($BODY);
			continue;
		} // end if
		$cparser->acceptToken();	// .
	} // end while()
	return $node;
} // end BODY()

//----------------------------------------------------------------------------
// name: _IF()
// desc: _IF := _if (PARAMS) { BODY } ((_elseif { BODY })* _else { BODY })
//----------------------------------------------------------------------------
function _IF($cparser, $terminateTokenType=NULL) {
	$node = new CParseTreeNode("_IF");
	if(!$cparser->accept("_if"))
		return NULL;
	$node->add($cparser->token(-1)->setTranslation("_if"));
	if(CONDITION_PART($node, $cparser, $terminateTokenType) == NULL)
		return NULL;
	if(BODY_PART($node, $cparser, $terminateTokenType) == NULL)
		return NULL;
	while($cparser->accept("_elseif")) {
		$node->add($cparser->token(-1)->setTranslation("._elseif"));
		if(CONDITION_PART($node, $cparser, $terminateTokenType) == NULL)
			return NULL;
		if(BODY_PART($node, $cparser, $terminateTokenType) == NULL)
			return NULL;
	} // end while
	if($cparser->accept("_else")) {
		$node->add($cparser->token(-1)->setTranslation("._else(function()"));
		if(BODY_PART($node, $cparser, $terminateTokenType) == NULL)
			return NULL;
	} // end if
	$cparser->token(-1)->appendTranslation(";"); // end of the statement
	return $node;
} // end _IF()

//--------------------------------------------------------
// name: CONDITION_PART()
// desc: processes the condition part of the if statement
//--------------------------------------------------------
function CONDITION_PART($node, $cparser, $terminateTokenType=NULL) {
	if(!$cparser->accept("("))
		return NULL;
	$node->add($cparser->token(-1)->setTranslation("(function() { return "));
	$condition = $cparser->acceptNonToken("BODY", ")");
	if($condition)
		$node->add($condition);
	if(!$cparser->accept(")"))
		return NULL;
	$node->add($cparser->token(-1)->setTranslation(";},function()"));
	return $node;
} // end CONDITION_PART()

//------------------------------------------------------
// name: BODY_PART()
// desc: processes the body part of the if statement
//------------------------------------------------------
function BODY_PART($node, $cparser, $terminateTokenType=NULL) {
	if(!$cparser->accept("{")) {
		return NULL;//STATEMENT_PART($node, $cparser, $terminateTokenType);
	}
	$node->add($cparser->token(-1)->setTranslation("{"));
	$body = $cparser->acceptNonToken("BODY", "}");
	if($body)
		$node->add($body);
	if(!$cparser->accept("}"))
		return NULL;
	$node->add($cparser->token(-1)->setTranslation("})"));
	return $node;
} // end BODY_PART()

//------------------------------------------------------
// name: STATEMENT_PART()
// desc: processes the body part of the if statement
//------------------------------------------------------
function STATEMENT_PART($node, $cparser, $terminateTokenType=NULL) {
	if(!$cparser->acceptToken())
		return NULL;
	$str = $cparser->tokenToString();
	$node->add($cparser->token(-1)->setTranslation("{" + $str));
	$body = $cparser->acceptNonToken("BODY", ";");		
	if(!$body)
		return NULL;
	$node->add($body);
	if(!$cparser->accept(";"))
		return NULL;
	$node->add($cparser->token(-1)->setTranslation(";})"));
	return $node;
} // end STATEMENT_PART()

//--------------------------------------------------
// name: _FOR()
// desc: _FOR := _for (PARAMS) { BODY } 
//---------------------------------------------------
function _FOR($cparser, $terminateTokenType=NULL) {
	$node = new CParseTreeNode("_FOR");
	if(!$cparser->accept("_for"))
		return NULL;
	$node->add($cparser->token(-1)->setTranslation("_for"));
	if(CONDITION_PART($node, $cparser, $terminateTokenType) == NULL)
		return NULL;
	if(BODY_PART($node, $cparser, $terminateTokenType) == NULL)
		return NULL;
	$cparser->token(-1)->appendTranslation(";"); // end of the statement
	return $node;
} // end _FOR()

/*
//--------------------------------------------------------
// name: PARAMS_PART()
// desc: PARAMS_PART := (INIT_PART; COND_PART; INC_PART;) 
//--------------------------------------------------------
function PARAMS_PART($node, $cparser, $terminateTokenType) {
	if(!$cparser->accept("("))
		return NULL;
	$init = $cparser->token(-1);
	if(INIT_PART($node, $cparser, ";") == NULL)
		return NULL;
	$node->add($init->setTranslation("(function() {"));
	$cond = $cparser->token(-1);
	if(COND_PART($node, $cparser, ";") == NULL)
		return NULL;
	$node->add($cond->setTranslation("; return function() {"));
	$inc = $cparser->token(-1);
	if(INC_PART($node, $cparser, ";") == NULL)
		return NULL;
	$node->add($cond->setTranslation("; return function() {"));
	$node->add($cparser->token(-1)->setTranslation("(function() { return "));
	$condition = $cparser->acceptNonToken("BODY", ")");
	if($condition)
		$node->add($condition);
	if(!$cparser->accept(")"))
		return NULL;
	$node->add($cparser->token(-1)->setTranslation(";},function()"));
	return $node;
} // end PARAMS_PART()
*/

//----------------------------------------------------
// name: inputToCompare()
// desc: constant input to compare against the file
//---------------------------------------------------
function inputToCompare() {
$strinput = <<<EOT
/* this is the stuff after */
// fghfghhgstuff after

_if(function() { return A=10;},function(){});

_if(function(){return A;},function(){
});

for(var i=0; i<10; i++){
	_if(function() { return a=10;},function(){
		this._return();
	});
}

_for( a=0 ){
}

_if(function() { return ;},function(){
	this._return();
})
._elseif(function() { return A=10;},function(){
})
._else(function(){
	this._return();
});
/* this is the stuff after */
// fghfghhgstuff after
EOT;
return $strinput;
} // inputToCompare()

//----------------------------------------------------
// name: inputToCompare()
// desc: constant input to compare against the file
//---------------------------------------------------
function inputToCompare2() {
$strinput = <<<EOT
_if(function() { return A=10;},function(){});
_if(function(){return A;},function(){
}); // end _if
_if(function() { return ;},function(){
	this._return();
}) // end _if
._elseif(function() { return A=10;},function(){
}) // end _elseif
._else(function(){
	this._return();
}); // end _else
EOT;
return $strinput;
} // inputToCompare()
?>