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
		return true;	
	} // end open()
	
	public function getConnection(){ 
		return $this->m_db;
	} // end getConnection();
	
	public function close(){ 
		@mysql_close( $this->m_db ); 
	} // end close()
} // end CDatabase

/*
class CSQL{
	protected $m_strdbid; // the database of the query
	protected $m_strid;	// the id of the query
	protected $m_strsql; // the sql of the query
	static protected $m_arrcsql = NULL; // stores all included querys
	
	public function CSQL(){
		$this->m_strid="";
		$this->m_strsql="";
		$this->m_strdbid="";
	} // end CSQL()
	
	public function create( $strdbid, $strid, $strsql ){
		if( !$strdbid || !$strid || !$strsql )
			return false;
		$this->m_strid=$strid;
		$this->m_strsql=$strsql;
		$this->m_strdbid=$strdbid;
		CSQL :: $m_arrcsql[ $strid ] = $this;
		return true; 
	} // end create()
	
	public function _( $inparams ){
		if( !($cdatabase = use_database( $this->m_strdbid )) ||
			!($connection = $cdatabase->getConnection() ) )
			return "";
		$strsql = $this->m_strsql;
		if( $inparams )
			foreach( $inparams as $name => $value )
				$strsql = str_replace( "[[".$name."]]", $value, $strsql );
		return mysql_query($strsql, $connection);
	} // end _()
	
	public static function getCSQLByID( $strid ){
		return ( CSQL :: $m_arrcsql && isset( CSQL :: $m_arrcsql[ $strid ] ) ) ? ( CSQL :: $m_arrcsql[ $strid ] ) : NULL;
	} // end getCSQLByID()
} // end CSQL

function include_database( $strid, $strpath, $params=NULL ){
	$params["cresource_type"] = "CDatabase";
	return include_resource( $strid, $strpath, $params );
} // end include_memory()

function use_database( $strid ){
	return use_resource( $strid );
} // end use_database()

function include_sql( $strdatabaseid, $queryid, $queryvalue ){
	return ( ($csql = new CSQL()) && $csql->create( $strdatabaseid, $queryid, $queryvalue ) );
} // end include_sql()

function use_sql( $strsqlid ){
	return CSQL :: getCSQLByID( $strsqlid );
} // end use_sql()
*/
?>