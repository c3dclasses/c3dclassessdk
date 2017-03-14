<?php
//---------------------------------------------------------------------------------
// file: cstring.php
// desc: defines string object similar to javascripts string object     
//---------------------------------------------------------------------------------

include_js(relname(__FILE__) . "/cstring.js");

//-------------------------------------------
// class CString
// desc: creates a string object
//-------------------------------------------
class CString {
	protected $m_str;
	public function CString($str) { $this->m_str = $str; } 
	public function length() { return strlen($this->m_str); } 
    public function charAt($iindex) { return ($this->m_str != "") ? $this->m_str[$iindex] : ""; }
	public function charCodeAt($iindex) { return ord($this->charAt($iindex));}
	public function indexOf($strstring, $istart=0) { return strpos($this->m_str, $strstring, $istart); } 
	public function lastIndexOf($strstring, $istart=0) { return strrpos($this->m_str, $strstring, $istart); }
	public function concat($mstrings) { return new CString($this->m_str.((is_array($mstrings)==true)?implode("",$mstrings):$mstrings));}
	public function fromCharCode($strings) {} 
	public function split($strdelimiter) { return new CArray(explode($strdelimiter, $this->m_str)); }
	public function substr($istart, $ilength=NULL) { 
		$params[] = $this->m_str;
		$params[] = $istart;
		if($ilength) $params[] = $ilength;
		return new CString(call_user_func_array("substr", $params));
	} // end substr()
	public function slice($istart, $iend) { return $this->substr($istart, $iend-$istart);}
	public function substring($istart, $iend) { return $this->slice($istart, $iend); }
	public function toUpperCase() { return new CString(strtoupper($this->m_str)); }
	public function toLowerCase() { return new CString(strtolower($this->m_str)); }
	public function valueOf() { return $this->m_str; }
	public function & _() { return $this->m_str; } 
	
	// regex methods	
	public function match($strregexp) { 
		$strregexp = new CString($strregexp);
		$ilastg = $strregexp->lastIndexOf("g");
		$ilastslash = $strregexp->lastIndexOf("/");
		if($ilastg < $ilastslash)
			return (preg_match($strregexp->valueOf(),$this->m_str,$arrstrmatches)<=0) ? NULL : carray($arrstrmatches[0]); 		
		$strafterg = $strregexp->substr($ilastg + 1);
		$strbeforeg = $strregexp->substring(0, $ilastg);
		$strregexp = $strbeforeg->valueOf() . $strafterg->valueOf();
		return (preg_match_all($strregexp,$this->m_str,$arrstrmatches)<=0) ? NULL : carray($arrstrmatches[0]); 
	} // end match()
	public function replace($strfindpattern, $strreplacepattern) { 
		$strfindpattern = new CString($strfindpattern);
		$ilastg = $strfindpattern->lastIndexOf("g");
		$ilastslash = $strfindpattern->lastIndexOf("/");	
		$bglobal = false;
		if($ilastg > $ilastslash) {	
			$strafterg = $strfindpattern->substr($ilastg + 1);
			$strbeforeg = $strfindpattern->substring(0, $ilastg);
			$strfindpattern = new CString($strbeforeg->valueOf() . $strafterg->valueOf());
			$bglobal = true;
		} // end if
		return preg_replace($strfindpattern->valueOf(), $strreplacepattern, $this->m_str, ($bglobal) ? -1 : 1);
	} // end replace()
	public function	replaceMatch($matches, $strreplace) { 
		return CString :: _replaceMatch($matches, $strreplace, $this->m_str);
	} // end replaceMatch()
	public static function _replaceMatch($matches, $strreplace, $strcontents) {
		if($matches == NULL || $strcontents == "" || $strcontents == NULL)
			return "";
		if(getTypeOf($matches) == "string")
			$strcontents = str_replace($matches , $strreplace , $strcontents);
		else if(getTypeOf($matches) == "array")
		 	foreach($matches as $match)
				$strcontents = CString :: _replaceMatch($match, $strreplace, $strcontents); 
		else if(getTypeOf($matches) == "object")
				$strcontents = CString :: _replaceMatch($matches->valueOf(), $strreplace, $strcontents);
		return $strcontents;
	} // end removeMatch()
} // end CString
?>