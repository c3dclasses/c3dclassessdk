<?php
//---------------------------------------------------------------------------
// name: ccompiler.php
// desc: defines a compiler object
//---------------------------------------------------------------------------

// includes
include_once("ctokenizer.php");
include_once("cparser.php");

//--------------------------------------------------------
// name: CComplier
// desc: the compiler object
//--------------------------------------------------------
class CCompiler {
	// members
	public $m_ctokenizer = NULL;
	public $m_cparser = NULL;
//	public $m_parsetree = NULL;
	
	public function CCompiler(){
		$this->m_cparser = NULL;
//		$this->m_strinput = "";
//		$this->m_parsetree = NULL;
		$this->m_ctokenizer = new CTokenizer();
	} // end CCompiler
	
	public function create( $strinput ){
		// create the tokenizer
		if( !$this->m_ctokenizer || !$this->m_ctokenizer->create( $strinput ) )
			return false;
		// create the parser
		$this->m_cparser = new CParser();
		if( !$this->m_cparser || !$this->m_cparser->create( $this->m_ctokenizer ) )
			return false;
		return true;
	} // end create()
	
	public function getParser(){
		return $this->m_cparser;
	} // end getParser()

	public function getTokenizer(){
		return $this->m_ctokenizer;
	} // end getTokenizer()
	
	/*
	public function getParseTree(){
		return $this->m_parsetree;
	} // end getParseTree()	
	 */
	 
	public function getInput(){
		return ( $this->m_ctokenizer ) ? $this->m_ctokenizer->getInput() : "";
	} // end getInput()
	
	/*
	public function parse( $callback, $strterminatetoken="" ){		
		if( !$callback || !$this->m_cparser )
			return FALSE;
		$this->m_parsetree = $this->m_cparser->acceptNonTerminal( $callback, $strterminatetoken );
		return TRUE;
	} // end parse()
	*/
} // end CComplier
?>