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
	
	public function CDatabase() { 
		parent::CResource();
		$this->destroy();
	} // end CDatabaseMemory()
	
	public function open($strpath="", $params=NULL) {
		$pathpattern = '/(?P<host>\w+)\/(?P<database>\w+)/';
		$bmatch = preg_match($pathpattern, $strpath, $matches);
		if($bmatch == FALSE || $bmatch == 0 || 
			$params == NULL || 
			isset($params["username"] ) == false || 
			isset($params["password"] ) == false )
			return false;
		$strhost = $matches['host'];
		$strdatabase = $matches['database'];
		if(($connection=@mysql_connect($strhost,$params["username"],$params["password"]))==NULL)
			return false;	
		$this->m_strhost = $strhost;
		$this->m_connection = $connection; 
		$this->m_strdatabase = $strdatabase; 
		if(!$this->select() && $this->query("CREATE DATABASE " . $strdatabase)==FALSE) {
			$this->destroy();
			return false;
		} // end if
		if(parent::open($strpath, $params ) == FALSE) {
			$this->destroy();
			return false;
		} // end if
		return true;	
	} // end open()
	
	public function close() { 
		//parent::close();
		return @mysql_close($this->m_connection) == FALSE; 
	} // end close()
	
	public function select() {
		return mysql_select_db($this->m_strdatabase, $this->m_connection) != FALSE;
	} // end select()
	
	public function create() {
		return $this->query("CREATE DATABASE " . $this->m_strdatabase) == FALSE;
	} // end create()
	
	public function delete() {
		return $this->query("DROP DATABASE {$this->m_strdatabase}") == FALSE; 
	} // end delete()
	
	public function query($sql) {
		return mysql_query($sql, $this->m_connection); 
	} // end query()
	
	public function destroy() {
		$this->close();
		$this->m_connection = NULL;
		$this->m_strhost = "";
		$this->m_strdatabase = "";
	} // end destroy()
	
	public function error() { 
		return mysql_error($this->m_connection); 
	} // end error() 

	public function getConnection() { 
		return $this->m_connection;
	} // end getConnection();
	
	public function getName() { 
		return $this->m_strdatabase;
	} // end getName()	
	
	public function getHost() { 
		return $this->m_strhost;
	} // end getHost()	
} // end CDatabase

function include_database($strid, $strpath, $params=array("username"=>"", "password"=>"")) {
	$params["cresource_type"] = "CDatabase";
	return include_resource($strid, $strpath, $params);
} // end include_database()

function use_database($strid) {
	return use_resource($strid);
} // end use_database()
?>