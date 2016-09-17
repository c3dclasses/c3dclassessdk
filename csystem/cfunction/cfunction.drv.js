//----------------------------------------------------------------------------
// file: cfunction.drv.js
// desc: provides hooks and listeners to link remote functions to the system
//----------------------------------------------------------------------------

//---------------------------------------------
// name: _return_remote_call()
// desc: implements the remote call
//---------------------------------------------
function _return_remote_call(struri, strfile, strfn, inparams) {
    if(!struri) { // do a local function call
        if (strfn && typeof(strfn) == "function")
            return strfn.call(inparams);
        else return _return_done(null);
    } // end if
    // do a remote call
    var cds = new CDataStream();	// create
    if( !cds || cds.open( struri, "post", "cfunction" ) == false ) { // open
      	alert("failed");
	    return _return_done(null);
	}
    cds.setDataParam("cfunction",true);
    cds.setDataParam("cfunction_uri",struri);
    cds.setDataParam("cfunction_file",strfile);
    cds.setDataParam("cfunction_function", strfn);
    if(inparams && typeof(inparams)=="array"){
        for(var name in inparams) {
            cds.setDataParam(name, inparams[name]);
        } // end for
    } // end if
    else cds.setDataParam("cfunction_inparam",inparams);
    alert("sending");
	return cds.send();
} // end _return_remote_call()