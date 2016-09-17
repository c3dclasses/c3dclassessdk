<?php
//----------------------------------------------------------------------------
// file: cfunction.drv.php
// desc: provides hooks and listeners to link remote functions to the system
//----------------------------------------------------------------------------

//---------------------------------------------
// name: _return_remote_call()
// desc: does the function call
//---------------------------------------------
function _return_remote_call($struri, $strfile, $strfn, $inparams) {
	if(!$struri) { // do a local function call
        if ($strfn && gettype($strfn) == "function")
            return call_user_func($strfn,$inparams);
        else return _return_done(NULL);
    } // end if
    // do a remote call
    $cds = new CDataStream();	// create
    if(!$cds || $cds->open($struri, "post", "cfunction") == false) // open
        return _return_done(NULL);
    $cds->setDataParam("cfunction",true);
    $cds->setDataParam("cfunction_uri",$struri);	// server of the function
	$cds->setDataParam("cfunction_file",$strfile);	// file of the function 
	$cds->setDataParam("cfunction_function",$strfn); 	// name of the function
	if($inparams && gettype($inparams) == "array") {
        foreach($inparams as $name=>$value) {
            $cds->setDataParam($name,$value);
        } // end foreach
    } // end if
	else $cds->setDataParam("cfunction_inparam",$inparams);
    $cds->send();
	return _return_done($cds->getData());
} // end _return_remote_call()

//-------------------------------------
// name: 
// desc: check if there's a request
//-------------------------------------
if($_REQUEST) {
	// include the bootstrap stuff
	$isCFunction = isset($_REQUEST["cfunction"]);
	$file = isset($_REQUEST["cfunction_file"]) ? $_REQUEST["cfunction_file"] : "";
	$function = isset($_REQUEST["cfunction_function"]) ? $_REQUEST["cfunction_function"] : "";
	$inparams = isset($_REQUEST["cfunction_inparam"]) ? $_REQUEST["cfunction_inparam"] : $_REQUEST;
	
	if($isCFunction && $function) {
		//print_r($_REQUEST);
		include_once("../../ccore/ccore.php");
		include_once("../csystem.php");
		
	$outparams = NULL;
	$file = urldecode($file);
	$function = urldecode($function);
	include_once($file);
	if(function_exists($function)) {
		$_return = call_user_func($function, $inparams);
		echo json_encode($_return->data());
	} // end if
	else echo json_encode($outparams); 
	}
} // end if

//-------------------------------------------------
// name: export_cfunction()
// desc: exports cfunction to js 
//-------------------------------------------------
?>
