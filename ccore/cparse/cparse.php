<?php
//-------------------------------------------------------------------
// file: cparse.php
// desc: contains parsing methods
//-------------------------------------------------------------------

//-------------------------------------------------------------------
// file: CParse
// desc: contains parsing methods
//-------------------------------------------------------------------
class CParse {
	public static function toInt($str) { 
		return intval($str); 
	} // end toInt()

	public static function toFloat($str) { 
		return floatval($str);
	} // end toFloat()

	public function toString($value) {
		$type = gettype($value);
		if($type == "boolean") 
			return ($value) ? "true" : "false";
		return $value;
	} // end toString()
	
	public function toJSON($value) {
		return json_encode($value);
	} // end toJSON()
	
	public function toJSONObject($value, $bassoc=true) {
		return json_decode($value, $bassoc);
	} // end toJSONObject()
} // end CParse