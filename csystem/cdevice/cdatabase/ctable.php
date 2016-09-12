 <?php
//----------------------------------------------------------------
// file: ctable.php
// desc: defines a database table object 
//----------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// class: CTable
// desc: defines a table as a resource object for CRUD operations
//--------------------------------------------------------------------------------------------------
class CTable extends CResource{
	protected $m_structure;
	protected $m_cdatabase;
	protected $m_strname;
	protected $m_strpkfield;
	protected $m_strpktype;
	
	public function CTable(){ 
		parent::CResource(); 
		$this->destroy();
	} // end CTable()

	////////////////////////////////////
	// open() / close() / destroy()
	public function open($strpath="", $params=NULL){
		if(!$strpath)
			return false;
		// get the pattern matches
		$pathpattern = '/(?P<host>\w+)\/(?P<database>\w+)\/(?P<table>\w+)/';
		$bmatch = preg_match($pathpattern, $strpath, $matches);
		if($bmatch == FALSE || $bmatch == 0) 
			return false;
		// get the database and table setup parameters
		$strhost = $matches["host"];
		$strdatabase = $matches["database"];
		$strtable = $matches["table"];
		$strpkfield = isset($params["pk_field"]) ? $params["pk_field"] : "";
		$strpktype = isset($params["pk_type"]) ? $params["pk_type"] : "";
		// include/use the database resource
		if(!include_database("$strhost/$strdatabase", "$strhost/$strdatabase", $params) ||
		   !($cdatabase = use_database("$strhost/$strdatabase")))
				return false;
		// set the table private data
		$this->m_cdatabase = $cdatabase;
		$this->m_strname = $strtable;
		$this->m_strpkfield = $strpkfield;
		$this->m_strpktype = $strpktype;
		// initialize the table structure
		if(!$this->createTableStructure()) {
			$this->destroy();
			return false;
		} // end if
		return parent::open($strpath, $params);		
	} // end open()
	
	protected function close() {
	} // end close()
	
	protected function destroy() {
		$this->close();
		$this->m_structure = NULL;
		$this->m_cdatabase = NULL;
		$this->m_strname = "";
		$this->m_strpkfield = "";
		$this->m_strpktype = "";
	} // end destroy()
	
	/////////////////////////
	// CRUD
	public function create($strprimarykeyvalue, $strcolname="", $value="") {
		if(!$this->isOpen())
			return false;
		$columns = NULL;
		$values = NULL;
		$strtablename = $this->getName();
		$newvalue = $value;
		foreach($this->m_structure as $colname => $structure){
			$columns[] = $colname;
			if($structure["Key"] == "PRI")
				$value = $strprimarykeyvalue;			
			else if($colname != $strcolname) 
				$value = "NULL";
			else $value = "\"{$newvalue}\"";
			$values[]=$value;
		} // end foreach
		$columns = implode(",",$columns);
		$values = implode(",",$values);
		$sql = "INSERT INTO {$strtablename} ({$columns}) VALUES ({$values});";
		return $this->m_cdatabase->query($sql);
	} // end create()
	
	public function retrieve($strprimarykeyvalue) {
		if(!$this->isOpen())
			return NULL;
		$strprimarykeyfield = $this->getPrimaryKeyField();
		$strtablename = $this->getName();
		if($strprimarykeyfield == "" || $strtablename == "")
			return NULL;
		$sql = "SELECT * FROM {$strtablename} WHERE {$strprimarykeyfield} = '{$strprimarykeyvalue}'";
		return $this->query_row($sql);
	} // end retrieve()	
	
	public function delete($strprimarykeyvalue="", $strcolname="", $bdeletecolumn=false){
		if(!$this->isOpen())
			return false;		
		$strtablename = $this->getName();
		$strprimarykeyfield = $this->getPrimaryKeyField();
		if(func_num_args()==0) {
			$sql = "DROP TABLE {$strtablename}";
			return $this->m_cdatabase->query($sql) == FALSE ? false : true;
		} // end if
		if($strprimarykeyvalue && $strcolname==""){ // delete a row?
			$sql = "DELETE FROM {$strtablename} WHERE {$strprimarykeyfield} = '{$strprimarykeyvalue}'";
			return $this->m_cdatabase->query($sql) == FALSE ? false : true;
		} // end if
		if(!isset($this->m_structure[$strcolname])) // column exist?
			return false;		
		if($bdeletecolumn) {	// delete a column?
			$sql = "ALTER TABLE {$strtablename} DROP COLUMN {$strcolname}";
			return $this->m_cdatabase->query($sql) == FALSE ? false : true;
		} // end if
		return ($this->update($strprimarykeyvalue, $strcolname, NULL)==true); // nullify the column
	} // end delete()
		
