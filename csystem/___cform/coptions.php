<?php
//---------------------------------------------------------
// file: ccontrols.php
// desc: defines a control used in the theme
//---------------------------------------------------------

// includes and constants
include_js( relname(__FILE__) . "/coptions.js" );

//-----------------------------------------------------------------
// name: COptions
// desc: defines controls used inside a widget
//-----------------------------------------------------------------
class COptions {	
	protected $m_instance;		// stores all of the options
	protected $m_cform;			// stores the form this options belong to 
	
	public function COptions(){
		$this->m_instance = NULL;	// store the request as options		
		$this->m_cform = NULL;
	} // end COptions()
	
	public function create( $cform ){
		$this->m_instance = $_REQUEST;	// store the request as options	
		$this->m_cform = $cform;
	} // end create()

	// instance / field names / feild ids
	public function getFieldID( $strid ){ 
		return $strid;
	} // end getFieldID()
	
	public function getFieldName( $strname ){ 
		return $strname;
	} // end getFieldName()
	
	public function getInstance(){
		return $this->m_instance;
	} // end getInstance()
	
	// options
	public function option( $strname ){ 
		$instance = $this->getInstance();
		$strname = $this->getFieldName( $strname );	
		if( func_num_args() == 1 )	
			return isset( $instance[$strname] ) ? $instance[$strname] : ""; 	
		$this->m_instance[$strname]=func_get_arg(1); 
		return;
	} // end option()	
	
	public function optionExists( $strname ){
		$instance = $this->getInstance();
		$strname = $this->getFieldName( $strname );
		return ( $instance == NULL ) ? false : isset( $instance[ $strname ] );
	} // end optionExists()
	
	public function removeOption( $strname ){
		$strname = $this->getFieldName( $strname );
		if( $this->optionExists( $strname ) )
			unset( $this->m_instance[ $strname ] );
	} // removeOption()
	
	// uses cmemory and cvar for persistences
	public function storeOption( $strname ){
		$strmemid = ($this->m_cform) ? $this->m_cform->getMemoryID() : "";
		$strname = $this->getFieldName( $strname );
		if( $this->optionExists( $strname ) == false || $strmemid == "" ||
			!( $cvar = _var( $strmemid, $strname ) ) )
			return false;
		$cvar->_( $this->option($strname) );
		return true;
	} // end storeOption()
	
	public function restoreOption( $strname ){
		$strmemid = ($this->m_cform) ? $this->m_cform->getMemoryID() : "";
		if(!( $cvar = _var( $strmemid, $strname ) ) )
			return false;	
		$this->option($strname, $cvar->_());
		return true;
	} // end restoreOption()
	
	public function deleteOption( $strname ){
		$strname = $this->getFieldName( $strname );
		$strmemid = ($this->m_cform) ? $this->m_cform->getMemoryID() : "";
		if( $this->optionExists( $strname ) == false || 
			$strmemid == "" ||
			!( $cvar = _var( $strmemid, $strname ) ) )
			return false;
		$this->removeOption($strname);
		delvar($cvar);	
		return true;
	} // end deleteOption()
} // end class COptions
?>