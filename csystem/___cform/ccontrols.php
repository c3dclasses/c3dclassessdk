<?php
//---------------------------------------------------------
// file: ccontrols.php
// desc: defines a control used in the theme
//---------------------------------------------------------

// includes
include_js( relname(__FILE__) . "/ccontrols.js" );

//-----------------------------------------------------------------
// name: CControls
// desc: defines controls used inside a widget
//-----------------------------------------------------------------
class CControls{	
	protected $m_cform;
	protected $m_coptions;
	
	public function CControls(){
		$this->m_cform = NULL;
		$this->m_coptions = NULL;
	} // end CControls()
	
	public function create( $cform ){
		$this->m_cform = $cform;
		$this->m_coptions = $this->m_cform->getCOptions();
	} // end create()

	public function label( $strlabel, $strname, $params=NULL ){ 
		$attributes = $this->init( $strname, NULL, $params );
		$attributes["for"]=$attributes["name"];
		echo buildHTMLTag( "label", $attributes, true, $strlabel );		
	} // end label()
	
	public function hidden( $strname, $value, $params=NULL ){
		$attributes = $this->init( $strname, $value, $params );
		$attributes["value"]=$value;
		$attributes["type"]="hidden";
		echo buildHTMLTag( "input", $attributes, false, "" );		
	} // end hidden()
	
	public function text( $strname, $value, $params=NULL ){ 
		$attributes = $this->init( $strname, $value, $params );
		$attributes["type"]="text";
		echo buildHTMLTag( "input", $attributes, false, "" );		
	} // end textfield()
	
	public function	textarea( $strname, $value, $params=NULL ){ 
		$attributes = $this->init( $strname, $value, $params );
		if( isset( $attributes["value"] ) ){
			$value = $attributes["value"]; 
			unset( $attributes["value"] );
		} // end if
		echo buildHTMLTag( "textarea", $attributes, true, $value );		
	} // end textarea()
	
	public function checkbox( $strname, $value="", $params=NULL ){ 
		$attributes = $this->init( $strname, $value, $params );
		if( isset( $attributes["optexist"] ) ){
			$attributes["checked"]="checked";			
			unset( $attributes["optexist"] );
		} // end if
		$attributes["type"]="checkbox";
		echo buildHTMLTag( "input", $attributes, false, "" );		
	} // end checkbox()
	
	public function radio( $strname, $value="", $params=NULL ){ 
		$attributes = $this->init( $strname, $value, $params );
		if( $attributes["value"]==$value )
			$attributes["checked"]="checked";			
		$attributes["value"] = $value;
		$attributes["type"]="radio";
		echo buildHTMLTag( "input", $attributes, false, "");	
	} // end radio()
	
	public function button( $strname, $value, $params=NULL ){
		$attributes = $this->init( $strname, $value, $params );
		$attributes["type"]="button";
		$attributes["value"]=$value;
		echo buildHTMLTag( "input", $attributes, false, "");	
	} // end button()
	
	public function submit( $strname, $value, $params=NULL ){
		$attributes = $this->init( $strname, $value, $params );
		$attributes["type"]="submit";
		$attributes["value"]=$value;
		echo buildHTMLTag( "input", $attributes, false, "");	
	} // end submit()
	
	public function select( $strname, $index=0, $options=NULL, $params=NULL ){
		$selectedvalue = isset( $options[$index] ) ? $options[$index] : "";
		$attributes = $this->init( $strname, $selectedvalue, $params );
		if( isset( $attributes["value"] ) ){
			$selectedvalue = $attributes["value"];		
			unset( $attributes["value"] );
		} // end if
		$stroptions = "";
		if( $options ) 
			foreach( $options as $name=>$value ){ 
				$selected 	= ( $selectedvalue == $name ) ? "selected='selected'" : ""; 
				$stroptions	.= "<option {$selected} value=\"{$name}\">{$value}</option>"; 
			} // end foreach 		
		echo buildHTMLTag( "select", $attributes, true, $stroptions );	
	} // end select()
	
	public function init( $strname, $value, $params ){
		if( $this->m_coptions ){	
			$strid = $this->m_coptions->getFieldID($strname); 
			$strname = $this->m_coptions->getFieldName($strname); 
			$value = $this->m_coptions->optionExists($strname) ? $this->m_coptions->option($strname) : $value;	
		} // end if
		$attributes = isset( $params["attributes"] ) ? $params["attributes"] : NULL;
		$attributes["id"] = $strid;
		$attributes["name"] = $strname;
		if( $value ) 
			$attributes["value"] = $value;
		if( $this->m_coptions->optionExists($strname) ) 
			$attributes["optexist"] = true; 
		return $attributes;
	} // end init()
} // end class CControls
?>