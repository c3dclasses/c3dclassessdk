<?php
//---------------------------------------------------------------------------------
// file: cmath.php
// desc: defines string object similar to javascripts string object     
//---------------------------------------------------------------------------------

// headers
include_js(relname(__FILE__)."/cmath.js");

//-------------------------------------------
// class CMath
// desc: the math class object
//-------------------------------------------
class CMath{
	static public $E 		= 2.718281828459045;
	static public $LN2 		= 0.6931471805599453;
	static public $LN10		= 2.302585092994046;
	static public $LOG2E 	= 1.4426950408889634;
	static public $LOG10E	= 0.4342944819032518;
	static public $PI		= 3.141592653589793; 		
	static public $SQRT1_2	= 0.7071067811865476; 	
	static public $SQRT2	= 1.4142135623730951; 
	static public function abs($x){ return abs($x); }
	static public function acos($x){ return acos($x); }
	static public function asin($x){ return asin($x); }
	static public function atan($x){ return atan($x); }
	static public function atan2($x){ return atan2($x); }
	static public function ceil($x){ return ceil($x); }
	static public function cos($x){ return cos($x); }
	static public function exp($x){ return exp($x); }
	static public function floor($x){ return floor($x); }
	static public function log($x){ return log($x); }
	static public function sin($x){ return sin($x); }
	static public function sqrt($x){ return sqrt($x); }
	static public function tan($x){ return log($x); }
	static public function max($arrnumbers){ return max($arrnumbers); }
	static public function min($arrnumbers){ return min($arrnumbers); }
	static public function pow($x,$y){ return pow($x,$y); }
	static public function rand(){ return (rand(0, 10000) * 0.0001); }
	static public function round($x){ return round($x); }
	static public function in($num, $min, $max){ return ($min<=$num) && ($num<=$max); }
	static public function bound($inum, $imin, $imax){ if($inum<$imin) $inum=$imin; else if($inum>$imax) $inum=$imax; return $inum; }
} // end CMath
?>