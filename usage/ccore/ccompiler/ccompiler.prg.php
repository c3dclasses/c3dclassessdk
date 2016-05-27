<?php
//---------------------------------------------------------------------------
// name: ccompiler.prg.php
// desc: shows how to use compiler object to parse and translate 
//       an async if construct to equivalent javascript syntax 
//---------------------------------------------------------------------------

// includes
include_program( "CCompilerProgram" );

//---------------------------------------------------
// name: CCompilerProgram
// desc: the compiler program
//---------------------------------------------------
class CCompilerProgram extends CProgram{
	public function CCompilerProgram(){ 
		parent :: CProgram();	
	} // end CCompilerProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>ccompiler.js</b>" );
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr( "<b>ccompiler.php</b>" );
	
	$strinput = file_get_contents( relname( __FILE__, true ) . "/ccompiler.js" );
	printbr( "Before Translation: " . $strinput );		
	
	// construct the compiler object
	$ccompiler = new CCompiler();
	
	// set up the token type
	$ctokenizer = $ccompiler->getTokenizer();
	$ctokenizer->addTokenType("comment1", "/*", "*/");
	$ctokenizer->addTokenType("comment2", "//",  PHP_EOL); 
	$ctokenizer->addTokenType("comment3", "//",  PHP_EOF);
	$ctokenizer->addTokenType("_if", "_if", "" );
	$ctokenizer->addTokenType("_elseif", "_elseif", "" );
	$ctokenizer->addTokenType("_else", "_else", "" );
	$ctokenizer->addTokenType("_while", "_while", "" );
	$ctokenizer->addTokenType("(", "(", "" );
	$ctokenizer->addTokenType(",", ",", "" );
	$ctokenizer->addTokenType(";", ";", "" );
	$ctokenizer->addTokenType(")", ")", "" );
	$ctokenizer->addTokenType("{", "{", "" );
	$ctokenizer->addTokenType("}", "}", "" );
	$ctokenizer->addTokenType("[", "[", "" );
	$ctokenizer->addTokenType("]", "]", "" );
	
	// create the compiler object
	$ccompiler->create( $strinput );
	$ctokenizer->printTokens();
	
	// parse the body of the program
	if( $ccompiler->getParser()->parse( "BODY" ) ) 
		printbr("parsed the program");	
	
	// print the parse tree
	printbr("Parse Tree: ");
	print_r( $ccompiler->getParser()->getParseTree() );	
	
	printbr();
	printbr("Translation: ");
	print("<pre><code>");
	print_r( $ccompiler->getParser()->translate() );
	print("</code></pre>");
	
	// write the translation to file
	$infile = fopen( dirname(__FILE__) . "/ccompiler.compiled.js", "w") or die("Unable to open file!");
	fwrite($infile,  $ccompiler->getParser()->translate() );
	fclose($infile);	
return ob_end();
	} // end innerhtml()
} // end CCompilerProgram

//--------------------------------------------------------
// name: BODY()
// desc: BODY := ( _IF | BLOCK | STOP | . ) BODY
//--------------------------------------------------------
function BODY( $cparser, $terminateToken=NULL ){	
	$node = new CParseTreeNode("BODY");
	while( !$cparser->done() ){
		if( $terminateToken && $cparser->check( $terminateToken ) )
			break;	
		if( $_IF = $cparser->acceptNonToken("_IF") ){
			$node->add($_IF);
			continue;
		} // end if
		if( $_FOR =  $cparser->acceptNonToken("_FOR") ){
			$node->add($_FOR);
			continue;
			// _FOR( $cparser, $terminateTokenType=NULL )
		} // end if
		if( $BODY=$cparser->acceptTokenBlock("(", "BODY", ")") ){
			$node->add($BODY);
			continue;
		} // end if
		if( $BODY=$cparser->acceptTokenBlock("{", "BODY", "}") ){
			$node->add($BODY);
			continue;
		} // end if
		$cparser->acceptToken();
	} // end while()
	return $node;
} // end BODY()

