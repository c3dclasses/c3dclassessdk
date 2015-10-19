<?php
//---------------------------------------------------------
// file: ccontrols.php
// desc: defines controls used inside a form
//---------------------------------------------------------

// includes
include_js(relname(__FILE__) . "/ccontrols.js");

//-----------------------------------------------------------------
// name: CControls
// desc: defines controls used inside a form
//-----------------------------------------------------------------
class CControls {		
	protected $m_cform;
	public function CControls(){}	
	
	public function create($cform){ $this->m_cform = $cform; return true; }
	public function form($strname, $value, $params=NULL){ return $this->control("form", $strname, $value, $params);}
	public function endform(){ return $this->control("endform",NULL,NULL,NULL); }
	public function section($strname, $strlabel, $params=NULL){ return $this->control("section", $strname, $strlabel, $params);}
	public function label($strname, $value, $params=NULL){ return $this->control("label", $strname, $value, $params);}
	public function hidden($strname, $value, $params=NULL){ return $this->control("hidden", $strname, $value, $params);}
	public function text($strname, $value, $params=NULL){ return $this->control("text", $strname, $value, $params);}
	
	public function text_ex($strname, $value, $params=NULL){ return $this->text($strname, $value, $params) . $this->button( "btn-" . $strname, "submit"); }
	
	public function	textarea($strname, $value, $params=NULL){ return $this->control("textarea", $strname, $value, $params);}
	public function select($strname, $value, $options=NULL, $params=NULL){return $this->control_choices("select", $strname, $value, $options, $params);}
	public function checkbox($strname, $value, $params=NULL){ return $this->control("checkbox", $strname, $value, $params);}
	public function radio($strname, $value, $options=NULL, $params=NULL){return $this->control_choices("radio", $strname, $value, $options, $params);}
	public function button($strname, $value, $params=NULL){ return $this->control("button", $strname, $value, $params);} 
	public function submit($strname, $value, $params=NULL){ return $this->control("submit", $strname, $value, $params);} 
	public function dropDownPages($strname, $value, $params=NULL){ return $this->control("dropdown-pages", $strname, $value, $params); }
	public function colorpicker($strname, $value, $params=NULL){ return $this->control("color", $strname, $value, $params); }
	public function image($strname, $value, $params=NULL){ return $this->control("image", $strname, $value, $params); }
	public function fileupload($strname, $value, $params=NULL){ return $this->control("fileupload", $strname, $value,$params); }
	public function control_choices($strtype, $strname, $value, $options, $params){
		$params['choices']=$options; 
		return $this->control($strtype, $strname, $value, $params);
	} // end control_choices()
	public function control($strtype, $strname, $value, $params){
		if($this->m_cform && ($coptions = $this->m_cform->getCOptions()) && $strtype != "label")
			$value = ($coptions->optionExists($strname)) ? $coptions->option($strname) : $value;
		$_params["ccontrol-type"]=$strtype;
		$_params["ccontrol-name"]=$strname; 
		$_params["ccontrol-id"]=$this->m_cform->getNameWithSuffix($strname);
		$_params["ccontrol-value"]=$value;
		$_params["ccontrol-params"]=$params;
		return $this->processParams($_params);
	} // end control()
	public function processParams($params){ return CControls_processParams($params); } 
} // end class CControls
?>