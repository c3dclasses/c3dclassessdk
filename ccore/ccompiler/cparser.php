<?php
//---------------------------------------------------------------------------
// file: cparser.php
// desc: parses the tokens of the input
//---------------------------------------------------------------------------

//---------------------------------------------------------------------
// name: CParser 
// desc: parses the tokens of the input
//---------------------------------------------------------------------
class CParser {
	// members
	public $m_ctokenizer;
	public $m_ctokens;
	public $m_ictokenindex;
	public $m_parsetree;
	public $m_strinput;
	
	public function CParser(){
		$this->m_ctokenizer = NULL;
		$this->m_ctokens = NULL;
		$this->m_parsetree = NULL;
		$this->m_ictokenindex = -1;
	} // end CParser()

	public function create( $ctokenizer ){
		if( !$ctokenizer && $ctokenizer->getNumOfTokens() < 1 )
			return false;
		$this->m_ctokenizer = $ctokenizer;
		$this->m_ctokens = $ctokenizer->getTokens();
        $this->m_ictokenindex = 0;
		$this->m_strinput = $this->m_ctokenizer->getInput();
		return true;
	} // end create()
	
	public function done(){
		return ( $this->m_ctokenizer == "" || $this->m_ictokenindex >= $this->m_ctokenizer->getNumOfTokens() );
	} // end done()
	
	public function accept( $strtokentype=NULL ){
		return $this->acceptToken( $strtokentype );
	} // end accept()
	
	public function acceptToken( $strtokentype=NULL ){
		if( $strtokentype === NULL ){	
			$this->m_ictokenindex++;
			return TRUE;
		} // end if
		if( !$this->check($strtokentype) )
			return FALSE;		
		$this->m_ictokenindex++;	// consume
		return TRUE;
	} // end acceptToken()
	
	public function acceptTokenBlock( $strtokentypebegin, $callbacknontoken, $strtokentypeend ){
		if( !$this->accept( $strtokentypebegin ) )
			return NULL;
		$nontoken = $this->acceptNonToken($callbacknontoken, $strtokentypeend );
		if( !$nontoken || !$this->accept( $strtokentypeend ) )
			return NULL;
		return $nontoken;
	} // end acceptTokenBlock()
	
	public function acceptNonToken( $callbackNonToken, $strterminationtokentype=NULL, $brollbackonfailure=false ){
		if( $callbackNonToken == NULL || function_exists( $callbackNonToken ) == FALSE ) 
			return NULL;
		$itokenindex = $this->m_ictokenindex;
		$ret = $callbackNonToken( $this,  $strterminationtokentype );
		if( $ret == NULL && $brollbackonfailure == true )
			$this->m_ictokenindex = $itokenindex;
		return $ret;
	} // end acceptNonToken()
	
	public function getTokenIndex(){
		return $this->m_ictokenindex;
	} // end getTokenIndex()
	
	public function setTokenIndex( $ictokenindex ){
		return $this->m_ictokenindex = $ictokenindex;
	} // end getTokenIndex()
	
	public function getParseTree(){
		return $this->m_parsetree;
	} // end getParseTree()	
	
	public function token( $prevnextindex=0 ){
		return ( $this->m_ctokens && 
				 isset( $this->m_ctokens[$this->m_ictokenindex + $prevnextindex] ) &&
				( $ctoken = $this->m_ctokens[$this->m_ictokenindex + $prevnextindex] ) )
				? $ctoken : NULL; 
	} // end token()
	
	public function tokenToString( $prevnextindex=0 ){
		return ( !$ctoken = $this->token( $prevnextindex ) ) ? '' : $ctoken->toString($this->m_ctokenizer->getInput());
	} // end token()
	
	public function check( $strtokentype ){
		return ( !$this->done() && $strtokentype && ( $this->m_ctokens[$this->m_ictokenindex]->m_strtype == $strtokentype ) );
	} // end check()	
	
	public function parse( $callback, $strterminatetoken="" ){		
		return ( $this->m_parsetree = $this->acceptNonToken( $callback, $strterminatetoken ) );
	} // end parse()
	
	public function translate(){	
		$index = 0;
		$str = $this->translate_rec( $this->m_parsetree, $index );
		$length = strlen( $this->m_strinput ) - $index;
		$str .= ( ( $length ) <= 0 || $this->m_strinput == "" ) ? "" : substr( $this->m_strinput, $index, $length );
		return $str;
	} // translate()
	
	public function translate_rec( $cparsetreenode, &$index ){		
		$str="";
		if( !$cparsetreenode )
			return $str;
		if( get_class( $cparsetreenode ) == "CToken" ){
			$str .= $cparsetreenode->toStringBeforeToken( $this->m_strinput, $index );
			$str .= $cparsetreenode->toStringTranslation( $this->m_strinput );
			$index = $cparsetreenode->getEndPos();
			return $str; // return the translation
		} // end if
		if( get_class( $cparsetreenode ) == "CParseTreeNode" && $nodes=$cparsetreenode->getParseTreeNodes() )
			foreach( $cparsetreenode->getParseTreeNodes() as $node )
				$str .= $this->translate_rec( $node, $index );
		return $str;
	} // end translate_rec()
} // end CParser

//-----------------------------------------------------
// name: CParseTreeNode
// desc: defines a parse tree node
//-----------------------------------------------------
class CParseTreeNode {
	// members
	public $m_cparsetreenodes; // children nodes
	public $m_strname;	// name of the node
	
	public function CParseTreeNode( $strname ){
		$this->m_cparsetreenodes = NULL;
		$this->m_strname = $strname;
	} // end CParseTreeNode()
	
	public function add( $ctoken ){
		$this->m_cparsetreenodes[] = $ctoken;
	} // end addToken()

	public function getParseTreeNodes(){
		return $this->m_cparsetreenodes;
	} // end getParseTreeNode()
	
	public function getName(){
		return $this->m_strname;
	}  // end getName()
} // end CParseTreeNode
?>