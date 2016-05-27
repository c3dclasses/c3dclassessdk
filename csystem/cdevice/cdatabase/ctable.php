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
	
	public function CTableMemory(){ 
		parent::CMemory(); 
		$this->close();
	} // end CTableMemory()
	
	public function getName() {
		return $this->m_strname;
	} // end getName()
	
	public function getStructure() {
		return $this->m_structure;
	} // end getStructure()

	public function getPrimaryKeyField() {
		return $this->m_strpkfield;
	} // end getPrimaryKeyField()

	public function getCDatabase() {
		return $this->m_cdatabase;
	} // end getCDatabase()
	
	public function open($strpath="", $params=NULL){
		if(!$strpath)
			return false;
		$pathpattern = '/(?P<host>\w+)\/(?P<database>\w+)\/(?P<table>\w+)/';
		$bmatch = preg_match($pathpattern, $strpath, $matches);
		
		// get the parameters from the path 
		$host = $matches["host"];
		$database = $matches["database"];
		$table = $matches["table"];
		$username = isset($params["username"])	? $params["username"] : "";
		$password = isset($params["password"])	? $params["password"] : "";
		$primary_key_field = isset($params["pk_field"])	? $params["pk_field"] : "";
		$primary_key_type = isset($params["pk_type"])	? $params["pk_type"] : "";
		
		if(!include_database("$host/$database", "$host/$database", $params) ||
		   !($cdatabase = use_database("$host/$database"))) {
			return false;
		} // end if
		
		$this->m_cdatabase = $cdatabase;
		$this->m_strname = $table;
		
		// select the database
		if (!mysql_select_db( $cdatabase->getName(),  $cdatabase->getConnection())) {
    		return false;
		} // end if
		
		$bstructure = $this->setStructure();
		if(!$bstructure && $primary_key_field && $primary_key_type) {
			$result = mysql_query("CREATE TABLE $table ($primary_key_field $primary_key_type NOT NULL, 
			PRIMARY KEY ($primary_key_field));", $cdatabase->getConnection());
			if(!$this->setStructure())
				return false;
		} // end if
		else {
			$result = mysql_query("CREATE TABLE $table (id MEDIUMINT NOT NULL AUTO_INCREMENT, PRIMARY KEY (id));", 
				$cdatabase->getConnection());
			if(!$this->setStructure())
				return false;
		} // end else
		
		return parent::open($strpath, $params);	
	} // end open()
	
	protected function close() {
		parent::close();
		$this->m_structure = NULL;
		$this->m_cdatabase = NULL;
		$this->m_strname = "";
		$this->m_strpkfield = "";
	} // end close()
	
	protected function isOpen() {
		return $this->m_structure && $this->m_cdatabase &&
		 $this->m_strname != "" && $this->m_strpkfield != "" &&
		 mysql_select_db( $this->m_cdatabase->getName(), $this->m_cdatabase->getConnection());
	} // end isOpen()
	
	protected function setStructure(){
		$table =  $this->getName();
		$sql = "SHOW COLUMNS FROM {$table}";
		$result = mysql_query($sql, $this->m_cdatabase->getConnection());
		if ($result == FALSE || mysql_num_rows($result) <= 0)
			return false;
		$tableStructure=NULL;
		$primaryKeyField="";
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
			if(isset($columns["Key"]) && $columns["Key"]=="PRI")
				$primaryKeyField = $columns["Field"];			
		} // end while
		mysql_free_result($result);	
		$this->m_strpkfield = $primaryKeyField;
		$this->m_structure = $tableStructure;
		return true;
	} // end setStructure()
	
	public function create($strprimarykeyvalue, $strcolname="", $value="") {
		if(!$this->isOpen())
			return false;
		$columns=NULL;
		$values=NULL;
		$strtablename = $this->getName();
		$connection = $this->m_cdatabase->getConnection();
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
		//printbr($sql);
		return (mysql_query($sql, $connection) != FALSE);
	} // end create()
	
	public function retrieve($strprimarykeyvalue) {
		if(!$this->isOpen())
			return NULL;
		$strprimarykeyfield = $this->getPrimaryKeyField();
		$strtablename = $this->getName();
		if($strprimarykeyfield == "" || $strtablename == "" || !$this->m_cdatabase || 
			!($connection = $this->m_cdatabase->getConnection())) // retrieve a row 
			return NULL;
		$sql = "SELECT * FROM {$strtablename} WHERE {$strprimarykeyfield} = '{$strprimarykeyvalue}'";
		if(($result = mysql_query($sql, $connection)) == FALSE)
			return NULL;
		return (($row = mysql_fetch_assoc($result)) == FALSE) ? NULL : $row;
	} // end retrieve()
	
	public function delete($strprimarykeyvalue="", $strcolname="", $bdeletecolumn=false){
		if(!$this->isOpen())
			return false;	
		
		$strtablename = $this->getName();
		$connection = $this->m_cdatabase->getConnection();
		$strprimarykeyfield = $this->getPrimaryKeyField();
		
		if(func_num_args()==0) {
			$sql = "DROP TABLE {$strtablename}";
			return ( mysql_query($sql, $connection) == FALSE) ? false : true; 
		} // end if
		
		if($strprimarykeyvalue && $strcolname==""){ // delete a row?
			$sql = "DELETE FROM {$strtablename} WHERE {$strprimarykeyfield} = '{$strprimarykeyvalue}'";
			return ( mysql_query($sql, $connection) == FALSE) ? false : true; 
		} // end if
		
		if(!isset($this->m_structure[$strcolname])) // column exist?
			return false;		
		
		if($bdeletecolumn) {	// delete a column?
			$sql = "ALTER TABLE {$strtablename} DROP COLUMN {$strcolname}";
			return ( mysql_query($sql, $connection) == FALSE) ? false : true; 
		} // end if
		
		return ($this->update($strprimarykeyvalue, $strcolname, NULL)==true); // nullify the column
	} // end delete()
		
	public function update($strprimarykeyvalue, $strcolname, $value, $strtype="") {
		if(!$this->isOpen())
			return false;
				
		$strtablename = $this->m_strname;			
		$connection = $this->m_cdatabase->getConnection();
		$strprimarykeyfield = $this->getPrimaryKeyField();
		$structure = $this->getStructure();
		
		if(isset($structure[$strcolname]) == false || !$structure[$strcolname]) { // add new column
			$sql = "ALTER TABLE {$strtablename} ADD {$strcolname} {$strtype}";
		
			if((mysql_query($sql,$connection) == FALSE) || !$this->setStructure())
				return false;
			$structure = $this->getStructure();
		} // end if
		else if($strtype != "" && ($strtype != $structure[$strcolname]['Type'])) { // change column type
			$sql = "ALTER TABLE {$strtablename} MODIFY {$strcolname} {$strtype}";
			if(mysql_query($sql,$connection) == FALSE || !$this->setStructure())
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
			//printbr($sql);
			if(mysql_query($sql, $connection) == FALSE)
				return false;
		} // end else
		
		return true;
	} // end update()
} // end CTable

function include_table($strid, $strpath, $params=NULL) {
	$params["cresource_type"] = "CTable";
	return include_resource( $strid, $strpath, $params );
} // end include_table()

function use_table($strid) {
	return use_resource($strid);
} // end include_table()
?>