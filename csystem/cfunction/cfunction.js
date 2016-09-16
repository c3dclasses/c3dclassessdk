//-------------------------------------------------------
// file: cfunction.php
// desc: provides a way to create remote functions
//       functions that can be called from a client
//-------------------------------------------------------

//--------------------------------------------------
// name: CFunction
// desc: provides a way to create remote functions
//--------------------------------------------------
var CFunction = new Class({
	Extends: CResource,

	open : function(strpath, params) {
		params = params || {};
		var strurifn = strpath.split("->");
		params["cfunction_uri"] = strurifn[0];
		params["cfunction_fn"] = strurifn[1];
		return parent($strpath, params);
	}, // end open()

	call : function(inparams) {
		return _return_remote_call(
			this.param("cfunction_uri"),
			this.param("cfunction_fn"),
			inparams
		); // end _return_remote_call()
	} // end call()
}); // end CFunction

// includes / use
function include_function(strid, strfn, struri, params) {
	params = params || {};
	params["cresource_type"] = "CFunction";
	return include_resource(strid, struri+"->"+strfn, params);
} // end include_function()

function use_function(strid){
	return use_resource(strid);
} // end use_function()