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
		$cmemory->update($name, $params["coption-value"], "string");	// the control type defines the type for the value so pass in
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
		return "";
	$strtype = $params["ccontrol-type"];
	$strid = $strname = $params["ccontrol-name"];
	$value = $params["ccontrol-value"];
	$attributes = $params["ccontrol-attributes"];	
	$params = $params["ccontrol-params"];
	$strcontrol="";
	
	if($strtype == "section") {
		$strcontrol = "";
	} // end if
	else if($strtype == "form") {
		$attributes["id"] = $strid;
		$attributes["name"] = $strname;
		$attributes["value"] = $value;
		$strcontrol = buildHTMLOpenTag("form", $attributes);
	} // end elseif
	else if($strtype == "endform") { 
		$strcontrol = "</form>";//buildHTMLTag("/form");
	}  // end elseif
	else if($strtype == "label") {
		$attributes["for"] = $strname;
		$strcontrol = buildHTMLTag("label", $attributes, true, $value);
	} // end elseif
	else if($strtype == "text") {
		$attributes["type"] = "text";
		$attributes["class"] = "widefat";
		$attributes["id"] = $strid;
		$attributes["name"] = $strname;
		$attributes["value"] = $value;
		$strcontrol = buildHTMLTag("input", $attributes);
	} // end elseif
	else if($strtype == "hidden"){	
		$attributes["type"] = "hidden";
		$attributes["class"] = "widefat";
		$attributes["id"] = $strid;
		$attributes["name"] = $strname;
		$attributes["value"] = $value;
		$strcontrol = buildHTMLTag("input", $attributes);
	} // end elseif
	else if($strtype == "textarea") {
		$attributes["type"] = "text";
		$attributes["class"] = "widefat";
		$attributes["id"] = $strid;
		$attributes["name"] = $strname;
		$strcontrol = buildHTMLTag("textarea", $attributes, true, $value);
	} // end elseif
	else if($strtype == "checkbox") {
		$attributes["type"] = "checkbox";
		$attributes["id"] = $strid;
		$attributes["name"] = $strname;
		$attributes["value"] = $value;	
		$strcontrol = buildHTMLTag("input", $attributes);
	} // end elseif
	else if($strtype == "radio") {
		$attributes["type"] = "radio";
		$attributes["id"] = $strid;
		$attributes["name"] = $strname;
		$attributes["value"] = $value;	
		$strcontrol = buildHTMLTag("input", $attributes);
	} // end elseif
	else if($strtype == "button") {
		$attributes["type"] = "button";
		$attributes["id"] = $strid;
		$attributes["name"] = $strname;
		$attributes["value"] = $value;
		$strcontrol = buildHTMLTag("input", $attributes);
	} // end elseif
	else if($strtype == "submit") {
		$attributes["type"] = "submit";
		$attributes["id"] = $strid;
		$attributes["name"] = $strname;
		$attributes["value"] = $value;
		$strcontrol = buildHTMLTag("input", $attributes);
	} // end elseif
	else if($strtype == "select"){
		$selectedvalue = $value;
		$stroptions = "";
		if($options=$params["choices"]) {
			foreach($options as $name=>$ovalue){ 
				$selected = ($selectedvalue == $name) ? "selected=''" : ""; 
				$attr = NULL;
				if($selected) $attr["selected"] = '';
				$attr["value"] = $name;
				$stroptions .= buildHTMLTag("option", $attr, true, $ovalue);
			} // end foreach 
		} // end if
		$attributes["id"] = $strid;
		$attributes["name"] = $strname;
		$attributes["value"] = $value;
		$attributes["class"] = "widefat";
		$strcontrol = buildHTMLTag("select", $attributes, true, $stroptions);	
	} // end else if
	return $strcontrol;
} // end CControls_processParams()
?>