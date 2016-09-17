<?php
//----------------------------------------------------------------
// file: cremotememory.drv.js
// desc: defines the remote memory driver object
//----------------------------------------------------------------

// includes
include_js(relname(__FILE__) . "/cremotememory.drv.js");

//----------------------------------------------------------------
// class: CRemoteMemoryDriver
// desc: defines the remote memory driver object
//----------------------------------------------------------------
class CRemoteMemoryDriver extends CMemoryDriver{
	public function create($cvar) {
		return CEvent :: fire("oncremotememorydriver", array(
			"memtype"=>$this->drivertype(),
			"mempath"=>$this->path(),
			"memid"=>$this->id(), 
			"memcommand"=>"create", 
			"memvar"=>$cvar
		), $this->uri()); // end fire
	} // end create() 
	
	public function retrieve($strname) { 
		return CEvent :: fire("oncremotememorydriver", array(
			"memtype"=>$this->drivertype(),
			"mempath"=>$this->path(),
			"memid"=>$this->id(), 
			"memcommand"=>"retrieve", 
			"memvarname"=>$strname
		), $this->uri()); // end fire()
	} // end retrieve()
	
	public function update($cvar) { 
		return CEvent :: fire("oncremotememorydriver", array(
			"memtype"=>$this->type(),
			"mempath"=>$this->path(),
			"memid"=>$this->id(), 
			"memcommand"=>"update", 
			"memvar"=>$cvar
		), $this->uri()); // end fire()
	} // end update() 
	
	public function delete($strname) { 
		return CEvent.fire( "oncremotememorydriver", array(
			"memtype"=>$this->drivertype(),
			"mempath"=>$this->path(),
			"memid"=>$this->id(), 
			"memcommand"=>"delete", 
			"memvarname"=>$strname 
		), $this->uri()); // end fire() 
	} // end delete()
	
	public function sync($cache) { 
		return CEvent::fire( "oncremotememorydriver", array(
			"memtype"=>$this->drivertype(),
			"mempath"=> $this->path(),
			"memid"=>$this->id(), 
			"memcommand"=>"sync", 
			"memcache"=>($cache) ? json_encode($cache) : NULL
		), $this->uri()); // end fire()
	}	// end sync()
	
	public function drivertype() {
		return $this->param("cremotememorydriver_type");
	} // end drivertype()
	
	public function uri() {
		return $this->param("cremotememorydriver_uri");
	} // end uri()
	
	public function id() {
		return $this->param("cremotememorydriver_id");		
	} // end id()
} // end CRemoteMemoryDriver

//------------------------------------------------------------
// name: oncremotememorydriver_handler()
// desc: sets up the event handler to process remote memory
//------------------------------------------------------------
include_event("oncremotememorydriver", "oncremotememorydriver_handler"); 
function oncremotememorydriver_handler($params) {
	// check params
	if(!$params||
	   //!isset($params["memid"]) ||
	   !isset($params["memtype"]) ||
	   !isset($params["mempath"]) ||
	   !isset($params["memcommand"])) {
		return _return_done(NULL);
	} // end if
	
	// get the parameters
	$strid = isset($params["memid"]) ? $params["memid"] : "tmpid";
	$strtype = $params["memtype"];
	$strpath = $params["mempath"];
	$strcommand = $params["memcommand"];
	
	// get the memory driver
	if(!include_memory_driver($strid, $strpath, $strtype) || !$cmemorydriver = use_memory_driver($strid)) {
		return _return_done(NULL);
	} // end if
	
	if($strcommand == "sync") {
		$cache = isset($params["memcache"]) ? $params["memcache"] : NULL;	
		$_return = $cmemorydriver->sync(json_decode($cache));
	} // end if
	
	else if($strcommand == "create") {
		$cvar = isset($params["memvar"]) ? $params["memvar"] : NULL;
		$_return = $cmemorydriver->create($cvar);
	} // end if
	
	else if($strcommand == "retrieve") {
		$strname = $params["memvarname"];
		$_return = $cmemorydriver->retrieve($strname);
	} // end if
	
	else if($strcommand == "update") {
		$cvar = isset($params["memvar"]) ? $params["memvar"] : NULL;
		$_return = $cmemorydriver->update($cvar);
	} // end if

	else if($strcommand == "delete") {
		$strname = $params["memvarname"];
		$_return = $cmemorydriver->delete($strname);
	} // end if
	
	//if($_return) {
		//$data = $_return->data();
		//return $data[0];	
	//} // end if
	return ($_return) ? $_return->data() : NULL;	
} // end oncremotememorydriver_handler()
?>