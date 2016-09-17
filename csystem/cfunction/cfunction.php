<?php
//-------------------------------------------------------
// file: cfunction.php
// desc: provides a way to create remote functions
//       functions that can be called from a client
//-------------------------------------------------------

// includes
include_js(relname(__FILE__) . "/cfunction.js");
include_js(relname(__FILE__) . "/cfunction.drv.js");

//--------------------------------------------------
// name: CFunction
// desc: provides a way to create remote functions
//--------------------------------------------------
class CFunction extends CResource {
	public function CFunction() {
		parent :: CResource();
	} // end CFunction()
	
    public function open($strpath, $params) {
        $strurifn = explode("->", $strpath);
        $params["cfunction_uri"] = isset($strurifn[0])?$strurifn[0]:NULL;
        $params["cfunction_file"] = isset($strurifn[1])?$strurifn[1]:NULL;
	$params["cfunction_fn"] = isset($strurifn[2])?$strurifn[2]:NULL;
        return parent :: open($strpath, $params);
    } // end open()

    public function call($inparams) {
        return _return_remote_call(
            $this->param("cfunction_uri"),
            $this->param("cfunction_file"),
			$this->param("cfunction_fn"),
            $inparams
        ); // end call()
    } // end call()
} // end CFunction

// includes / use
function include_function($strid, $strfn, $struri="", $strfile="", $params=NULL) {	
	$params["cresource_type"] = "CFunction";
	return include_resource($strid, $struri."->".$strfile."->".$strfn, $params);
} // end include_function()

function use_function($strid){
	return use_resource($strid);
} // end use_function()
?>