	public function update($strprimarykeyvalue, $strcolname, $value, $strtype="") {
		if(!$this->isOpen())
			return false;
		$strtablename = $this->m_strname;			
		$strprimarykeyfield = $this->getPrimaryKeyField();
		$structure = $this->getStructure();
		if(isset($structure[$strcolname]) == false || !$structure[$strcolname]) { // add new column
			$sql = "ALTER TABLE {$strtablename} ADD {$strcolname} {$strtype}";
			if($this->m_cdatabase->query($sql) == FALSE || !$this->setStructure())
				return false;
			$structure = $this->getStructure();
		} // end if
		else if($strtype != "" && ($strtype != $structure[$strcolname]['Type'])) { // change column type
			$sql = "ALTER TABLE {$strtablename} MODIFY {$strcolname} {$strtype}";
			if($this->m_cdatabase->query($sql) == FALSE || !$this->setStructure())
				return false;
			$structure = $this->getStructure();		
		} // end else if
		if(!($row = $this->retrieve($strprimarykeyvalue))) { // create a new row
			return $this->create($strprimarykeyvalue, $strcolname, $value);
		} // end if
		else { // update row/column value
			if($value==NULL) 
				$value="NULL";
			$sql = "UPDATE {$strtablename} SET {$strcolname}='{$value}' WHERE {$strprimarykeyfield} = '{$strprimarykeyvalue}'";
			if($this->m_cdatabase->query($sql) == FALSE)
				return false;
		} // end else
		return true;
	} // end update()
	
	////////////////////////
	// get/set methods
	public function getName() {
		return $this->m_strname;
	} // end getName()
	
	public function getStructure() {
		return $this->m_structure;
	} // end getStructure()

	public function getPrimaryKeyField() {
		return $this->m_strpkfield;
	} // end getPrimaryKeyField()
	
	public function getPrimaryKeyType() {
		return $this->m_strpktype;
	} // end getPrimaryKeyType()

	public function getCDatabase() {
		return $this->m_cdatabase;
	} // end getCDatabase()

	////////////////////////
	// helper methods
	protected function isOpen() {
		return $this->m_structure && $this->m_cdatabase &&
		 $this->m_strname != "" && $this->m_strpkfield != "" &&
		 $this->m_cdatabase->select();
	} // end isOpen()
	
	protected function createTableStructure() {
		if(!$this->m_cdatabase || !$this->m_cdatabase->select()) {
			printbr($this->m_cdatabase->error());
			return false;
		}
		// get PK field and PK type
		$primary_key_field = $this->m_strpkfield; 
		$primary_key_type = $this->m_strpktype;
		$strtable = $this->m_strname;
		$cdatabase = $this->m_cdatabase;
		// if theres a structure then we're done
		if($this->setStructure())
		 	return true;
		// create the table structure using the PK field and type
		if($primary_key_field && $primary_key_type) {	
			$sql = "CREATE TABLE $strtable ($primary_key_field $primary_key_type NOT NULL,PRIMARY KEY ($primary_key_field));";
			$result = $cdatabase->query($sql);
			if($result == FALSE || !$this->setStructure())
				return false;
		} // end if
		// if no PK field and PK type, then use an auto increment int as a key
		else {
			$sql = "CREATE TABLE $strtable (id MEDIUMINT NOT NULL AUTO_INCREMENT, PRIMARY KEY (id));";
			if($cdatabase->query($sql) == FALSE || !$this->setStructure())
				return false;
		} // end else
		return true;
	} // end createTableStructure()
	
	protected function setStructure(){
		if(!$this->m_strname || !$this->m_cdatabase)
			return false;
		$strtable = $this->m_strname;
		$sql = "SHOW COLUMNS FROM {$strtable}";
		$result = $this->m_cdatabase->query($sql);	
		if ($result == FALSE || mysql_num_rows($result) <= 0)
			return false;
		$tableStructure = NULL;
		$primaryKeyField = "";
		$primaryKeyType = "";
    	while ($columns = mysql_fetch_assoc($result)) {
			if(!$tableStructure)
				$tableStructure=array();
			$tableStructure[$columns["Field"]]=array(
				"Field"=>$columns["Field"],
				"Key"=>$columns["Key"],
				"Type"=>$columns["Type"], 
				"Null" => $columns["Null"], 
				"Default"=>$columns["Default"],
				"Extra"=>$columns["Extra"]
			); // end array()
			// get primary-key field
			if(isset($columns["Key"]) && $columns["Key"]=="PRI") {
				$primaryKeyField = $columns["Field"];			
				$primaryKeyType = $columns["Type"];			
			} // end if
		} // end while
		mysql_free_result($result);	
		$this->m_strpkfield = $primaryKeyField;
		$this->m_strpktype = $primaryKeyType;
		$this->m_structure = $tableStructure;
		return true;
	} // end setStructure()
	
	protected function query_row($sql) {
		if(!$this->m_cdatabase)
			return NULL;
		$result = $this->m_cdatabase->query($sql);
		return ($result == FALSE || ($row = mysql_fetch_assoc($result)) == FALSE) ? NULL : $row;
	} // end query_row()
} // end CTable

////////////////////////
// include/use
function include_table($strid, $strpath, $params=NULL) {
	$params["cresource_type"] = "CTable";
	return include_resource( $strid, $strpath, $params );
} // end include_table()

function use_table($strid) {
	return use_resource($strid);
} // end include_table()
?>