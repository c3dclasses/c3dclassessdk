 <?php
//----------------------------------------------------------------
// file: cdatabase.php
// desc: defines a database object 
//----------------------------------------------------------------

//----------------------------------------------------------------
// class: CDatabase
// desc: defines a database object 
//----------------------------------------------------------------
class CDatabase extends CResource {
	protected $m_db;			// database handle
	protected $m_strhost;		// host
	protected $m_strdatabase;	// database	
	protected $m_strusername;
	protected $m_strpassword;
	
	// construct() / open() / close()	
	public function CDatabase(){ 
		$this->m_db = NULL;
		$this->m_strhost = "";
		$this->m_strdatabase = "";
	} // end CDatabaseMemory()
	
	public function open( $strpath="", $params=NULL ){
		$pathpattern = '/(?P<host>\w+)\/(?P<database>\w+)/';
		$bmatch = preg_match($pathpattern, $strpath, $matches);
		if( $bmatch == FALSE || $bmatch == 0 || $params == NULL || isset( $params["username"] ) == false || isset( $params["password"] ) == false )
			return false;
		$strhost = $matches['host'];
		$strdatabase = $matches['database'];
		if( ($db=@mysql_connect($strhost,$params["username"],$params["password"]))==NULL )
			return false;	
		if( parent::open( $strpath, $params ) == FALSE ){
			$this->close();
			return false;
		} // end if
		$this->m_db = $db; 
		$this->m_strdatabase = $strdatabase; 
		//alert("opened database");
		return true;	
	} // end open()
	
	public function getConnection(){ 
		return $this->m_db;
	} // end getConnection();
	
	public function getName(){ 
		return $this->m_strdatabase;
	} // end getDatabaseName()
	
	public function close(){ 
		@mysql_close( $this->m_db ); 
	} // end close()
} // end CDatabase

function include_database( $strid, $strpath, $params=NULL ){
	$params["cresource_type"] = "CDatabase";
	return include_resource( $strid, $strpath, $params );
} // end include_memory()

function use_database( $strid ){
	return use_resource( $strid );
} // end use_database()


//--------------------------------------------------------------------------------------------------
// class: CTableMemory
// desc: defines a table of memory objects, for example each row contains a set of name/value pairs
//--------------------------------------------------------------------------------------------------
class CTableMemory extends CMemory{
	protected $m_table;	
		
	public function CTableMemory(){ 
		parent::CMemory(); 
	} // end CTableMemory()
	
	public function open($strsqlpath="", $params=NULL){
		if(!$strsqlpath || !$params || !isset($params["database"]) )
			return false;
		
		$database = use_database($params["database"]);
		if(!$database)
			return false;
			
		$connection = $database->getConnection();
		if(!$connection)
			return false;
	
		$database_name=$database->getName();
		if (!mysql_select_db($database_name, $connection)) {
    		return false;
		} // end if
		
		$result = mysql_query($strsqlpath, $connection);
		if( $result == FALSE ) {
			return false;
		} // end if
		
		$tables_primary_key=NULL;
		$num_columns = mysql_num_fields($result);
		for($row=0; ($rowdata = mysql_fetch_assoc($result)); $row++) {
    		for($column=0; $column<$num_columns; $column++) {
				$column_name=mysql_field_name($result, $column);
				$column_type=mysql_field_type($result, $column);
				$column_value=$rowdata[$column_name];
				$table_name=mysql_field_table($result,$column);
				
				// get the primary key for the table
				if(!$tables_primary_key)
					$tables_primary_key=array();
				
				//alert($table_name);
				if(!isset($tables_primary_key[$table_name])){
					$table_info_result = mysql_query("SHOW COLUMNS FROM $table_name");
					$tables_primary_key[$table_name]="";
					if (mysql_num_rows($table_info_result) > 0) {
    					while ($table_info_row = mysql_fetch_assoc($table_info_result)) {
							if($table_info_row["Key"] == "PRI") {
								$tables_primary_key[$table_name]=$table_info_row["Field"];
							} // end if
    					} // end while
						mysql_free_result($table_info_result);	
					} // end if
				} // end if
				
				// get the address on the table datapoint
				$address="";
				$primary_key_name="";
				$primary_key_value=$row;
				if($table_name != "") {
					if(($primary_key_name = $tables_primary_key[$table_name]) != "")
						$primary_key_value = $rowdata[$primary_key_name];
					$address="[$database_name][$table_name][$column_name]=([$primary_key_name]='$primary_key_value')";
				} // end if
				
				// set up the array
				if(!$this->m_table)
					$this->m_table=array();
				
				
				
				
				/*	
				// set up a row
				if(!isset($this->m_table[$primary_key_value]))
					$this->m_table[$primary_key_value]=array();
				*/
				$column_count=1;
				$colname=$column_name;
				$varname = $column_name ."[" . $primary_key_value . "]";
				while(isset($this->m_table[$varname])) {
					$varname =  $column_name . $column_name . "[" . $primary_key_value . "]";	
					$column_count++;
				} // end while
				
				$this->m_table[$varname]=array("m_strname"=>$column_name, "m_value"=>$column_value, "m_strtype"=>$column_type, "m_address"=>$address);
					
				printbr($varname);
				
				/*
				// check if the field name already exist
				$field_count=1;
				$field_name=$column_name;
				while(isset($this->m_table[$primary_key_value][$column_name])) { 
					$column_name=$field_name.$field_count;
					$field_count++;
				} // end while
				$this->m_table[$primary_key_value][$column_name]=array("m_strname"=>$column_name, "m_value"=>$column_value, "m_strtype"=>$column_type, "m_address"=>$address);
				*/
				
			} // end for cols
			printbr();
			
		} // end while rows	
		
		//print_r($this->m_table);
		mysql_free_result($result);
		
		if(parent::open($strsqlpath, $params) == FALSE) {
			$this->close();
			return false;
		} // end if
		
		return true;	
	} // end open()

