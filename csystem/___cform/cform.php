<?php
//---------------------------------------------------------
// file: cform.php
// desc: defines a control used in the theme
//---------------------------------------------------------

// includes
include_js( relname(__FILE__) . "/cform.js", array( "location"=>"foot" ) );
include_once("coptions.php");
include_once("ccontrols.php");

//-----------------------------------------------------------------
// name: CForm
// desc: defines controls used inside a widget
//-----------------------------------------------------------------
class CForm extends CElement{	
	protected $m_instance;		// stores the forms request/instance
	protected $m_strmemid;		// stores the memoryid for persistent storage of the form
	protected $m_strbody;		// stores the body of the form
	protected $m_coptions;		// stores the options of the form 
	protected $m_ccontrols;		// stores the controls of the form 
	
	public function CForm(){
		parent :: CElement();
		$this->tag("form");
		$this->m_instance = NULL;	// store the request as options		
		$this->m_strmemid = "";
		$this->m_ccontrols = new CControls();
		$this->m_coptions = new COptions();
		$this->m_strbody = "";
	} // end CForm()
	
	public function create( $strmemid="" ){
		$this->m_strmemid = $strmemid;
		$this->m_instance = $_REQUEST;	// store the request as options		
		$this->m_ccontrols->create( $this );
		$this->m_coptions->create( $this );
		if( $strmemid && ($memory = use_memory( $this->m_strmemid )) && $memory->getParams()->get("client") == true )
			$this->prop( "m_strmemid", $this->m_strmemid );
		return true;
	} // end create()

	public function load(){
return <<<JSCRIPT
		//alert("the memid is: " + this.m_strmemid );
JSCRIPT;
	} // end load()
	
	public function getCOptions(){
		return $this->m_coptions;
	} // getCOptions()
	
	public function getCControls(){
		return $this->m_ccontrols;
	} // getCControls()

	public function begin( $strname="", $strid="" ){
		ob_start();
		return $this->m_ccontrols;
	} // end begin()
	
	public function end(){
		$this->m_strbody = ob_end();
	} // end end()

	public function toString_InnerHTML(){
		return $this->m_strbody . parent :: toString_InnerHTML();	
	} // end toString_InnerHTML()
	
	public function getMemoryID(){
		return $this->m_strmemid;
	} // getOption()
} // end class CForm
?>