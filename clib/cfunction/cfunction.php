<?php
//----------------------------------------------------------------
// file: cfunction.php
// desc: defines a function as an object for the purposes of attaching
//       data associated with it 
//----------------------------------------------------------------

//-----------------------------------------------------------------------
// file: CFunction
// desc: defines a function as an object for the purposes of attaching
//       data associated with it 
//-----------------------------------------------------------------------
class CFunction {	
	protected $m_fn;
	public function CFunction() {
		$this->m_fn = NULL;
	} // end CFunction()
	
	public function create($fn) {		
		if(!CFunction :: isAFunction($fn))
			return false;
		$this->m_fn = $fn;
		return true;		
	} // end create()
	
	public function bind($_this) {
		//$this->m_fn = bind($this->m_fn, $_this);
		//return $this;
		return bind($this->m_fn, $_this);
	} // end bind()
	
	public function _() {
		$fn = $this->m_fn;
		return $fn();
	} // end _()
	
	////////////////////
	// static methods
	public static function isACFunction($mixed) {
		return $mixed instanceof CFunction;
	} // end isACFunction()
	
	public static function isAFunction($mixed) {
		return ( $mixed instanceof Closure || CFunction :: isACFunction($mixed) || 
		(($type=gettype( $mixed )) && $type == "string" && function_exists($mixed)));
	} // end isAFunction()
} // end CFunction

//---------------------------------------------
// name: _function(), _fn()
// desc: 
//---------------------------------------------
function _function($function) {
	return (!($cfunction = new CFunction()) || !$cfunction->create($function)) ? NULL : $cfunction; 
} // end _function()

function _fn($function) {
	return _function($function); 
} // end _fn()
?>