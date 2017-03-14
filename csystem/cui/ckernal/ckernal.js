//-------------------------------------------------------------------------------
// file: ckernal.js
// desc: fires and manages all the celement/cprogram/chook objects on the webpage
//-------------------------------------------------------------------------------

//---------------------------------------------------------
// class: CKernal
// desc: defines a kernal object
//---------------------------------------------------------
var CKernal = new Class ({
	// methods
	create : function() { return true; },
 	destroy : function() { },
	load : function() { CHook.fire("create"); return CHook.fire("load"); },
	unload : function() { CHook.fire("create"); return CHook.fire("unload"); },
	ready : function() { return CHook.fire("ready"); },
	resize : function() { return CHook.fire("resize"); },
	init : function() { return CHook.fire("init"); },
	deinit : function() { return CHook.fire("deinit"); },
	main : function() { return CHook.fire("main"); },
	info : function() {},
	
	// classmethods
	ClassMethods : {
		createCKernal : function (strclasstype) { 
			var ckernal = null; 
			return  ((ckernal = new window[strclasstype]()) == null || ckernal.create() == false) ? null : ckernal; 
		}, // end destroyCKernal()
		destroyCKernal : function (ckernal) { 
			if (ckernal) 
				ckernal.destroy(); 
		}, // end destroyCKernal()
		uri : function() {
			return ckernal_uri;
		} // end uri()
	} // end ClassMethods
}); // end CKernal