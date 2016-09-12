<?php 
//----------------------------------------------------------------
// file: carraymemory.drv.php
// desc: defines a array memory driver object 
//----------------------------------------------------------------

// includes
include_once("cmemory.drv.php");

//----------------------------------------------------------------
// file: CArrayMemoryDriver
// desc: defines a array memory object 
//----------------------------------------------------------------
class CArrayMemoryDriver extends CMemoryDriver {	
	protected $m_array;
	
	public function CArrayMemoryDriver(){ 
		parent :: CMemory(); 
		$this->m_array = NULL; 
	} // end CArrayMemoryDriver()
	
	public function open($strpath, $params=NULL){
		if(!isset($params["carraymemorydriver_array"]) ||
			parent :: open($strpath, $params) == false)
			return false;
		$this->m_array = &$params["carraymemorydriver_array"];
		return true;	
	} // end open()
	
	public function close(){
		$this->m_array = NULL; 
	} // end close()
	
	public function create($cvar) {
		if(!$cvar) // no var
			return _return_done(array(NULL));
		$strname = $cvar['m_strname'];
		$value = $cvar['m_value'];	
		$bcreated=false;
		if(isset($this->m_array[$strname])) { // its already set
			$bcreated = true;
			$value = $this->m_array[$strname];
		} // end if
		else $this->m_array[$strname] = $value;
		$outcvar['m_strname'] = $strname;
		$outcvar['m_value'] = (gettype($value) == "object") ? serialize($value) : $value;
		$outcvar['m_strtype'] = gettype($value);
		$outcvar['m_icreated'] = ($bcreated) ? "" : time(); // set the timestamp
		$outcvar['m_iupdated'] = "";
		$outcvar['m_iretrieved'] = "";
		return _return_done(array($outcvar));
	} // end create()
	
	public function retrieve($strname){ 
		if($this->restore() == FALSE || 
			$this->m_array == NULL || 
			isset($this->m_array[$strname]) == FALSE || 
			($value = $this->m_array[ $strname ]) == NULL)
			_return_done(array(NULL));
		$outcvar['m_value'] = (gettype($value) == "object") ? unserialize($value) : $value;
		$outcvar['m_strtype'] = gettype($value);
		$outcvar['m_icreated'] = ""; // set the timestamp
		$outcvar['m_iupdated'] = "";
		$outcvar['m_iretrieved'] = time();
		return _return_done(array($outcvar)); 
	} // end retrieve()
		
	public function update($cvar){ 
		if(!$cvar)
			return _return_done(array(NULL));
		$strname = $cvar['m_strname'];
		$value = $cvar['m_value'];	
		if($this->m_array == NULL || isset($this->m_array[$strname]) == FALSE)
			return _return_done(array(NULL));
		$this->m_array[$strname]=$value;
		$outcvar['m_strname'] = $strname;
		$outcvar['m_value'] = (gettype($value) == "object") ? serialize($value) : $value;
		$outcvar['m_strtype'] = gettype($value);
		$outcvar['m_icreated'] = ""; // set the timestamp
		$outcvar['m_iupdated'] = time();
		$outcvar['m_iretrieved'] = "";
		return _return_done(array($outcvar));
	} // end update()
	
	public function delete($strname){ 
		if($this->m_array == NULL ||isset($this->m_array[$strname]) == FALSE)
			return _return_done(array(NULL));
		$this->m_array[$strname] = NULL;
		unset($this->m_array[$strname]);
		return _return_done(array(NULL));
	} // end delete()
	
	public function sync($cache) {
		// update the main cache	
		if($cache) {
			foreach($cache as $strname => $value) {
				if($this->m_array[$strname])
					$this->m_array[$strname] = $value;
			} // end foreach
		} // end if
		if(!$this->m_array)
			return _return_done(array(NULL));
		$outcache = NULL;
		foreach($this->m_array as $strname => $value) {
			$cvar = NULL;
			$cvar['m_strname'] = $strname;
			$cvar['m_value'] = (gettype($value) == "object") ? unserialize($value) : $value;
			$cvar['m_strtype'] = gettype($value);
			$cvar['m_icreated'] = ""; // set the timestamp
			$cvar['m_iupdated'] = "";
			$cvar['m_iretrieved'] = "";
			$outcache[$strname]=$cvar;
		} // end for
		return _return_done(array($outcache));
	} // end sync()
} // end CArrayMemoryDriver
?>