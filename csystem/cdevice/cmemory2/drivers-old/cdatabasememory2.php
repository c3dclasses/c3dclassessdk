<?php
//----------------------------------------------------------------
// file: cdatabasememory.php
// desc: defines a database memory object 
//----------------------------------------------------------------

//----------------------------------------------------------------
// class: CDatabaseMemory
// desc: defines a database memory object 
//----------------------------------------------------------------
class CDatabaseMemory extends CMemory{
	protected $m_strhost	 = "localhost";		// host
	protected $m_strdatabase = "c3dclasses";	// database	
	protected $m_strtable    = "cmemory";		// table
	protected $m_db;							// database handle
	
	// construct() / open() / close()	
	public function CDatabaseMemory(){ 
		$this->m_db = NULL;
		parent::CMemory(); 
	} // end CDatabaseMemory()
	
	public function open( $strpath="", $params=NULL ){
		$pathpattern = '/(?P<server>\w+)\/(?P<database>\w+)\/(?P<table>\w+)/';
		$bmatch = preg_match($pathpattern, $strpath, $matches);
		
		if( $bmatch == FALSE || $bmatch == 0 || $params == NULL || isset( $params["username"] ) == false || isset( $params["password"] ) == false )
			return false;
		$strhost = $matches['server'];
		$strdatabase = $matches['database'];
		$strtable = $matches['table'];
		
		if( ($db=@mysql_connect($strhost,$params["username"],$params["password"]))==NULL ||
			mysql_select_db($strdatabase, $db)==FALSE && mysql_query("CREATE DATABASE " . $strdatabase, $db )==FALSE ||
			mysql_select_db($strdatabase, $db ) == FALSE ||
			( mysql_num_rows( mysql_query("SHOW TABLES LIKE '".$strtable."'", $db ) ) == FALSE && mysql_query("CREATE TABLE " . $strtable . " ( m_strname varchar(100) NOT NULL, m_value varchar(1000) NOT NULL, m_strtype varchar(1000), PRIMARY KEY( m_strname ));", $db ) == FALSE ) )
			return false;	
		
		if( parent::open( $strpath, $params ) == FALSE ){
			$this->close();
			return false;
		} // end if
		
		$this->m_db = $db; 
		$this->m_strtable = $strtable; 
		$this->m_strdatabase = $strdatabase; 
		
		return true;	
	} // end open()
	
	public function close(){ 
		mysql_close( $this->m_db ); 
	} // end close()
	
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
} // end CDatabaseMemory

//function include_database_memory( $strid, $strpath="localhost/kevlewis_wordpress/cmemory", $params=array("username"=>"kevlewis_admin", "password"=>"yu?me@work2") ){
//	return include_memory( $strid, $strpath, "CDatabaseMemory", $params );
//} // end include_memory()

function include_database_memory( $strid, $strpath="localhost/c3dclasses/cmemory", $params=array("username"=>"kevlewis_admin", "password"=>"yu?me@work2") ){
	return include_memory( $strid, $strpath, "CDatabaseMemory", $params );
}// end include_database_memory()

//include_memory( "cdatabasememory", "localhost/c3dclasses/cdatabasememory", "CDatabaseMemory", array("username"=>"kevlewis_admin", "password"=>"yu?me@work2") );
?>