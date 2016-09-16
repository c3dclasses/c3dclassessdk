<?php
//----------------------------------------------------------------------------
// file: cfunction.drv.php
// desc: provides hooks and listeners to link remote functions to the system
//----------------------------------------------------------------------------

//---------------------------------------------
// name: _return_remote_call()
// desc: does the function call
//---------------------------------------------
function _return_remote_call($struri, $strfn, $inparams) {
if(!$struri) { // do a local function call
        if ($strfn && is_callable($strfn) == "function")
            return call_user_func($strfn,$inparams);
        else return _return_done(NULL);
    } // end if
    // do a remote call
    $cds = new CDataStream();
    if(!$cds || $cds->open($struri, "post", "cfunction") == false) // open
        return _return_done(NULL);
    $cds->setDataParam("cfunction",true);
    $cds->setDataParam("cfunction_name",$strfn);
    if($inparams) {
        foreach($inparams as $name=>$value) {
            $cds->setDataParam($name,$value);
        } // end foreach
    } // end if
    $cds->options("m_basync",false);
    return $cds.send();
} // end _return_remote_call()
?>