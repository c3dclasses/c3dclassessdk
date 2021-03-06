<?php
//----------------------------------------------------------------
// file: cjsonmemorydriver.php
// desc: defines a json memory object 
//----------------------------------------------------------------

// includes
include_once("cmemory.drv.php");

//----------------------------------------------------------------
// file: CJSONMemoryDriver
// desc: defines a json memory object 
//----------------------------------------------------------------
class CJSONMemoryDriver extends CMemoryDriver {	
	// members
	protected $m_json;
	
	public function CJSONMemoryDriver(){ 
		parent :: CMemoryDriver(); 
		$this->m_json = NULL; 
	} // end CJSONMemoryDriver()
	
	public function open($strpath, $params=NULL) {
		if((file_exists($strpath)) == FALSE ||
			($strcontents = file_get_contents($strpath)) == "" ||
			($json = json_decode($strcontents, true)) == NULL)
			$json = NULL;
		if(parent :: open($strpath, $params) == false)
			return false;	
		$this->m_json = $json;
		return true;	
	} // end open()
	
	public function close(){ 
		$this->save(); 
	} // end close()
	
	public function create($cvar) { 
		if(!$cvar) // no var
			return _return_done(NULL);
		$strname = $cvar['m_strname'];
		$value = $cvar['m_value'];	
		if(isset($this->m_json[$strname])) // already created no need to create
		 	return _return_done($this->m_json[$strname]);
		$this->m_json[$strname]['m_strname'] = $strname;
		$this->m_json[$strname]['m_value'] = (gettype($value) == "object") ? serialize($value) : $value;
		$this->m_json[$strname]['m_icreated'] = time(); // set the timestamp
		$this->m_json[$strname]['m_iupdated'] = "";
		$this->m_json[$strname]['m_iretrieved'] = "";
		return $this->save() ? _return_done($this->m_json[$strname]) : NULL;
	} // end create()
	
	public function retrieve($strname){ 
		return ($this->restore() == FALSE || $this->m_json == NULL || 
			isset($this->m_json[$strname]) == FALSE || ($cvar = $this->m_json[$strname]) == NULL || !($cvar["m_iretrieved"]=time())) 
			? _return_done(NULL) : _return_done($cvar); 
	} // end retrieve()
	
	public function update($cvar){ 
		if(!$cvar)
			return _return_done(NULL);
		$strname = $cvar['m_strname'];
		$value = $cvar['m_value'];	
		if($this->m_json == NULL || isset($this->m_json[$strname]) == FALSE) // was not created
			return _return_done(NULL);
		$this->m_json[$strname]['m_value'] = (gettype($value) == "object") ? serialize($value) : $value;
		$this->m_json[$strname]['m_iupdated'] = time();	// set the timestamp
		return $this->save() ? _return_done($this->m_json[$strname]) : NULL;
	} // end update()
	
	public function delete($strname){ 
		if($this->m_json == NULL || isset($this->m_json[$strname]) == FALSE)
			return _return_done(NULL);
		$this->m_json[$strname] = NULL;
		unset($this->m_json[$strname]);
		$this->save(); // update the file
		return _return_done(NULL);
	} // end delete()
	
	public function sync($cache) {
		// update the main cache	
		if($cache) {
			foreach($cache as $strname => $value) {
				if($this->m_json[$strname])
					$this->m_json[$strname] = $value;
			} // end foreach
			$this->save();
		} // end if				
		return _return_done($this->m_json);
	} // end sync()
	
	public function save(){
		if(($infile = fopen($this->path(), "w")) == NULL)
			return false;
		if(fwrite($infile, ($this->m_json) ? json_encode($this->m_json) : "") == FALSE){} 
		fclose($infile);
		return true;		
	} // end save()
} // end CJSONMemoryDriver
?>