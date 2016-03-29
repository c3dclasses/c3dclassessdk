<?php
//----------------------------------------------------------------
// file: ctablememory.php
// desc: defines a table memory object 
//----------------------------------------------------------------

//----------------------------------------------------------------
// class: CTableMemory
// desc: defines a table memory object 
//----------------------------------------------------------------
class CTableMemory extends CMemory{
	protected $m_ctable; // table object
	
	public function CTableMemory(){ 
		parent::CMemory(); 
		$this->m_ctable = NULL;
		$this->m_strprimarykey = "";
		$this->m_data = NULL;
	} // end CTableMemory()
	
	public function open( $strpath="", $params=NULL ){
		
		//alert("open CTableMemory");
		//alert("PK: " . $strprimarykey );
		
		$pathpattern = '/(?P<host>\w+)\/(?P<database>\w+)\/(?P<table>\w+)/';
		$bmatch = preg_match($pathpattern, $strpath, $matches);
		
		if( $bmatch == FALSE || $bmatch == 0 || $params == NULL || 
			isset( $params["primarykey"] ) == false ||
			isset( $params["username"] ) == false || 
			isset( $params["password"] ) == false )
			return false;
			
		$strprimarykey = $params["primarykey"];
		
		if( !include_table($strpath, $strpath, array("username"=>"root", "password"=>"", 
			"primarykey"=>"${strprimarykey}")) || !($ctable = use_table($strpath)) )
			 return false;
		
		if( parent::open($strpath, $params) == FALSE){
			$this->close();
			return false;
		} // end if
		
		$this->m_ctable = $ctable;
		$this->m_strprimarykey = $strprimarykey;
		return true;	
	} // end open()
	
	public function getCTable() {
		return $this->m_ctable;
	} // end getCTable()
	
	public function getPrimaryKey() {
		return $this->m_strprimarykey;
	} // end getPrimaryKey()
	
	public function isOpen() {
		return ($this->m_ctable && $this->m_strprimarykey != "");
	} // end isOpen()
	
	public function close(){ 
		if($this->m_ctable)
			$this->m_ctable->close();
		$this->m_ctable = NULL;
		$this->m_strprimarykey="";
		$this->m_data = NULL;
	} // end close()
	
	public function create($strname, $value, $strtype){ 
		if(!$this->isOpen())
			return NULL;
		if(!$this->m_ctable->update($this->m_strprimarykey, $strname, $value, $strtype))
			return NULL;
		$this->m_data[$strname] = array('m_strname'=>$strname, 'm_value'=>$value, 'm_strtype'=>$strtype); 
		return $this->m_data[$strname];
	} // end create()
		
	public function retrieve($strname){
		if(!$this->isOpen())
			return NULL;
		if(!($row=$this->m_ctable->retrieve($this->m_strprimarykey, $strname)))
			return NULL;
		alert("GOT Data");
		$structure = $this->m_ctable->getStructure();
		$strtype = $structure[$strname]["Type"];
		$this->m_data[$strname] = array('m_strname'=>$strname, 'm_value'=>$row[$strname], 'm_strtype'=>$strtype);		
		return $this->m_data[$strname];
	} // end retrieve()
	
	public function update($strname, $value, $strtype) {
		return $this->create($strname, $value, $strtype);
	} // end update()
	
	public function delete($strname="") {
		if(!$this->isOpen())
			return false;
		if($strname=="")
			$this->m_ctable->delete();
		if(isset($this->m_data[$strname]))
			unset($this->m_data[$strname]);
		return $this->m_ctable->delete($this->m_strprimarykey, $strname);
	} // end delete()
	
	// misc. methods
	public function error(){ 
		return $this->m_ctable->error();
	} // end error()
	 
	public function toString(){ 
		return print_r($this->m_data,true);
	} // end toString()
	
	public function toStringStructure() {
		return ($this->isOpen()) ? print_r($this->getCTable()->getStructure(),true) : "";
	} // toStringStructure()
	
	public function toJSON(){ 
		return json_encode($this->m_data); 
	} // end toString()
} // end CTableMemory

function include_table_memory($strid, $strpath, $params) {
	return include_memory( $strid, $strpath, "CTableMemory", $params );
}// end include_table_memory()

function use_table_memory($strid) {
	return use_resource($strid);
} // end use_table_memory()
?>