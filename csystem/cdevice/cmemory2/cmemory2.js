//----------------------------------------------------------------
// file: cmemory.js
// desc: defines the memory object
//----------------------------------------------------------------

//----------------------------------------------------------------
// class: CMemory2
// desc: defines the memory object
//----------------------------------------------------------------
var CMemory2 = new Class({
	Extends : CResource,	// inherits the CResource
	initialize : function() { // CMemory2
		this.parent();
		this.m_cache = {}; 	
	}, // end CMemory2()
	
	//////////////////////
	// opening / closing
	open : function(strpath, params){
		return this.parent(strpath, params) &&
			CMemoryDriver._open(this) != null;
	}, // end open()	
	
	close : function(){
		this.m_cache = null;
		return CMemoryDriver._close(this);
	}, // end close()

	//////////////////////////
	// async CRUD operations
	create : function(strname, value, strtype, params) {
		return CMemoryDriver._create(this, {
			"m_strname":strname, 
			"m_value":value, 
			"m_strtype":strtype, 
			"m_params": params 
		}); // end CMemoryDriver.create()
	}, // end create()
	
	retrieve : function(strname){ 
		return CMemoryDriver._retrieve(this, strname);
	}, // end retrieve()
	
	update : function(strname, value, strtype, params){
		return CMemoryDriver._update(this, {
			"m_strname":strname, 
			"m_value":value, 
			"m_strtype":strtype, 
			"m_params": params 
		}); // end CMemoryDriver.update()
	}, // end update()
	
	delete : function(strname){
		return CMemoryDriver._delete(this, strname);
	}, // end delete()

	/////////////////////////
	// syncing
	sync : function() {
		return CMemoryDriver._sync(this); // sync local and remote memory
	}, // end sync() 

	////////////////////////
	// other
	cache : function() {
		return this.m_cache; 
	}, // end data()

	_toString : function(){
		return print_r(this.m_cache, true);
	}, // end toString()
	
	/////////////////////////
	// set / get
	set : function(strname, value) {
		if(!this.m_cache || !this.m_cache[strname])
			return;
		var cvar = this.m_cache[strname];
		cvar["m_value"]= value;
		CMemoryDriver._update(this, cvar);
		return;
	}, // end set()
	
	get : function(strname) {
		return (this.m_cache) ? this.m_cache[strname] : null;
	} // end get()
}); // end CMemory2()

/////////////////////////
// includes and using
function include_memory2(strid, strpath, strtype, params) {
	params = params || {};
	// setup the driver params
	var driver_params = params["cmemorydriver_params"] || {};
	driver_params["cmemorydriver_id"] = strtype + "::" + strid;
	driver_params["cmemorydriver_path"] = strpath;
	driver_params["cmemorydriver_type"] = strtype;
	params["cresource_type"] = "CMemory2";
	params["cmemorydriver_params"] = driver_params;
	return include_resource(strid, "CMemory2::" + strid, params);
} // end include_memory2()

function include_remote_memory2(strid, strpath, strtype, struri, params){
	params = params || {};
	// setup the driver params
	var driver_params = params["cmemorydriver_params"] || {};
	driver_params["cremotememorydriver_type"] = strtype;
	driver_params["cremotememorydriver_uri"] = struri; 	
	params["cmemorydriver_params"] = driver_params;	
	return include_memory2(strid, strpath, "CRemoteMemoryDriver", params);
} // end include_remote_memory2()

function use_memory2(strid) {
	return use_resource(strid)
} // end use_memory2()