<?php
//----------------------------------------------------------------
// file: cmemory.php
// desc: the base class that generically defines a memory object 
//----------------------------------------------------------------

// includes
include_js( relname(__FILE__) . "/cmemory.js");

//----------------------------------------------------------------
// file: CMemory
// desc: the base class that generically defines a memory object 
//----------------------------------------------------------------
class CMemory extends CResource{	
	public function CMemory(){ 
	} // end CMemory() 
	public function open( $strpath, $params=NULL ){
		$params["cmemory"]=true;
		return parent :: open( $strpath, $params );	
	} // end open()
	public function close(){ 
		return true; 
	} // end close()
	public function create( $strname, $value, $strtype ){ 
		return NULL; 
	} // end create()
	public function retrieve( $strname ){ 
		return NULL; 
	} // end retrieve()
	public function update( $strname, $value, $strtype ){ 
		return NULL; 
	} // end update()
	public function delete( $strname ){ 
		return FALSE; 
	} // end delete()
	public function error(){ 
		return "ERROR";
	} // end error()
	public function save(){ 
		return FALSE; 
	} // end save()
	public function batch($crudop, $params){
		$ret=NULL;
		foreach( $params as $index => $var ){
			$strname = $var["name"];
			$strtype = $var["type"];
			$value = $var["value"];
			$ret[] = $this->{$crudop}($strname,$value,$strtype);
		} // end foreach()
		return $ret;
	} // end batch()
	public function serialize( $value ){ 
		return serialize($value); 
	} // end serialize()
	public function unserialize( $value, $type ){ 
		return unserialize($value); 
	} // end unserialize()  
} // end CMemory

function include_memory( $strid, $strpath, $strtype, $params=NULL ){
	$params["cresource_type"] = $strtype;
	return include_resource( $strid, $strpath, $params );
} // end include_memory()

function use_memory( $strid ){
	return use_resource( $strid );
} // end use_memory()

include_once("cdatabasememory.php");
include_once("cjsonmemory.php");
include_once("carraymemory.php");
include_once("ctablememory.php");

?>