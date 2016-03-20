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
	protected $m_connection;	// database handle
	protected $m_strhost;		// host
	protected $m_strdatabase;	// database	
	protected $m_strusername;	// username
	protected $m_strpassword; 	// password
	
	public function CDatabase(){ 
		$this->close();
	} // end CDatabaseMemory()
	
	public function open( $strpath="", $params=NULL ){
		$pathpattern = '/(?P<host>\w+)\/(?P<database>\w+)/';
		$bmatch = preg_match($pathpattern, $strpath, $matches);
		if( $bmatch == FALSE || $bmatch == 0 || $params == NULL || 
			isset( $params["username"] ) == false || isset( $params["password"] ) == false )
			return false;
		$strhost = $matches['host'];
		$strdatabase = $matches['database'];
		if( ($db=@mysql_connect($strhost,$params["username"],$params["password"]))==NULL )
			return false;	
		
		// try to get the database
		if( mysql_select_db($strdatabase, $db)==FALSE && 
		   (mysql_query("CREATE DATABASE " . $strdatabase, $db )==FALSE || mysql_select_db($strdatabase, $db ) == FALSE))
			return false;	
			
		if( parent::open( $strpath, $params ) == FALSE ){
			$this->close();
			return false;
		} // end if
		$this->m_connection = $db; 
		$this->m_strdatabase = $strdatabase; 
		return true;	
	} // end open()
	
	public function delete() {
		$sql = "DROP DATABASE {$this->m_strdatabase}";
		return ( mysql_query($sql, $this->m_connection) == FALSE) ? false : true; 
	} // end delete()
	
	public function close(){ 
		if($this->m_connection)
			@mysql_close($this->m_connection); 
		$this->m_connection = NULL;
		$this->m_strhost = "";
		$this->m_strdatabase = "";
	} // end close()
	
	public function error(){ 
		return mysql_error( $this->m_connection ); 
	} // end error() 

	public function getConnection(){ 
		return $this->m_connection;
	} // end getConnection();
	
	public function getName(){ 
		return $this->m_strdatabase;
	} // end getName()	
} // end CDatabase

function include_database( $strid, $strpath, $params=NULL ){
	$params["cresource_type"] = "CDatabase";
	return include_resource( $strid, $strpath, $params );
} // end include_database()

function use_database( $strid ){
	return use_resource( $strid );
} // end use_database()
?>