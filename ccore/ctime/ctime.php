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
	public static function getMicroseconds() { return microtime(true); }
	public static function getMilliseconds() { return CTimer :: getMicroseconds(); }
	public static function getSeconds() { return (CTimer :: getMilliseconds() / 1000); }
} // end CTime
?>