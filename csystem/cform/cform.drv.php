<?php
//----------------------------------------------------------------------------
// file: cform.drv.php
// desc: defines a driver seperates html 
//----------------------------------------------------------------------------

// includes
include_js(relname(__FILE__) . "/cform.drv.js");

//---------------------------------------------------------------------------
// name: CForm_boundFieldName(), CForm_isFieldNameBounded()
// desc: this determines if the control or option is bounded to the cform.
//---------------------------------------------------------------------------
$bBoundFeildToCForm = true;
function CForm_boundFieldName($bBound=true){
	global $bBoundFeildToCForm;
	$bBoundFeildToCForm=$bBound;
} // end CForm_boundFieldName()
function CForm_isFieldNameBounded(){
	global $bBoundFeildToCForm;
	return $bBoundFeildToCForm;
} // end CForm_boundFieldName()

///////////////////////
// Options
///////////////////////

//--------------------------------------------------------------------
// name: COptions_processParams()
// desc: method used to do default crud on the incoming params
//--------------------------------------------------------------------
function COptions_processParams($params){
	if($params && !isset($params["coption-operator"]))
		return;
	$op = $params["coption-operator"];
	$name = $params["coption-name"];
	$name = $params["coption-id"];
	$value = isset($params["coption-value"]) ? $params["coption-value"] : "" ;
	
	/*
	$memid = isset($params["cform-cmemory-id"]) ? $params["cform-cmemory-id"] : "";
	
	if(!$memid) {
		return;
	} // end if
	
	// get the memory
	$cmemory = use_memory($memid);
	
	if($op == "get") {
		$cvar = $cmemory->retrieve($name);
		alert("getting the memory");
		return isset($cvar["m_value"]) ? $cvar["m_value"] : "";
	}
	else if($op == "set") {
		if(isset($_REQUEST[$name]) && $_REQUEST[$name] != "")
			$value = $_REQUEST[$name];
		if(!$cmemory->update($name, $value, "string"))
			$cmemory->create($name, $value, "string");
	}
	else if($op == "remove") {
		cmemory.delete($name);
		//unset($_REQUEST[$name]);
	}
	else { 
		// add the other stuff
	} // end else
	return;
	*/
	
	if($op=="get") {
		return isset($_REQUEST[$name]) ? $_REQUEST[$name] : "";
	}
	else if($op == "set") {
		$_REQUEST[$name]=$params["coption-value"];
	}
	else if($op == "remove") {
		unset($_REQUEST[$name]);
	}
	else { 
		// add the other stuff
	} // end else	
} // end COptions_processParams()

////////////////////
// controls
////////////////////

//--------------------------------------------------------
// name: CControls_processParams()
// desc: method used to process params
//--------------------------------------------------------
function CControls_processParams($params){
	if(!$params)
		return "";
	$strtype = $params["ccontrol-type"];
	$strid = $strname = $params["ccontrol-name"];
	$strid = $strname = $params["ccontrol-id"];
	$value = $params["ccontrol-value"];
	$attributes = $params["ccontrol-attributes"];	
	$strmemid = $params["cmemory-id"];
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
	
	// build the hidden control to hold the cmemory id
	if($strmemid) { 
		$attributes["type"] = "hidden";
		$attributes["id"] = "cmemory[$strid]";
		$attributes["name"] = "cmemory[$strname]";
		$attributes["value"] = $strmemid;
		$strcontrol = $strcontrol . " " . buildHTMLTag("input", $attributes);
	} // end if
	
	return $strcontrol;
} // end CControls_processParams()

//---------------------------------------------------------------------
// name: CForm_REQUEST_toJSON()
// desc: takes the request and make it available as a json object
//---------------------------------------------------------------------
function CForm_REQUEST_toJSON(){
	return "CForm._REQUEST = " . json_encode($_REQUEST) .";";
} // end CForm_REQUEST_toJSON()
CHook :: add("script", "CForm_REQUEST_toJSON"); 
?>