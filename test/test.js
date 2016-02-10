//-----------------------------------------------------------------------------
// file: test.js
// desc: sets up c3dclasses testing framework
//-----------------------------------------------------------------------------
var ckernal = CKernal.createCKernal("CKernal"); // create the programs in this documents
if(!ckernal) {
	console.log("ERROR: CKernal.createCKernal()"); 
} // end if
ckernal.init();
// ready() -> load() -> unload().
$(document).ready(function(){
	ckernal.ready();
}); // end ready 
$(window).load(function(){
	ckernal.load();
	ckernal.main();
}); // end load()
$(window).resize(function(){
	ckernal.resize();
}); // end resize()
$(window).unload(function(){
	ckernal.unload();
	ckernal.deinit();
	CKernal.destroyCKernal(ckernal);
}); // end unload()