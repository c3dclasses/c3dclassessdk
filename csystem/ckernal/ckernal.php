<?php
//-------------------------------------------------------------------------------
// file: ckernal.php
// desc: fires and manages all the celement/cprogram/chook objects on the webpage
//-------------------------------------------------------------------------------

// includes
include_js(relname(__FILE__) . "/ckernal.js");

//---------------------------------------------------------
// class: CKernal
// desc: defines a kernal object
//---------------------------------------------------------
class CKernal {
	// members
	public $m_strstyle;
	public $m_strscript;
	public $m_strfscript;
	public $m_strbody;
	public function CKernal() {
		$this->m_strbody = "";
		$this->m_strscript = "";
		$this->m_strfscript = "";
		$this->m_strstyle = "";
		CHook :: fire("construct");
		session_start();
	} // end CKernal()

	// creating / loading / initializing / processing methods
	public function create() { return CHook::fire("create"); }
	public function destroy() { return CHook :: fire("destroy"); }
	public function	load($strprogrampath) { return includephpfilesfrompath($strprogrampath, ".prg.php"); }
	public function unload() { return CHook :: fire("unload"); }
	public function init() { return CHook :: fire("init"); }
	public function deinit() { return CHook :: fire("deinit"); }
	public function s_main() { return CHook::fire("s_main"); }
	
	// html head / header / body / footer / foot rendering methods
	public function head() { return CKernal_doHead($this); }
	public function headr() { return CHook :: fire("header"); }
	public function body() { return CKernal_doBody($this); }
	public function prebody() { CKernal_doPreBody($this); } 
	public function footer() { return CHook :: fire("footer"); }
	public function foot() { return CKernal_doFoot($this); }
	public function render($functemplate=NULL) { if(function_exists($functemplate)) $functemplate($this); }
	
	// creating / destroying methods
	static public function createCKernal($strclasstype, $strmainentrypoint=NULL) { 
		if(($ckernal = new $strclasstype()) == FALSE) 
			return NULL; 
		CPath :: add("main", $strmainentrypoint, array("client"=>"true"));
		$ckernal->create(); 
		return $ckernal; 
	} // end createCKernal()
	
	static public function destroyCKernal($ckernal) { 
		if($ckernal) 
			echo $ckernal->destroy(); 
	} // end destroyCKernal()
} // end CKernal
?>