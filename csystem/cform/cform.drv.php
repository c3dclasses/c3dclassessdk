<?php
//----------------------------------------------------------------------------
// file: cform.drv.php
// desc: defines a driver seperates html 
//----------------------------------------------------------------------------

//--------------------------------------------------------------------
// name: COptions_processParams()
// desc: method used to do default crud on the incoming params
//--------------------------------------------------------------------
function COptions_processParams($params){
	if($params && isset($params["coption-cmemory-id"]))
		return COptions_processParamsOnCMemory($params);
	if($params && !isset($params["coption-operator"]))
		return;
	$op = $params["coption-operator"];
	$name = $params["coption-name"];	
	if($op=="get")
		return isset($_REQUEST[$name]) ? $_REQUEST[$name] : "";
	else if($op == "set")
		$_REQUEST[$name]=$params["coption-value"];
	else if($op == "remove")
		unset($_REQUEST[$name]);
	else { 
		// add the other stuff
	} // end else
} // end COptions_processParams()

//--------------------------------------------------------
// name: COptions_processParams()
// desc: method used to do CRUD on cmemory location
//--------------------------------------------------------
function COptions_processParamsOnCMemory($params){
	if(!$params ||
	   !isset($params["coption-operator"]) ||
	   !isset($params["coption-cmemory-id"]))
		return "";
	$op = $params["coption-operator"];
	$name = $params["coption-name"];	
	$id = $params["coption-cmemory-id"];
	$cmemory = use_memory($id);
	if(!$cmemory)
		return "";
	if($op=="get") {
		$loc = $cmemory->retrieve($name);
		return ($loc) ? $loc["m_value"] : "";
	}
	else if($op == "set") {
		$cmemory->update($name, $params["coption-value"], "string");
	}
	else if($op == "remove")
		$cmemory->delete($name);
	else { 
		// add the other stuff
	} // end else
} // end COptions_processParams()



//--------------------------------------------------------
// name: CControls_processParams()
// desc: method used to process params
//--------------------------------------------------------
function CControls_processParams($params){
	if(!$params)
		return;
	$strtype = $params["ccontrol-type"];
	$strid = $strname = $params["ccontrol-name"];
	$value = $params["ccontrol-value"];
	$params = $params["ccontrol-params"];
	$attributes = isset( $params["attributes"] ) ? $params["attributes"] : NULL;	// attributes
	
	$strcontrol="";
	if($strtype == "section")
		$strcontrol = "";
	else if($strtype == "form")
		$strcontrol = "<form>";
	else if($strtype == "endform")
		$strcontrol = "</form>";		
	else if($strtype == "label")
		$strcontrol = "<label for=\"$strname\">$value</label>";
	else if($strtype == "text") {
		$attributes["type"] = "text";
		$attributes["class"] = "widefat";
		$attributes["id"] = $strid;
		$attributes["name"] = $strname;
		$attributes["value"] = $value;
		//$strcontrol = "<input type=\"text\" class=\"widefat\" id=\"$strid\" name=\"$strname\" value=\"$value\" />";
		$strcontrol = buildTag("input", $attributes);
	}
	else if($strtype == "hidden")	
		$strcontrol = "<input type=\"hidden\" class=\"widefat\" id=\"$strid\" name=\"$strname\" value=\"$value\" />";		
	else if($strtype == "textarea")
		$strcontrol = "<textarea type=\"text\" class=\"widefat\" id=\"$strid\" name=\"$strname\">$value</textarea>";
	else if($strtype == "checkbox")
		$strcontrol = "<input class=\"checkbox\" id=\"$strid\" name=\"$strname\" type=\"checkbox\" value=\"$value\" />";
	else if($strtype == "radio")
		$strcontrol = "<input class=\"radio\" id=\"$strid\" name=\"$strname\" type=\"radio\" value=\"$value\" />";
	else if($strtype == "button")
		$strcontrol = "<input type=\"button\" id=\"$strid\" name=\"$strname\" value=\"{$value}\" />";
	else if($strtype == "submit")
		$strcontrol = "<input type=\"submit\" id=\"$strid\" name=\"$strname\" value=\"{$value}\" />";
	else if($strtype == "select"){
		$selectedvalue = $value;
		$stroptions = "";
		if($options=$params["choices"]) 
			foreach($options as $name=>$ovalue){ 
				$selected = ($selectedvalue == $name) ? "selected=''" : ""; 
				$stroptions	.= "<option {$selected} value=\"{$name}\">{$ovalue}</option>"; 
			} // end foreach 
		$strcontrol = "<select class=\"widefat\" id=\"$strid\" name=\"$strname\">$stroptions</select>";
	} // end else if
	else return;
	return $strcontrol;
} // end CControls_processParams()

/*
public function init( $strname, $value, $params ){
	$attributes = isset( $params["attributes"] ) ? $params["attributes"] : NULL;
	$attributes["id"] = $strid;
	$attributes["name"] = $strname;
	if( $value ) 
		$attributes["value"] = $value;
	if( $this->m_coptions->optionExists($strname) ) 
		$attributes["optexist"] = true; 
	return $attributes;
	} // end init()
*/

//-----------------------------------------------------------------
// name: helper functions
// desc: 
//-----------------------------------------------------------------
function buildTag($strtagname, $attributes){
	$strattributes="";
	foreach( $attributes as $name => $value )
		$strattributes .= "$name=\"$value\" ";
	return "<{$strtagname} {$strattributes}>"; 
} // end buildHTMLTag()


/*
//-----------------------------------------------------------------
// name: helper functions
// desc: 
//-----------------------------------------------------------------
function buildHTMLTag( $strtagname, $attributes, $bmultitag=false, $strbody="" ){
	$strattributes="";
	foreach( $attributes as $name => $value )
		$strattributes .= "$name=\"$value\" ";
	$str = "<{$strtagname} {$strattributes}"; 
	$str .= ( $bmultitag )? ">{$strbody}</{$strtagname}>" : "/>";
	return $str;
} // end buildHTMLTag()

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
*/
?>