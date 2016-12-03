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

	public static function toString($value) {
		$type = gettype($value);
		
		print_r($type);
		if($type === "boolean") 
			return ($value) ? "true" : "false";
		return $value;
	} // end toString()
	
	public static function toJSONString($value) {
		return json_encode($value);
	} // end toJSON()
	
	public static function toJSONObject($value, $bassoc=true) {
		return json_decode($value, $bassoc);
	} // end toJSONObject()
} // end CParse