<?php
//----------------------------------------------------------------------------
// file: cthemeform.php
// desc: defines a form object for creating controls and options
//----------------------------------------------------------------------------

// includes
include_once("cform.drv.php");
include_once("coptions.php");
include_once("ccontrols.php");
include_js(relname(__FILE__) . "/cform.js");

//-----------------------------------------------------------------
// name: CForm
// desc: defines the form used in the application
//-----------------------------------------------------------------
class CForm {	
	// members
	protected $m_strname;		// stores the name of the form
	protected $m_params;		// stores the parameters of the form
	protected $m_coptions;		// stores the options of the form 
	protected $m_ccontrols;		// stores the controls of the form 
	
	public function CForm($COptionsType="COptions", $CControlsType="CControls") {	
		$this->m_params = NULL;
		$this->m_ccontrols = new $CControlsType();
		$this->m_coptions = new $COptionsType();
		$this->m_strname = "";
	} // end CForm()
	
	public function create($strname="", $params=NULL) {
		$this->m_ccontrols->create($this);
		$this->m_coptions->create($this);
		$this->m_params = $params;
		$this->m_strname = $strname;
		return true;
	} // end create()
	
	public function setName($strname) {
		$this->m_strname = $strname;
	} // end setName()
	
	
	public function getName() { 
		return $this->m_strname;
	} // end getName()
	
	public function getNameWithSuffix($strsuffix, $strdelimiter="_") {
		return ($this->m_strname) ? ($this->m_strname . $strdelimiter . $strsuffix) : $strsuffix;
	} // end getNameWithSuffix()

	public function getParams() { 
		return $this->m_params; 
	} // end getParams()

	public function getCOptions() { 
		return $this->m_coptions; 
	} // end getCOptions()
	
	public function getCControls() { 
		return $this->m_ccontrols; 
	} // end getCControls()
	
	
	public function getCForm($strname="", $params=NULL, $CFormType="CForm", $COptionsType="COptions", $CControlsType="CControls") {	
		if (!$strname || $strname=="")
			return NULL;		
		$cform = new $CFormType($COptionsType,$CControlsType);
		$strname = $this->getNameWithSuffix($strname);		
		$cform->create($strname,$params);
		return $cform;
	} // end getCForm()
} // end class CForm
?>