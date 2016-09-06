//----------------------------------------------------------------
// file: cremotememory.drv.js
// desc: defines the remote memory driver object
//----------------------------------------------------------------

//----------------------------------------------------------------
// class: CRemoteMemoryDriver
// desc: defines the remote memory driver object
//----------------------------------------------------------------
var CRemoteMemoryDriver = new Class({
	Extends: CMemoryDriver,
	
	create: function(cvar) {
		return CEvent.fire("oncremotememorydriver", {
			"memtype":this.drivertype(),
			"mempath":this.path(),
			"memid":this.id(), 
			"memcommand":"create", 
			"memvar":cvar
		}, this.uri()); // end fire 
	}, // end create() 
	
	retrieve: function(strname) { 
		return CEvent.fire("oncremotememorydriver", {
			"memtype":this.drivertype(),
			"mempath":this.path(),
			"memid":this.id(), 
			"memcommand":"retrieve", 
			"memvarname":strname 
		}, this.uri()); // end fire() 
	}, // end retrieve()
	
	update: function(cvar) { 
		return CEvent.fire("oncremotememorydriver", {
			"memtype":this.drivertype(),
			"mempath":this.path(),
			"memid":this.id(), 
			"memcommand":"update", 
			"memvar":cvar
		}, this.uri()); // end fire()
	}, // end update() 
	
	delete: function(strname) { 
		return CEvent.fire("oncremotememorydriver", {
			"memtype":this.drivertype(),
			"mempath":this.path(),
			"memid":this.id(), 
			"memcommand":"delete", 
			"memvarname":strname 
		}, this.uri()); // end fire() 
	}, // end delete()
	
	sync: function(cache) {	
		return CEvent.fire("oncremotememorydriver", {
			"memtype":this.drivertype(),
			"mempath":this.path(),
			"memid":this.id(), 
			"memcommand":"sync", 
			"memcache":(cache)?JSON.stringify(cache):"{}"
		}, this.uri()); // end fire()
	},	// end sync()
	
	drivertype : function() {
		return this.param("cremotememorydriver_type");
	}, // end drivertype()
	
	uri : function() {
		return this.param("cremotememorydriver_uri");
	}, // end uri()
	
	id : function() {
		return this.param("cremotememorydriver_id");		
	} // end id()
}); // end CRemoteMemoryDriver