<?php
//----------------------------------------------------------------------------------------
// file: _preg.php
// desc: extends phps preg_* methods to work with regular expressions 
//----------------------------------------------------------------------------------------

////////////////////////////////
// more preg_* functions

//--------------------------------------------------------------------------
// name: _preg_remove_matches()
// desc: removes the matches from the content string and updates it
//--------------------------------------------------------------------------
function _preg_remove_matches($arrstrmatches, $inummatches, &$strcontent) {
	if($arrstrmatches == NULL || $strcontent == "" || $strcontent == NULL)
		return false;
	//print_r($arrstrmatches);
	for ($i=0; $i<$inummatches; $i++) {
		$strmatch = $arrstrmatches[$i];
		if($strmatch != NULL || $strmatch != "") 
			$strcontent = substr($strcontent,(strpos($strcontent,$strmatch)+strlen($strmatch)));
	} // end for ()
	return true;
} // _preg_remove_matches()

//---------------------------------------------------------------------------
// name: _preg_match_ex()
// desc: finds and returns matches and removes the matches from the content
//---------------------------------------------------------------------------
function _preg_match_ex($strregex, &$strcontent, &$arrmatches) {
	$inummatches = preg_match($strregex, $strcontent, $arrmatches);
	if($inummatches >= 0)
		_preg_remove_matches($arrmatches, $inummatches, $strcontent);
	return $inummatches;
} // end _preg_match_ex()

//---------------------------------------------------------------------------------
// name: _preg_explode()
// desc: breaks up the array of productions and returns an array of rules. 
//		 Each rule contains and array of terminals/nonterminals of the expression 
// demo: $strregex = $P['E']="<<E>>+<<E>>||<<E>>*<<E>>||<<E>>/<<E>>"; 
//		 becomes....
//		 $P['E'][0] = array("<<E>>","+","<<E>>");
//		 $P['E'][1] = array("<<E>>","*","<<E>>");
//		 $P['E'][2] = array("<<E>>","/","<<E>>");
//---------------------------------------------------------------------------------
function _preg_explode_productions(&$P, &$NT, &$T) {
	if($P == NULL)
		return NULL;
		
	foreach($P as $p => $R) {
		$NT[$p] = $p;
		if(is_string($R) == true)
			$P[$p] = _preg_explode_rules($R);
		else if(is_array($R) == true) {
			$l = count($R);
			for ($i=0; $i<$l; $i++) {
				if(($r = _preg_explode_rules($R[$i])) != NULL)
					$P[$p][] = $r;
			} // end for
		} // end else	
	} // end foreach
	
	foreach($P as $p => $R) {
		$l = count($R);
		for ($i = 0; $i < $l; $i++) {
			$ll = count($R[$i]);
			for ($ii = 0; $ii < $ll; $ii++) {
				if(_preg_is_nonterminal($NT, $R[$i][$ii]) == false)
					$T[$R[$i][$ii]] = $R[$i][$ii];
			} // for
		} // end for
	} // end for
	
	return $P;
} // end _preg_explode()

//-----------------------------------------------------------------------
// name: _preg_explode_rules()
// desc: breaks the string of rules into an array then return the array
//-----------------------------------------------------------------------
function _preg_explode_rules($R) {
	if($R == NULL)
		return NULL;
	$R = explode("||", $R);	
	$l = count($R);
	for ($i = 0; $i < $l; $i++)
		$R[$i] = _preg_explode_rule($R[$i]);
	return $R;
} // end _preg_explode_rules()

//----------------------------------------------------------------------------------------------------
// name: _preg_explode_rule()
// desc: breaks a single string of rules and returns an array of symbol of terminal and nonterminal
//----------------------------------------------------------------------------------------------------
function _preg_explode_rule($strregex) {
	if($strregex == NULL)
		return NULL;
		
	$arrregex = NULL;
	$arrlstr = explode("<<", $strregex);
	$l = count($arrlstr);
	
	if($l == 0) {
		$arrregex[] = $strregex;
		return $arrregex;
	} // end if
	
	for ($i = 0; $i < $l; $i++) {
		$arrrstr = explode(">>", $arrlstr[$i]);
		$ll = count($arrrstr);
	
		if($ll == 0) {
			if($arrrstr[$i] != "")
				$arrregex[] = $arrrstr[$i];
			continue;
		} // end if
		
		for ($ii=0; $ii < $ll; $ii++) {
			if($arrrstr[$ii] != "")
				$arrregex[] = $arrrstr[$ii];
		} // end for ()
	} // end for ()
	
	return $arrregex;
} // _preg_explode_rule()	

//---------------------------------------------------------------
// name: _preg_is_nonterminal()
// desc: checks if a given symbol is a terminal or nonterminal
//---------------------------------------------------------------
function _preg_is_nonterminal($nonterminals, $symbol) {
	return ($symbol == NULL) ? false : isset($nonterminals[ $symbol ]); 
} // _preg_is_nonterminal()

//---------------------------------------------------------------
// name: _preg_is_terminal()
// desc: checks if a given symbol is a terminal
//---------------------------------------------------------------
function _preg_is_terminal($terminals, $symbol) {
	return ($symbol == NULL) ? false : isset($terminals[ $symbol ]); 
} // _preg_is_terminal()
?>
