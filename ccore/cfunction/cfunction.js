//-------------------------------------------------------
// file: cfunction.php
// desc: defines a function object
//-------------------------------------------------------

//--------------------------------------------------
// name: CFunction
// desc: provides a way to create remote functions
//--------------------------------------------------
var CFunction = new Class({ 
	Extends: CResource,
	initialize: function() { 
		this.parent(); 
	}, // end CFunction()
	
	open : function(strpath, params) {
		params = params || {};
		var strurifn = strpath.split("->");
		params["cfunction_uri"] = strurifn[0];
		params["cfunction_file"] = strurifn[1];
		params["cfunction_fn"] = strurifn[2];
		return this.parent(strpath, params);
	}, // end open()

	call : function(inparams) {
		return _return_remote_call(
			this.param("cfunction_uri"),
			this.param("cfunction_file"),
			this.param("cfunction_fn"),
			inparams
		); // end call()
	} // end call()
}); // end CFunction

// includes / use / import
function include_function(strid, strfn, struri, strfile, params) {
	params = params || {};
	params["cresource_type"] = "CFunction";
	return include_resource(strid, struri+"->"+strfile+"->"+strfn, params);
} // end include_function()

function use_function(strid){
	return use_resource(strid);
} // end use_function()

function import_function(strid, params) {
	if(!params)
		return false;
	var strpath = params["cfunction_id"];
	var strfile = params["cfunction_file"];
	var struri = params["cfunction_uri"];
	var strfn = params["cfunction_fn"];
	return include_function(strid, strfn, struri, strfile, params);
} // end import_cmemory()