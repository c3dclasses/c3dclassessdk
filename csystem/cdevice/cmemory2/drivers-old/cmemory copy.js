//----------------------------------------------------------------
// file: cmemory.js
// desc: defines a memory object
//----------------------------------------------------------------

//----------------------------------------------------------------
// class: CMemory
// desc: defines a memory object
//----------------------------------------------------------------
var CMemory = new Class({
	Extends : CResource,	// inherits the CResource

	intialize : function(){
		// members
		this.m_cache = null; 	// stores the variables format: {name:{m_strname:name, m_value:value, m_strtype:type, m_params:param}}
	}, // end CMemory()

	//////////////////////
	// opening / closing
	open : function(strpath, params){
		if(!parent::open(strpath, params))
			return false;
		if(params) {
			this.m_cache = params;
			return true;
		} // end if
		return (this.sync() !== null);
	}, // end open()
	
	close : function(){
		this.m_cache = null;
	}, // end close()

	//////////////////////
	// CRUD
	create : function(strname, value, strtype, params) {
		return CMemoryDriver.create(this, strname, value, strtype, params);
	}, // end create()
	
	retrieve : function(strname){ 
		return CMemoryDriver.retrieve(this,strname);
	}, // end retrieve()
	
	update : function(strname, value, strtype){
		return CMemoryDriver.update(this, strname, value, strtype);
	}, // end update()
	
	delete : function(strname){
		return CMemoryDriver.delete(this, strname);
	}, // end delete()

	/////////////////////////
	// syncing
	sync : function() {
		return CMemoryDriver.sync(this); // sync local and remote memory
	}, // end sync() 

	////////////////////////
	// other
	cache : function() {
		return this.m_cache; 
	}, // end data()

	getType : function() {
		return this.m_strtype;
	}, // end getType()

	_toString : function(){
		return "type: " + this.m_strtype + " cache: " + print_r(this.m_cache, true);
	} // end toString()
}); // end CMemory()

function include_memory(strid, strpath, strtype, params){
	params["cresource_type"] = strtype;
	return include_resource(strid, strpath, params);
} // end include_memory()

function use_memory($strid){
	return use_resource($strid)
} // end use_memory()