	public function close(){ 
		$this->m_table = NULL; 
	} // end close()
	
	public function retrieve( $strname ) {
		return ($this->m_table && isset($this->m_table[$primarykey])) ? $this->m_table[$primarykey][$strname] : ""; 
	} // end retrieve
/*	
	// create() / retrieve() / update() / delete()
	public function create( $strname, $value, $strtype ){ 
		$row = array( 'm_strname'=>$strname, 'm_value'=>$value, 'm_strtype'=>$strtype ); 
		$value = $this->serialize( $value ); 
		return mysql_query( "INSERT INTO {$this->m_strtable} VALUES( '$strname', '$value', '$strtype' )", $this->m_db ) ? $row : NULL; 
	} // end create()
	
	public function retrieve( $strname ){ 
		if( ( $result = mysql_query( "SELECT * FROM {$this->m_strtable} WHERE m_strname = '$strname'", $this->m_db ) ) == FALSE || 
			( $row = mysql_fetch_assoc($result) ) == FALSE ) 
			return NULL;
		$row['m_value'] = $this->unserialize($row['m_value'], $row['m_strtype'] ); 
		return $row;
	} // end retrieve()
	
	public function update( $strname, $value, $strtype ){ 
		$row = array( 'm_strname'=>$strname, 'm_value'=>$value, 'm_strtype'=>$strtype );
		$value = $this->serialize( $value ); 
		return mysql_query( "UPDATE {$this->m_strtable} SET m_value='$value', m_strtype='$strtype' WHERE m_strname='$strname'", $this->m_db ) ? $row : NULL; 
	} // end update()
	
	public function delete( $strname ){ 
		return mysql_query( "DELETE FROM {$this->m_strtable} WHERE m_strname = '$strname'", $this->m_db ); 
	} // end delete()
	
	// misc. methods
	public function error(){ 
		return mysql_error( $this->m_db ); 
	} // end error() 
	public function toString(){ 
		if( !$this->m_db || !( $result = mysql_query( "SELECT * FROM {$this->m_strtable};", $this->m_db ) ) )
			return FALSE;
		$str = "";
		while( ( $row = mysql_fetch_assoc($result) ) != FALSE ){
			$row['m_value'] = $this->unserialize( $row['m_value'], $row['m_strtype'] );
			$str .= ( print_r( $row, true ) . "\n" );
		} // end while()
		return $str;
	} // end toString()
	public function toJSON(){ 
		if( !$this->m_db || !( $result = mysql_query( "SELECT * FROM {$this->m_strtable};", $this->m_db ) ) )
			return FALSE;
		$rows = NULL;
		while( ( $row = mysql_fetch_assoc($result) ) != FALSE ){
			$row['m_value'] = $this->unserialize( $row['m_value'], $row['m_strtype'] );
			$rows[$row['m_strname']] = $row;
		} // end while()	
		return json_encode($rows); 
	} // end toString()
	*/
} // end CTableMemory

//----------------------------------------------
// name: CRowMemory
// desc: defines a table row as a memory object
//----------------------------------------------
class CRowMemory {
	protected $m_rowid;
	protected $m_tableid;
	
	
	
} // end CRowMemory

function include_table_memory($strid, $strdatabaseid, $strpath, $params=NULL) {
	$params["database"]=$strdatabaseid;
	return include_memory($strid,$strpath, "CTableMemory", $params);
} // end include_table_memory()

function use_table_memory($strtableid, $strrowid="0") {
	
} // end use_table_memory()

//function include_database_memory( $strid, $strpath="localhost/kevlewis_wordpress/cmemory", $params=array("username"=>"kevlewis_admin", "password"=>"yu?me@work2") ){
//	return include_memory( $strid, $strpath, "CDatabaseMemory", $params );
//} // end include_memory()

//function include_database_memory( $strid, $strpath="localhost/c3dclasses/cmemory", $params=array("username"=>"kevlewis_admin", "password"=>"yu?me@work2") ){
//	return include_memory( $strid, $strpath, "CDatabaseMemory", $params );
//}// end include_database_memory()

//include_memory( "cdatabasememory", "localhost/c3dclasses/cdatabasememory", "CDatabaseMemory", array("username"=>"kevlewis_admin", "password"=>"yu?me@work2") );
?>