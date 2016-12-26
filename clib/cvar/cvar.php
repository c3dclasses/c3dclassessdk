<?php
//-------------------------------------------------------------
// name: cvar.php
// desc: defines a variable
//-------------------------------------------------------------

// headers
include_js( relname(__FILE__) . "/cvar.js" );

//-------------------------------------------------------------
// name: CVar
// desc: represents the CVar object
//-------------------------------------------------------------
class CVar{
	// members
	protected $m_strtype;
	protected $m_strname;
	protected $m_value;
	protected $m_cmemory;
	
	// constructor
	public function CVar(){ 
		$this->clear(); 
	} // end CVar() 
	
	public function create( $strmemoryid, $strname, $value=NULL ){	
		if( ( $cmemory = use_memory( $strmemoryid ) ) == NULL ||
			( $var=$cmemory->create( $strname, $value, gettype( $value ) ) ) == NULL )
			return false;
		$this->init( $var );
		$this->m_cmemory = $cmemory;
		return true;	
	} // end create()
	public function retrieve( $strmemoryid, $strname ){	
		if( ( $cmemory = use_memory( $strmemoryid ) ) == NULL ||
			( $var=$cmemory->retrieve( $strname ) ) == NULL )
			return false;
		$this->init( $var );
		$this->m_cmemory = $cmemory;
		return true;	
	} // end retrieve()
	
	public function get(){ 
		return ( $this->m_cmemory == NULL || $this->m_strname == "" || $this->init( $this->m_cmemory->retrieve( $this->m_strname ) ) == false ) ? "" : $this->m_value; 
	} // end get()
	public function set( $value=NULL ){ 
		return ( $this->m_cmemory == NULL || $this->m_strname == "" || $this->init( $this->m_cmemory->update( $this->m_strname,$value,gettype($value))) == NULL ) ? "" : $this->m_value; 
	} // end set()
	public function destroy(){ 
		if( ( $this->m_cmemory ) == NULL ) 
			return false; 
		$this->m_cmemory->delete( $this->m_strname ); 
		$this->clear(); 
		return true; 
	} // end destroy() 
	
	// other
	public function _(){ 
		return ( func_num_args() > 0 ) ? $this->set( func_get_arg(0) ) : $this->get(); 
	} // end _()
	public function init( $var ){ 
		if( $var == NULL ) 
			return false; 
		$this->m_strtype = $var['m_strtype']; 
		$this->m_strname = $var['m_strname']; 
		$this->m_value = $var['m_value']; 
		return true;
	} // end init()
	public function clear(){ 
		$this->m_strtype = ""; 
		$this->m_strname = ""; 
		$this->m_value = ""; 
		$this->m_cmemory = NULL; 
	} // end clear()

	public function error(){ 
		if( $this->m_cmemory ) 
			$this->m_cmemory->error(); 
	} // end error()
	public function save(){ 
		if( $this->m_cmemory ) 
			$this->m_cmemory->save(); 
	}	// if syncing no retrive call need to be made - autoupdate()/autoretrieve()
	public function restore(){ 
		if( $this->m_cmemory ) 
		$this->m_cmemory->restore(); 
	}	// if syncing no retrive call need to be made - autoupdate()/autoretrieve()
	
	// conversion methods
	public function toString(){
		return serialize( $this );
	} // end toString()
	public function toJSON(){
		
	} // end toJSON()
} // end CVar

//---------------------------------------------------------------------
// name: CVarManager
// desc: manages cvar objects
//---------------------------------------------------------------------
class CVarManager{
	// methods
	static public function create( $strmemoryid, $strname, $value=NULL ){ 
		return ( ( $cvar = new CVar() ) == NULL || $cvar->create( $strmemoryid, $strname, $value ) == false ) ? NULL : $cvar; 
	} // end create() 
	static public function get( $strmemoryid, $strname ){ 
		return ( ( $cvar = new CVar() ) == NULL || $cvar->retrieve( $strmemoryid, $strname ) == false ) ? NULL : $cvar; 
	} // end get()
	static public function destroy( $cvar ){ 
		if( $cvar == NULL ) 
			return; 
		$cvar->destroy(); 
		return; 
	} // end destroy()
} // end CVarManager

// cvar management functions
function newvar( $strmemoryid, $strname, $strvalue=NULL ){ 
	return CVarManager :: create( $strmemoryid, $strname, $strvalue );  
} // end newvar()
function getvar( $strmemoryid, $strname ){ 
	return CVarManager :: get(  $strmemoryid, $strname );  
} // end getvar()
function delvar( $cvar ){ 
	CVarManager :: destroy( $cvar );  
} // end delvar()
// creates / gets a new cvar
function _var( $strmemoryid, $strname, $strvalue=NULL ){
	return ( ($cvar = newvar( $strmemoryid, $strname, $strvalue )) || ($cvar = getvar( $strmemoryid, $strname )) ) ? $cvar : NULL;
} // end _var()
?>