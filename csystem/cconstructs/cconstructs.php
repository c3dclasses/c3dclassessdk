<?php
//-----------------------------------------------------------------------------------------------
// file: cconstructs.js
// desc: defines constructs to use to simulate feature found in multithread programming lang 
//-----------------------------------------------------------------------------------------------

// headers
include_js( relname( __FILE__ ) . "/cconstructs.js" ); 


//--------------------------------------------------------------------------------
// name: CReturn
// desc: defines a return contruct or statement for asynchonous methods
// 		 its used in cdatastream objects that use ajax operations
//--------------------------------------------------------------------------------
class CReturn {
	
	public function CReturn() { 
		$this->m_data = NULL;
		$this->m_fnformat = NULL;
		$this->m_strerror = "";
		$this->m_icode = CReturn :: $_NULL;
		$this->m_strstatus = "";
		//$this->listener("_done");
		//$this->listener("_error");
		//$this->listener("_busy");
	} // end CReturn()
	
	public function error() {
		if( func_num_args() == 1  )
			$this->m_strerror = func_get_arg(0);
 		return $this->m_strerror; 
	} // end error()
	
	public function code() { 
		if( func_num_args() == 1  )
			$this->m_icode = func_get_arg(0);
 		return $this->m_icode; 
	} // end status();
	
	public function status() { 
		if( func_num_args() == 1  )
			$this->m_strstatus = func_get_arg(0);
 		return $this->m_strstatus; 
	} // end status();
	
	public function data() {
		if( func_num_args() == 1  )
			$this->m_data = func_get_arg(0);	
		return ($this->m_fnformat) ? $this->m_fnformat($this->m_data) : $this->m_data; 
	} // end data()

	public function results( $index=0 ) {
		return $this->data();
	} // end results
	
	public function formatefn($fn){
		$this->m_fnformat=fn;
	} // end format() 
	
	public function isdone(){ 
		return $this->m_icode== CReturn::$DONE;
	} // end isdone()
	
	public function isbusy(){
		return $this->m_icode==CReturn :: $BUSY;
	} // end isbusy()
	
	public function isnull(){
		return $this->m_icode==CReturn :: $_NULL;
	} // end isnull()
	
	public function iserror(){
		return $this->m_icode==CReturn :: $ERROR;
	} // end isnull()
	public function _return ($code, $data) {
		$this->code($code);
		$this->data($data);
		return $this;
	} // end _return()

	public function done($data) {
		return $this->_return(CReturn::$DONE, $data);
	} // end _done()

	public function busy() {
		return $this->_return(CReturn::$BUSY, NULL);
	} // end _busy()
	
	public function listener($strevent){
	//	if(!$strevent)
	//		return;
	//	$this[$strevent]=[];
	//	$this[$strevent]=function($fncallback){
	//		if(!$fncallback)
	//			return;
	//		$this[$strevent].push($fncallback);
	//	} // end function()
	} // end listener()
	
	public function doListener($strevent, $params){
	//	if(!$strevent || !$$this[$strevent])
	//		return;
	//	for($i=0; i<$$this[$strevent]->length; $i++) {
	//		$fncallback = $$this[$strevent];
	//		$fncallback($params);
	//	} // end for()
	//	return;
	} // doListener()
	
	// ClassMethods
	public static $_NULL = 0;	// the function/method is not called yet
	public static $BUSY = 1;	// the function/method has been called and it's busy
	public static $DONE = 2;	// the function/method has been called and it's done	
	public static $ERROR = 3;	// the function/method has been called and it has an error
 	// end ClassMethods
} // end CReturn()

//----------------------------------------------
// name: _return_done()
// desc: returns a completed asynchronous task
//----------------------------------------------
function _return($code, $data) {
	$_return = new CReturn();
	if(!$_return)
		return NULL;
	$_return->code($code);
	$_return->data($data);
	return $_return;
} // end _return()

function _return_done($data) {
	return _return(CReturn :: $DONE, $data);
} // end _return_done()

function _return_busy() {
	return _return(CReturn :: $BUSY, NULL);
} // end _return_busy()

//////////////////////////////
// other constructs
?>