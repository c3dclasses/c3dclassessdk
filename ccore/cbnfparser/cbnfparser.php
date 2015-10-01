<?php
//----------------------------------------------------------------------------------------
// file: cbnfparser.php
// desc: defines a bnf parser object 
//----------------------------------------------------------------------------------------

// includes
include("_preg.php");

//----------------------------------------------------------------------------------------
// file: CBNFParser
// desc: defines a bnf parser object 
//----------------------------------------------------------------------------------------
class CBNFParser {
	// members
	public 	  $m_arrproductions;	// stores the productions
	protected $m_arrterminals;		// stores the terminals
	protected $m_arrnonterminals;	// stores the nonterminals
	protected $m_strstartsymbol;	// stores the start sysmbol
	protected $m_arrsyntaxtree;	    // stores the syntax tree after parsing
    protected $m_strcontents;
	
	//------------------------------------------------------
	// name: CBNFParser
	// desc: bnf parser class
	//------------------------------------------------------
	public function CBNFParser() {
		$this->m_arrproductions  = NULL;
		$this->m_arrterminals 	 = NULL;
		$this->m_arrnonterminals = NULL;
		$this->m_strstartsymbol  = NULL;
		$this->m_arrsyntaxtree   = NULL;
        $this->m_strcontents     = NULL;
	} // end CBNFParser()
	
	//------------------------------------------------------
	// name: create()
	// desc: creates the bnfparser object
	//------------------------------------------------------
	public function create($arrproductions, $strstartsymbol) {
		if ($arrproductions == NULL)
			return false;
        if (_preg_explode_productions($arrproductions, $arrnonterminals, $arrterminals) == NULL)
			return false;
        if ($this->isNonTerminal($strstartsymbol))
            return false;
		$this->m_arrproductions  = $arrproductions;
		$this->m_arrterminals	 = $arrterminals;
		$this->m_arrnonterminals = $arrnonterminals;
		$this->m_strstartsymbol	 = $strstartsymbol;
		return true;
	} // end create()
	
	//--------------------------------------------------------
	// name: parse()
	// desc: parse content against the BNF language
	//--------------------------------------------------------
	public function parse($strcontent) {
		if ($strcontent == NULL)
			return false;
        $this->m_strcontents = $strcontent;
        $matches = $this->_parse($strcontent, $this->m_strstartsymbol);
		$this->m_arrsyntaxtree = $matches;
		return true;
	} // end parse()
	
	//---------------------------------------------------------
	// name: traverseTerminals()
	// desc: traverses the tree an visits each termianl node
	//---------------------------------------------------------
	public function traverseTerminals($fnvisit) {
		if ($this->m_arrsyntaxtree == NULL || function_exists($fnvisit) == false)
			return false;
		$this->_traverseTerminals($this->m_arrsyntaxtree, $fnvisit);
		return true;
	} // end traverseTerminals()
	
	//----------------------------------------------------------------------------
	// name: tostring()
	// desc: prints the productions, terminals, nonterminal, start symbol, etc..
	//----------------------------------------------------------------------------
	public function toString() {
        ob_start();
		printbr("Terminals");
		print_r($this->m_arrterminals);
		printbr();
		printbr();
		printbr("NonTerminals");
		print_r($this->m_arrnonterminals);
		printbr();
		printbr();
		printbr("Start Symbol");
		print_r($this->m_strstartsymbol);
		printbr();
		printbr();	
		printbr("Productions");
		print_r($this->m_arrproductions);
		printbr();
		printbr();	
        if($this->m_arrsyntaxtree)
        {
            printbr("Content");
            printbr($this->m_strcontents);
           	printbr();
            printbr("Syntax Tree");
		    print_r($this->m_arrsyntaxtree);
		    printbr();
			printbr();	
        } // end if
        $str = ob_get_contents(); 
		ob_end_clean();
        return $str;
    } // end print()
	
	//--------------------------------------------------------
	// name: isNonTerminal
	// desc: checks if the symbol is a non terminal
	//--------------------------------------------------------
	public function isNonTerminal($symbol) {
		return _preg_is_nonterminal($this->m_arrnonterminals, $symbol);
	} // end isNonTerminal()
	
	//--------------------------------------------------------
	// name: isTerminal
	// desc: checks if the symbol is a terminal
	//--------------------------------------------------------
	public function isTerminal($symbol) {
		return _preg_is_terminal($this->m_arrterminals, $symbol);
	} // end isTerminal()
	
	///////////////////////////
	// helper methods
	
    //---------------------------------------------------------
	// name: _traverseTerminals()
	// desc: traverses the tree an visits each termianl node
	//---------------------------------------------------------
	public function _traverseTerminals($node, $fnvisit) {
		$len = count($node);
		if ($len == 0)
			return;
		if ($len == 1 || isset($node['terminal'])==true) {
			$fnvisit($node[0]);
			return; 
		} // end if
		for($i=0; $i<$len; $i++)
			$this->_traverseTerminals($node[$i], $fnvisit);
		return;
	} // end _traverseTerminals()
    
    //--------------------------------------------------------
	// name: _parse()
	// desc: parse content against the BNF language 
	//--------------------------------------------------------
	public function _parse(&$strcontent, $symbol) {
		if ($symbol == NULL || $strcontent == NULL)
			return NULL;
		if ($this->isTerminal($symbol))
            return $this->_parseTerminal($strcontent, $symbol);
        else if ($this->isNonTerminal($symbol))
			return $this->_parseProduction($strcontent, $symbol);
		return NULL;
	} // end _parse()
    
    //-------------------------------------------------------
    // name: _parseTerminal()
    // desc: parses the terminal
    //-------------------------------------------------------
    public function _parseTerminal(&$strcontent, $symbol) {
        $inumatches = _preg_match_ex("/^" . $symbol . "/", $strcontent, $matches);
        if ($inumatches < 1 && $symbol != "NULL")
            return NULL;
        else if ($symbol == "NULL") {
            $matches[0] = $symbol;
            $matches[$symbol] = $symbol;
        } // end else if
        $matches["terminal"] = true;
        return $matches;
    } // end _parseTerminal()
    
	//-------------------------------------------------------
	// name: _parseRule()
	// desc: parses the rule
	//-------------------------------------------------------
	public function _parseRule(&$strcontent, $arrrule) {
		if ($arrrule == NULL || $strcontent == NULL)
			return NULL;
		$l = count($arrrule);
		$allmatches = NULL;
		$oldcontent = $strcontent;
		for($i = 0; $i < $l; $i++) {
			if (($matches = $this->_parse($strcontent, $arrrule[$i])) == NULL)
			{
				$strcontent = $oldcontent;
				return NULL;
			} // end if
			$allmatches[] = $matches; 
		} // end for
		return (count($allmatches) <= 1) ? $allmatches[0] : $allmatches; 
	} // end _parseRule()
	
	//--------------------------------------------------------
	// name: _parseProduction()
	// desc: parses a nonterminal
	//--------------------------------------------------------
	public function _parseProduction(&$strcontent, $symbol) {
		if ($symbol == NULL || $strcontent == NULL || isset($this->m_arrproductions[$symbol]) == false)
			return NULL;
        $production = $this->m_arrproductions[$symbol];
		$l = count($production);
		$match = NULL;
		for($i = 0; $i < $l; $i++) {
			if (($match = $this->_parseRule($strcontent, $production[$i])) != NULL)
				break;
		} // for
		return $match;
	} // end _parseProduction()
} // end CBNFParser
?>