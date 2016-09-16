//----------------------------------------------------------------------------
// file: cfunction.drv.js
// desc: provides hooks and listeners to link remote functions to the system
//----------------------------------------------------------------------------

//---------------------------------------------
// name: _return_remote_call()
// desc: does the function call
//---------------------------------------------
function _return_remote_call(struri, strfn, inparams) {
    if(!struri) { // do a local function call
        if (strfn && typeof(strfn) == "function")
            return strfn.call(inparams);
        else return _return_done(null);
    } // end if
    // do a remote call
    var cds = new CDataStream();	// create
    if( !cds || cds.open( struri, "post", "cfunction" ) == false ) // open
        return null;
    cds.setDataParam("cfunction",true);
    cds.setDataParam("cfunction_name", strfn);
    if(inparams){
        for(var name in inparams) {
            cds.setDataParam( name, inparams[name] );
        } // end for
    } // end if
    cds.options("m_basync",false);
    return cds.send();
} // end _return_remote_call()