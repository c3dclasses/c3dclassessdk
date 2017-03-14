<?php
//----------------------------------------------------------------
// file: cstdio.drv.php
// desc: input and output helper classes
//----------------------------------------------------------------

// header
include_js(relname(__FILE__) . "/cstdio.drv.js");

//-------------------------------------------------------------------
// file: CStdio
// desc: contains standard input and output function
//-------------------------------------------------------------------
class CStdio {	
	/////////////////
	// ClassMethods
	
	//-----------------------------------------------
	// name: _print()
	// desc: prints to a destination
	//-----------------------------------------------
	public static function _print($str="") {
		print($str);
	} // end _print()
	
	//-----------------------------------------------
	// name: _printScript()
	// desc: helper to print script for client
	//-----------------------------------------------
	public static function _printScript($str) {
		CStdio :: _print("<script parse=\"false\">$str</script>"); 
	} // end _printInScriptTag()
} // end CStdio

//--------------------------------------------------------------
// file: CObqueue
// desc: queues string/object contents to be dumped later
//--------------------------------------------------------------
class CObqueue {
	// members
	static protected $m_cobqueues=NULL;
	protected $m_content;
	
	// methods
	public function CObqueue(){
		$this->m_content="";
	} // end CObqueue()	
	public function create($params=NULL) {
		return true;
	} // end create()
	public function getContent(){ 
		return $this->m_content;
	} // end getContent();
	public function setContent($content) { 
		$this->m_content = $content;
	} // end setContent();
	
	// static methods
	public static function createCObqueue($strid, $params=NULL) {
		if($strid == NULL || $strid == "")
			return NULL;
		if(!CObqueue :: $m_cobqueues)
			CObqueue :: $m_cobqueues = array();	
		if(!isset(CObqueue :: $m_cobqueues[$strid]) &&
			($cobqueue = new CObqueue()) &&
			$cobqueue->create($params)) {
			CObqueue :: $m_cobqueues[$strid] = $cobqueue;
		} // end if
		else $cobqueue = CObqueue :: $m_cobqueues[$strid];
		return $cobqueue;
	} // createCObqueue()
	public static function  dumpCObqueue($strid) {
		return (CObqueue :: $m_cobqueues && isset(CObqueue :: $m_cobqueues[$strid])) 
			? CObqueue :: $m_cobqueues[$strid]->getContent() : NULL;
	} // end dumpCObqueue()
} // end CObqueue
?>