//----------------------------------------------------------------
// file: cmemory.drv.js
// desc: defines the memory driver object
//----------------------------------------------------------------

//----------------------------------------------------------------
// class: CMemoryDriver
// desc: defines the memory driver object
//----------------------------------------------------------------
var CMemoryDriver = new Class({
	Extends : CResource,
	////////////////////////////
	// driver instance methods
	initialize: function() { this.parent(); },
	open: function(strpath, params) { return this.parent(strpath, params); },
	close: function() { /*return parent :: close();*/ }, 
	create: function(cvar) { return null; }, 
	retrieve: function(strname) { return null; },
	update: function(cvar) { return null; }, 
	delete: function(strname) { return null; },
	sync: function(cache) { return null; },
		
	/////////////////////////
	// class methods
	
	ClassMethods: {
		/////////////////////////
		// opening and closing
		_open: function(cmemory) {
			if(!cmemory)
				return null;
			// set up the driver params
			var params = cmemory.param("cmemorydriver_params"); 
			var strtype = params["cmemorydriver_type"];
			var strpath = params["cmemorydriver_path"];
			var strid = params["cmemorydriver_id"]; 	
			return include_memory_driver(strid, strpath, strtype, params) ? 
					use_memory_driver(strid) : null;
		}, // end _open()

		_close: function(cmemory) {
			var cmemorydriver = CMemoryDriver._open(cmemory);
			return cmemorydriver.close();
		}, // end _close()
		
		//////////////////////
		// CRUD
		_create: function (cmemory, cvar) {
			if(!cmemory || !cvar)
				return _return_done([false]);
			var cmemorydriver = CMemoryDriver._open(cmemory);
			if(!cmemorydriver)
				return _return_done([false]);
			var _driver_return = cmemorydriver.create(cvar);
			if(!_driver_return)
				return _return_done([false]);		
			var _return = _return_busy();
			if(!_return)
				return _return_done([false]);
			var strname = cvar["m_strname"]; 			
			cmemory.m_cache[strname] = cvar;
			_if(function(){return _driver_return.isdone();}, function() {
				var params = _driver_return.results();
				if(!params[0])
					_return.done([false]);
				else {
					cmemory.m_cache[strname] = params[0];
					_return.done([true]);
				} // end else
				this._return();
			})._elseif(function(){ return _driver_return.iserror(); }, function() {
				_return.done([false]);
				this._return();
			})._endif();
			return _return;		
		}, // end _create()

		_retrieve: function (cmemory, strname) {
			if(!cmemory || !strname)
				return _return_done([false]);
			var cmemorydriver = CMemoryDriver._open(cmemory);
			if(!cmemorydriver)
				return _return_done([false]);		
			var _return = _return_busy();
			if(!_return)
				return _return_done([false]);
			var _driver_return = cmemorydriver.retrieve(strname);
			if(!_driver_return)
				return _return_done([false]);
			_if(function(){ return _driver_return.isdone() }, function(){
				var params = _driver_return.results();
				if(!params[0])
					_return.done([false]);
				else { 
					cmemory.m_cache[strname] = params[0];
					_return.done([true]);
				} // end else
				this._return();
			})._elseif(function(){ return _driver_return.iserror(); }, function() {
				_return.done([false]);
				this._return();
			})._endif();
			return _return;
		}, // end _retrieve()

		_update: function (cmemory, cvar) {
			if(!cmemory || !cvar)
				return _return_done([false]);
			var cmemorydriver = CMemoryDriver._open(cmemory);
			if(!cmemorydriver)
				return _return_done([false]);
			var _driver_return = cmemorydriver.update(cvar);
			if(!_driver_return)
				return _return_done([false]);
			var strname = cvar["m_strname"]; 
			cmemory.m_cache[strname] = cvar;
			var _return = _return_busy();
			if(!_return)
				return _return_done([false]);
			_if(function(){ return _driver_return.isdone() }, function(){
				var params = _driver_return.results();
				if(!params[0])
					_return.done([false]);
				else {
					 cmemory.m_cache[strname] = params[0];
					_return.done([true]);
				} // end else
				this._return();
			})._elseif(function(){ return _driver_return.iserror(); }, function() {
				_return.done([false]);
				this._return();
			})._endif();
			return _return;
		}, // end _update()

		_delete: function (cmemory, strname) {
			if(!cmemory || !strname)
				return _return_done([false]);
			var cmemorydriver = CMemoryDriver._open(cmemory);
			if(!cmemorydriver)
				return _return_done([false]);
			var _driver_return = cmemorydriver.delete(strname);
			if(!_driver_return)
				return _return_done([false]);
			delete cmemory.m_cache[strname];
			var _return = _return_busy();
			_if(function(){ return _driver_return.isdone() }, function(){
				_return.done([true]);
				this._return();
			})._elseif(function(){ return _driver_return.iserror(); }, function() {
				_return.done([false]);
				this._return();
			})._endif();	
			return _return;
		}, // end _delete()

		/////////////////////////
		// syncing
		_sync: function (cmemory) {	
			if(!cmemory)
				return _return_done([false]);
			var cmemorydriver = CMemoryDriver._open(cmemory);
			if(!cmemorydriver)
				return _return_done([false]);
			var _driver_return = cmemorydriver.sync(cmemory.m_cache);
			if(!_driver_return) {
				return _return_done([false]);
			}
			var _return = _return_busy();
			if(!_return)
				return _return_done([false]);
			_if(function(){return _driver_return.isdone();}, function(){
				var params = _driver_return.results(); 
				if(!params[0])
					_return.done([false]);
				else{
					 cmemory.m_cache = params[0];
					_return.done([true]);
				} // end else
				this._return();
			})._elseif(function(){ return _driver_return.iserror(); }, function() {
				_return.done([false]);
				alert("sync false4");
				this._return();
			})._endif();
			return _return;
		} // end _sync()
	} // end ClassMethods
}); // end CMemoryDriver()

/////////////////////////
// includes and using 
function include_memory_driver(strid, strpath, strtype, params) {
	params = params || {};
	params["cresource_type"] = strtype;
	return include_resource(strid, strpath, params);
} // end include_memory_driver()

function use_memory_driver(strid){
	return use_resource(strid);
} // end use_memory_driver()