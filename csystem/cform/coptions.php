<?php
//---------------------------------------------------------
// file: coptions.php
// desc: defines the options object of the form
//---------------------------------------------------------

// includes
include_js(relname(__FILE__) . "/coptions.js");

//-----------------------------------------------------------------
// name: COptions
// desc: defines options used by the cform 
//-----------------------------------------------------------------
class COptions {	
	public $m_cform;
	protected $m_cmemoryid;
	public function COptions(){ $this->m_cform=NULL; $this->m_cmemoryid = "";}	
	public function use_memory($strcmemoryid){ $this->m_cmemoryid = $strcmemoryid; } 
	public function getCMemoryID() { return $this->m_cmemoryid; }
	public function create($cform){ $this->m_cform=$cform; }
	public function bound(){ CForm_boundFieldName(true); return $this; }
	public function unbound(){ CForm_boundFieldName(false); return $this; }
	public function optionExists($strname){ return ($this->processOption("get",$strname) != NULL); } 
	public function removeOption($strname){ $this->processOption("remove", $strname); }
	public function option(){ 
		if(func_num_args() > 1){ 
			$this->processOption("set", func_get_arg(0), func_get_arg(1));
			return $this;
		} // end if
		else return $this->processOption("get", func_get_arg(0));
	} // end option()
	public function processOption($stroperator, $strname, $strvalue=NULL, $params=NULL){ 
		if(!$this->m_cform || !$strname || $strname == "")
			return;
		$_params["coption-operator"]=$stroperator;
		$_params["coption-name"]=$strname; 
		$_params["coption-id"]=$this->m_cform->getNameWithSuffix($strname); 
		$_params["coption-value"]=$strvalue;
		$_params["coption-params"]=$params;
		$_params["cmemory-id"]=$this->getCMemoryID();
		return $this->processParams($_params);
	} // end processOption()
	// override this behavior to process the option
	public function processParams($params){ return COptions_processParams($params); } 
} // end class COptions
?>