//----------------------------------------------------------------------------
// name: _IF()
// desc: _IF := _if ( PARAMS ) { BODY } ((_elseif { BODY })* _else { BODY })
//----------------------------------------------------------------------------
function _IF( $cparser, $terminateTokenType=NULL ){
	$node = new CParseTreeNode("_IF");
	if( !$cparser->accept( "_if" ) )
		return NULL;
	$node->add( $cparser->token(-1)->setTranslation("_if" ));
	if( CONDITION_PART( $node, $cparser, $terminateTokenType ) == NULL )
		return NULL;
	if( BODY_PART( $node, $cparser, $terminateTokenType ) == NULL )
		return NULL;
	while($cparser->accept("_elseif")){
		$node->add( $cparser->token(-1)->setTranslation("._elseif" ));
		if( CONDITION_PART( $node, $cparser, $terminateTokenType ) == NULL )
			return NULL;
		if( BODY_PART( $node, $cparser, $terminateTokenType ) == NULL )
			return NULL;
	} // end while
	if( $cparser->accept("_else") ){
		$node->add( $cparser->token(-1)->setTranslation("._else(function()" ));
		if( BODY_PART( $node, $cparser, $terminateTokenType ) == NULL )
			return NULL;
	} // end if
	$cparser->token(-1)->appendTranslation(";"); // end of the statement
	return $node;
} // end _IF()

//--------------------------------------------------------
// name: CONDITION_PART()
// desc: processes the condition part of the if statement
//--------------------------------------------------------
function CONDITION_PART( $node, $cparser, $terminateTokenType=NULL ){
	if( !$cparser->accept( "(" ) )
		return NULL;
	$node->add( $cparser->token(-1)->setTranslation("( function(){ return ") );
	$condition = $cparser->acceptNonToken("BODY", ")");
	if( $condition )
		$node->add( $condition );
	if( !$cparser->accept( ")" ) )
		return NULL;
	$node->add( $cparser->token(-1)->setTranslation(";},function()") );
	return $node;
} // end CONDITION_PART()

//------------------------------------------------------
// name: BODY_PART()
// desc: processes the body part of the if statement
//------------------------------------------------------
function BODY_PART( $node, $cparser, $terminateTokenType=NULL ){
	if( !$cparser->accept( "{" ) ){
		return NULL;//STATEMENT_PART( $node, $cparser, $terminateTokenType );
	}
	$node->add( $cparser->token(-1)->setTranslation("{"));
	$body = $cparser->acceptNonToken("BODY", "}");
	if( $body )
		$node->add( $body );
	if( !$cparser->accept( "}" ) )
		return NULL;
	$node->add( $cparser->token(-1)->setTranslation("})"));
	return $node;
} // end BODY_PART()

//------------------------------------------------------
// name: STATEMENT_PART()
// desc: processes the body part of the if statement
//------------------------------------------------------
function STATEMENT_PART( $node, $cparser, $terminateTokenType=NULL ){
	if( !$cparser->acceptToken() )
		return NULL;
	$str = $cparser->tokenToString();
	$node->add( $cparser->token(-1)->setTranslation("{" + $str) );
	$body = $cparser->acceptNonToken("BODY", ";");		
	if( !$body )
		return NULL;
	$node->add( $body );
	if( !$cparser->accept( ";" ) )
		return NULL;
	$node->add( $cparser->token(-1)->setTranslation(";})"));
	return $node;
} // end STATEMENT_PART()

//--------------------------------------------------
// name: _FOR()
// desc: _FOR := _for ( PARAMS ) { BODY } 
//---------------------------------------------------
function _FOR( $cparser, $terminateTokenType=NULL ){
	$node = new CParseTreeNode("_FOR");
	if( !$cparser->accept( "_for" ) )
		return NULL;
	$node->add( $cparser->token(-1)->setTranslation("_for" ));
	if( CONDITION_PART( $node, $cparser, $terminateTokenType ) == NULL )
		return NULL;
	if( BODY_PART( $node, $cparser, $terminateTokenType ) == NULL )
		return NULL;
	$cparser->token(-1)->appendTranslation(";"); // end of the statement
	return $node;
} // end _FOR()

/*
function PARAMS_PART( $node, $cparser, $terminateTokenType ){
	if( !$cparser->accept( "(" ) )
		return NULL;
		
	$init = $cparser->token(-1);
	if( INIT_PART( $node, $cparser, ";" ) == NULL )
		return NULL;
	$node->add( $init->setTranslation("(function(){" ));
	
	$cond = $cparser->token(-1);
	if( COND_PART( $node, $cparser, ";" ) == NULL )
		return NULL;
	$node->add( $cond->setTranslation("; return function(){" ));
	
	$inc = $cparser->token(-1);
	if( INC_PART( $node, $cparser, ";" ) == NULL )
		return NULL;
	$node->add( $cond->setTranslation("; return function(){" ));
	
	
	$node->add( $cparser->token(-1)->setTranslation("( function(){ return ") );
	$condition = $cparser->acceptNonToken("BODY", ")");
	if( $condition )
		$node->add( $condition );
	if( !$cparser->accept( ")" ) )
		return NULL;
	$node->add( $cparser->token(-1)->setTranslation(";},function()") );
	return $node;
} // end PARAMS_PART()
*/
?>