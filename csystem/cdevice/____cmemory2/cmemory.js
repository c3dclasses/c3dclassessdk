//----------------------------------------------------------------
// file: cmemory.js
// desc: defines a memory object
//----------------------------------------------------------------

//----------------------------------------------------------------
// class: CMemory
// desc: defines a memory object
//----------------------------------------------------------------
var CMemory = new Class({
	// constructor
	intialize : function(){ 
		// members
		this.m_strid = "";	// stores the id of the memory location
		this.m_cache = null; // stores the variables format: {name:{m_strname:name, m_value:value, m_strtype:type}}
		this.m_syncInterval = -1;
	}, // end CMemory() 
	
	// opening / closing
	open : function(strmemid, params){
		// check the id of memory location
		if(!strmemid)
			return null;
		
		// check if the cvars was set locally in params
		if(params) {
			this.m_strid = strmemid;
			this.m_cache = params;
			return this.m_cache;
		} // end if
		
		// remotely open / sync the cvars
		this.m_strid = strmemid;
		var creturn = this.sync();
		return creturn;	
	}, // end open()
	
	close : function(){
		this.m_strid = "";
		this.m_cache = null;
		return true; 
	}, // end close()
	
	// create / retrieve / update / delete (CRUD)
	create : function(strname, value, strtype){ 	
		// check if the memory was not opened
		if(!this.m_vars) {	
			return false;
		} // end if
		
		// check if the variable's already created
		if(this.m_cache && this.m_cache[strname]) { 
			return false;
		} // end if
		
		// create and store the cvar locally
		var cvar = {"m_strname":strname, "m_value":value, "m_strtype":strtype};
		this.m_cache[strname] = cvar;
		
		// create and store the cvar remotely
		CEvent.fire("oncmemory", {
				"memid":this.m_strid, 
				"memcommand":"create", 
				"varname":strname, 
				"varvalue":value, 
				"vartype":strtype
		}); // end fire
	
		return cvar; 
	}, // end create()
	
	retrieve : function(strname){ 
		// check if memory was not opened or cvar was not created
		if(!this.m_cache || !this.m_cache[strname]) {	
			return null;
		} // end if
		
		return this.m_cache[strname];
	}, // end retrieve()
	
	update : function(strname, value, strtype){ 
		// check if memory was not opened or cvar was not created
		if(!this.m_cache || !this.m_cache[strname]) {	
			return null;
		} // end if
		
		// update the cvar locally
		var cvar = this.m_cache[strname];
		if(strtype) cvar.m_strtype = strtype;
		if(value) cvar.m_value = value;
		
		// update the cvar remotely
		var creturn = CEvent.fire( "oncmemory", { 
			"memid":this.m_strid, 
			"memcommand":"update", 
			"varname":strname, 
			"varvalue":value, 
			"vartype":strtype 
		}); // end fire
		
		return cvar;
	}, // end update()
	
	delete : function(strname){
		// memory was not opened or cvar was not created
		if(!this.m_cache || !this.m_cache[strname]) {	
			return null;
		} // end if
		
		// delete the cvar locally
		var cvar = this.m_cache[strname];	
		delete this.m_cache[strname];
		
		// delete the cvar remotely
		var creturn = CEvent.fire( "oncmemory", {
			 "memid":this.m_strid, 
			 "memcommand":"delete", 
			 "varname":strname 
		}); // end fire 
		
		return cvar;
	}, // end delete()
	
	sync : function() {		
		// remotely open and retrieve the cvars
		var creturn = CEvent.fire( "oncmemory", { memid:this.m_strid, memcommand:"open" } );
		if( !creturn )
			return null;
		var _this = this;
		_if( function(){ return creturn.isdone(); }, function(){
			var params = creturn.data();
			if( params == null && params[0] == null )
				_this.m_cache = null;
			_this.m_cache = jQuery.parseJSON(params[0].m_jsondata);
			this._return();
		})._elseif( function(){ return creturn.iserror(); }, function(){
			_this.m_cache = null;
			this._return();
		})._elseif( function(){ return creturn.isbusy(); }, function(){
			// busy
		})._endif(); 
		return creturn;		
	}, // end sync() 
	
	syncInterval : function(interval){
		if(!interval || interval < 1)
			return;
		var self = this;
		clearTimeout(this.m_syncInterval);
		this.m_syncInterval = setInterval(function(){
			self.sync();
		}, interval);
	}, // end syncInterval()
	
	cache : function(){
		return this.m_cache; 
	}, // end data()
	
	// other
	_toString : function(){ 
		return print_r(this.m_cache, true); 
	}, // end toString() 
		
	ClassMethods:{
		m_cmemory : null,	// stores all of the cmemory objects
		use : function(strmemid, params){
			if(strmemid == "" || strmemid == null)
				return null;
			if(!CMemory.m_cmemory)
				CMemory.m_cmemory = [];
			if(CMemory.m_cmemory[strmemid])
				return CMemory.m_cmemory[strmemid];
			var cmemory=null;
			if(!(cmemory = new CMemory()) || !cmemory.open(strmemid, params))
				return null;
			CMemory.m_cmemory[strmemid] = cmemory;
			return cmemory;
		} // end use
	} // end classmethods
}); // end CMemory()

function use_memory(strid, params){
	return CMemory.use(strid, params);
} // end use_memory()