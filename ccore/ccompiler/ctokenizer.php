<?php
//---------------------------------------------------------------------------
// name: ctokenizer.php
// desc: 
//---------------------------------------------------------------------------

// constants
if (!defined('PHP_EOF')) { define('PHP_EOF', '\0'); }

//--------------------------------------------------------
// name: CTokenTypes
// desc: defines the type of tokens to find
//--------------------------------------------------------
class CTokenType {
	// members
	public $m_strbegin;	// beginining of the token 
	public $m_strend;	// end of the token
	public $m_strtype; 	// the type of token (i.e. comment, _if, brace, etc. 
	
	public function CTokenType( $strtype, $strbegin, $strend ){
		$this->m_strtype = $strtype;
		$this->m_strbegin = $strbegin;
		$this->m_strend = $strend;
	} // end CTokenType()
} // end CTokenType

//--------------------------------------------------------
// name: CToken
// desc: token object
//--------------------------------------------------------
class CToken {
	// members
	public $m_spos = -1;	// start position of token in the input
	public $m_epos = -1;	// end position of token in the input
	public $m_strtype = ""; // type of token (i.e. comment, _if, etc .. );
	public $m_index = -1;
	public $m_strtranslation = "";
	
	public function CToken( $spos, $epos, $index, $strtype="unlabeled" ){
		$this->m_spos = $spos;
		$this->m_epos = $epos;
		$this->m_index = $index;
		$this->m_strtype = $strtype;
	} // end CToken()
	
 	public function toString( $strinput ){ 
		return ( ( $this->m_epos - $this->m_spos ) <= 0 || $strinput == "" ) ? 
		"" :substr( $strinput, $this->m_spos, $this->m_epos - $this->m_spos );
	} // end toString()
	
	public function toStringBeforeToken( $strinput, $offsetbefore=-1 ){
		return ( ( $this->m_spos - $offsetbefore ) <= 0 || $strinput == "" ) ? 
		"" :substr( $strinput, $offsetbefore, $this->m_spos - $offsetbefore );
	} // toStringBeforeToken();
	
	public function toStringAfterToken( $strinput, $offsetafter=-1 ){
		return ( ( $offsetafter - $this->m_epos ) <= 0 || $strinput == "" ) ? 
		"" :substr( $strinput, $this->m_epos, $offsetafter - $this->m_epos );
	} // toStringAfterToken();

	public function toStringTranslation( $strinput, $offset=-1 ){
		 return $this->m_strtranslation;
	} // toStringTranslation();
	
	public function getIndex(){
		return $this->m_index;
	} // end getIndex()
	
	public function getEndPos(){
		return $this->m_epos;
	} // end getEndPos()

	public function setTranslation( $strtranslation ){
		$this->m_strtranslation = $strtranslation;
		return $this;
	} // end setTranslation()
	
	public function getTranslation( $strtranslation ){
		$this->m_strtranslation = $strtranslation;
	} // end getTranslation()
	
	public function appendTranslation( $strappendtranslation ){
		$this->m_strtranslation .= $strappendtranslation;
	} // end getTranslation()
} // end CToken

//--------------------------------------------------------
// name: CTokenizer
// desc: tokenizer object
//--------------------------------------------------------
class CTokenizer {
	// members
	public $m_strinput;
	public $m_ctokens;
	public $m_ctokentypes;
	
	public function CTokenizer(){
		$this->m_ctokens = NULL;
		$this->m_strinput = "";
		$this->m_ctokentypes = NULL; 
	} // end CTokenizer()
	
	public function addTokenType( $strtype, $strbegin, $strend="" ){
		$this->m_ctokentypes[] = new CTokenType( $strtype, $strbegin, $strend );
	} // end addToken()
	
	public function create( $strinput ){
		if( $strinput == "" )
			return false;  
		
		$length = strlen($strinput);
		$this->m_strinput = $strinput;
		$s=0; $i=0;
		$index=0;
		while( $i<$length ){
			if( ($e=$this->buildToken($i)) ){
				if( $s < $i ){
					$ctoken = new CToken($s, $i, count($this->m_ctokens) );
					if( trim($ctoken->toString($strinput)) != "" ) // skip space tokens
						$this->m_ctokens[] = $ctoken;
				} // end if	
				$ctoken = new CToken($i, $e["epos"], count($this->m_ctokens), $e["type"]);
				if( trim($ctoken->toString($strinput)) != "" )	// skip space tokens
					$this->m_ctokens[] = $ctoken;
				$s = $i = $e["epos"];	
			} // end if
			else $i++;
		} // end while
		if( $s < $length ){
			$ctoken = new CToken( $s, $length, count($this->m_ctokens) );
			if( trim($ctoken->toString($strinput)) != "" ) // skip space tokens
				$this->m_ctokens[] = $ctoken;
		} // end if
		return true;
	} // end create()
	
	public function buildToken( $i ){
		if( $this->m_ctokentypes == NULL )
			return NULL;
		foreach( $this->m_ctokentypes as $index => $ctokentype ){
			// find the begining pattern of the token
			$length = strlen( $ctokentype->m_strbegin );
			if( substr( $this->m_strinput, $i, $length ) == $ctokentype->m_strbegin ){
				//alert("found begining: " .  $ctokentype->m_strbegin );
				if( $ctokentype->m_strend == "" )	// found the single-part token
					return array( "epos"=>($i + $length), "type"=>$ctokentype->m_strtype ); // return the position
				
				// find the ending pattern of the token 
				if( $ctokentype->m_strend == PHP_EOF ){
					//printbr("PHP_EOF");
					$length = strlen( $this->m_strinput );
					//printbr("found end: eof" .  $ctokentype->m_strend );
					return array( "epos"=>$length, "type"=>$ctokentype->m_strtype ); // return the position	
				} // end if
				
				else if( ($i2 = strpos( $this->m_strinput, $ctokentype->m_strend, $i + $length )) > -1 ){
					$length = strlen( $ctokentype->m_strend );
					//printbr("found end: eol" );
					//if( $ctokentype->m_strend == PHP_EOL )
					//	$length--;
					return array( "epos" => ($i2 + $length), "type"=>$ctokentype->m_strtype ); // return the position
				} // end if
			} // end if		
		} // end foreach()
		return NULL;
	} // end buildToken()
	
	public function getNumOfTokens(){
		return ( $this->m_ctokens ) ? count( $this->m_ctokens ) : 0;
	} // end getNumOfTokens()
	
	public function getTokens(){ 
		return $this->m_ctokens;
	} // end getTokens()
	
	public function getInput(){
		return $this->m_strinput;
	} // end getInput()
	
	public function printTokens(){
		foreach( $this->m_ctokens as $index => $ctoken )
			printbr( $index . ". (" . $ctoken->m_strtype  . ") -> " . $ctoken->toString( $this->m_strinput ) );
	} // end printTokens()
} // end CTokenizer
?>