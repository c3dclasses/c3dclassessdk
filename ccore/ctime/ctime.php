<?php
//----------------------------------------------
// name: ctime.php
// desc: time object
//----------------------------------------------

// includes
include_js(relname(__FILE__) . "/ctime.js");

//----------------------------------------------
// name: CTime
// desc: time object
//----------------------------------------------
class CTime {
	public static function us() { return CTime :: ms() * 1000; }
	public static function ms() { return CTime :: s() * 1000; }
	public static function s() { return intval(microtime(TRUE)); }
} // end CTime
?>