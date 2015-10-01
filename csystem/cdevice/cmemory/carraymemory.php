<?php 
//----------------------------------------------------------------
// file: carraymemory.php
// desc: defines a array memory object 
//----------------------------------------------------------------
class CArrayMemory extends CMemory{	
	protected $m_array;
	
	// construct() / open() / close()
	public function CArrayMemory(){ 
		parent :: CMemory(); 
		$this->m_array=NULL; 
	} // end CArrayMemory()
	public function open( $strpath, $params=NULL ){
		if( !isset( $params["m_array"] ) ||
			parent :: open( $strpath, $params ) == false )
			return false;
		$this->m_array = &$params["m_array"];
		return true;	
	} // end open()
	public function close(){
		$this->save(); 
		$this->m_array = NULL; 
	} // end close()
	
	// create() / retrive() / update() / delete()
	public function create( $strname, $value, $strtype ){ 
		if( isset( $this->m_array[ $strname ] ) )
		 	return NULL;
		$obj = new stdClass;
		$obj->{'m_strname'} = $strname;
		$obj->{'m_value'} = ( gettype( $value ) == "object" ) ? serialize( $value ) : $value;
		$obj->{'m_strtype'} = $strtype;
		$this->m_array[ $strname ] = $obj;
		return ( $this->save() ) ? array( "m_strname"=>$obj->{'m_strname'}, "m_value"=>$value, "m_strtype"=>$obj->{'m_strtype'} ) : NULL;
	} // end create()
	public function retrieve( $strname ){ 
		return ( $this->restore() == FALSE || $this->m_array == NULL || isset( $this->m_array[ $strname ] ) == FALSE || ( $obj = $this->m_array[ $strname ] ) == NULL ) ?
			NULL : array( "m_strname"=>$obj->{'m_strname'}, "m_value"=>$this->unserialize( $obj->{'m_value'}, $obj->{'m_strtype'} ), "m_strtype"=>$obj->{'m_strtype'} );
	} // end retrieve()
	public function update( $strname, $value, $strtype ){ 
		if( $this->m_array == NULL || isset( $this->m_array[ $strname ] ) == FALSE )
			return NULL;
		$obj = $this->m_array[ $strname ];
		$obj->{'m_strname'} = $strname;
		$obj->{'m_value'} = $this->serialize( $value );
		$obj->{'m_strtype'} = $strtype;	
		$this->m_array[ $strname ] = $obj;
		return ( $this->save() ) ? array( "m_strname"=>$obj->{'m_strname'}, "m_value"=>$value, "m_strtype"=>$obj->{'m_strtype'} ) : NULL;
	} // end update()
	public function delete( $strname ){ 
		if( $this->m_array == NULL || isset( $this->m_array[ $strname ] ) == FALSE )
			return false;
		unset( $this->m_array[$strname] );
		return $this->save(); // update the file
	} // end delete()
	
	// misc. methods
	public function error(){
	} // end error()
	public function toString(){ 
		return print_r( $this->m_array, true ); 
	} // end toString()
	public function toJSON(){ 
		return json_encode($this->m_array); 
	} // end toString()
	public function serialize( $value ){ 
		return ( gettype( $value ) == "object" ) ? serialize( $value ) : $value; 
	} // end serialize()
	public function unserialize( $value, $strtype ){ 
		return ( $strtype == "object" ) ? unserialize( $value ) : $value; 
	} // end unserialize()  
	public function restore(){
		return true;
	} // end restore()
	public function save(){
		return true;		
	} // end save()
} // end CArrayMemory

function include_array_memory( $strid, $strpath, &$array=NULL, $params=NULL ){
	$params["m_array"]=&$array;
	return include_memory( $strid, $strpath, "CArrayMemory", $params );
} // end include_array_memory()
?>