<?php
//----------------------------------------------------------------
// file: cmemory.js
// desc: defines the memory object
//----------------------------------------------------------------

// includes
include_js(relname(__FILE__) . "/cmemory2.js");

//----------------------------------------------------------------
// class: CMemory2
// desc: defines the memory object
//----------------------------------------------------------------
class CMemory2 extends CResource { // inherits the CResource
	public $m_cache;
	public function CMemory2(){
		parent :: CResource();
		$this->m_cache = NULL; 	
	} // end CMemory2()

	//////////////////////
	// opening / closing
	public function open($strpath, $params=NULL){
		if(!parent :: open($strpath, $params) || CMemoryDriver :: _open($this) == NULL)
			return false;
		$this->m_cache = isset($params["cmemory_cache"]) ? $params["cmemory_cache"] : NULL; // preload the cache
		return true;	
	} // end open()

	public function close(){
		$this->m_cache = NULL;
		return CMemoryDriver :: _close($this);
	} // end close()

	//////////////////////////
	// async CRUD operations
	public function create ($strname, $value, $strtype, $params=NULL) {
		return CMemoryDriver :: _create($this,array(
			"m_strname"=>$strname, 
			"m_value"=>$value, 
			"m_strtype"=>$strtype, 
			"m_params"=>$params 
		)); // end CMemoryDriver.create()	
	} // end create()

    	public function retrieve ($strname) {
		return CMemoryDriver :: _retrieve($this, $strname);
	} // end retrieve()

	public function update ($strname, $value, $strtype, $params=NULL) {
		return CMemoryDriver :: _update($this,array(
			"m_strname"=>$strname, 
			"m_value"=>$value, 
			"m_strtype"=>$strtype, 
			"m_params"=>$params 
		)); // end CMemoryDriver.update()
	} // end update()

	public function delete ($strname) {
		return CMemoryDriver :: _delete($this, $strname);
	} // end delete()

	/////////////////////////
	// syncing
	public function sync () {
		return CMemoryDriver :: _sync($this); // sync local and remote memory
	} // end sync()

	////////////////////////
	// other
	public function cache() {
		return $this->m_cache;
	} // end data()

	public function _toString(){
		return print_r($this->m_cache, true);
	} // end toString()
	
	/////////////////////////
	// set / get
	public function set($strname, $value) {
		if(!$this->m_cache || !$this->m_cache[$strname])
			return;
		$cvar = $this->m_cache[$strname];
		$cvar["m_value"]= $value;
		CMemoryDriver :: _update($this, $cvar);
		return;
	} // end set()
	
	public function get($strname) {
		return ($this->m_cache) ? $this->m_cache[$strname] : NULL;
	} // end get()
} // end CMemory2()

/////////////////////////
// includes and using
function include_memory2($strid, $strpath, $strtype, $params=NULL){
	// setup the driver params
	$params["cresource_type"] = "CMemory2";
	$params["cmemorydriver_id"] = $strtype . "::" . $strid;
	$params["cmemorydriver_path"] = $strpath;
	$params["cmemorydriver_type"] = $strtype;
	return include_resource($strid, "CMemory2::" . $strid, $params);
} // end include_memory2()

function include_remote_memory2($strid, $strpath, $strtype, $struri="", $params=NULL){
	// setup the driver params
	$params["cremotememorydriver_type"] = $strtype;
	$params["cremotememorydriver_uri"] = $struri; 	
	return include_memory2($strid, $strpath, "CRemoteMemoryDriver", $params);
} // end include_remote_memory2()

function use_memory2($strid){
	return use_resource($strid);
} // end use_memory2()

///////////////////////////////
// importing / exporting
function export_cmemory($id, $cresource) {
	if( !$cresource || !($p=$cresource->getParams()) || 
		$p->get("cresource_type") != "CMemory2")
		return "";
	$cresource->sync(); 

	$params = $p->_();
	$params["cmemory_cache"] = $cresource->cache();
	$id = json_encode($id);
	$params = json_encode($params);
	return "\n" . "import_cmemory($id, $params);" . "\n";	
} // end export_cmemory()
function export_cmemory_script(){ 
	return CResource :: toStringVisit("export_cmemory"); 
} // end export_cmemory_script() 
CHook :: add("script", "export_cmemory_script");
?>