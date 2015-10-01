<?php
//----------------------------------------------------------------
// file: cjsonmemory.php
// desc: defines a json memory object 
//----------------------------------------------------------------

//----------------------------------------------------------------
// file: CJSONMemory.php
// desc: defines a json memory object 
//----------------------------------------------------------------
class CJSONMemory extends CMemory{	
	protected $m_json;
	
	// contruct() / open() / close()
	public function CJSONMemory(){ 
		parent :: CMemory(); 
		$this->m_json=NULL; 
	} // end CJSONMemory()
	
	public function open( $strpath, $params=NULL ){
		if( ( file_exists( $strpath ) ) == FALSE ||
			( $strcontents = file_get_contents( $strpath ) ) == "" ||
			( $json = json_decode( $strcontents ) ) == NULL )
			$json = new stdClass;
		if( parent :: open( $strpath, $params ) == false )
			return false;
		$this->m_json = $json;
		return true;	
	} // end open()
	
	public function close(){ 
		$this->save(); 
	} // end close()
	
	// create() / retrieve() / update() / delete() 
	public function create( $strname, $value, $strtype ){ 
		if( $this->m_json == NULL )
			$this->m_json = new stdClass;
		if( isset( $this->m_json->{ $strname } ) )
		 	return NULL;
		$this->m_json->{ $strname } = new stdClass;
		$obj = $this->m_json->{ $strname };
		$obj->{'m_strname'} = $strname;
		$obj->{'m_value'} = ( gettype( $value ) == "object" ) ? serialize( $value ) : $value;
		$obj->{'m_strtype'} = $strtype;
		return ( $this->save() ) ? array( "m_strname"=>$obj->{'m_strname'}, "m_value"=>$value, "m_strtype"=>$obj->{'m_strtype'} ) : NULL;
	} // end create()
	
	public function retrieve( $strname ){ 
		return ( $this->restore() == FALSE || $this->m_json == NULL || isset( $this->m_json->{ $strname } ) == FALSE || ( $obj = $this->m_json->{ $strname } ) == NULL )
		 ? NULL : array( "m_strname"=>$obj->{'m_strname'}, 
		 				 "m_value"=>$this->unserialize( $obj->{'m_value'}, $obj->{'m_strtype'} ), 
						 "m_strtype"=>$obj->{'m_strtype'} );
	} // end retrieve()
	
	public function update( $strname, $value, $strtype ){ 
		if( $this->m_json == NULL || isset( $this->m_json->{ $strname } ) == FALSE )
			return NULL;
		$obj = $this->m_json->{ $strname };
		$obj->{'m_strname'} = $strname;
		$obj->{'m_value'} = $this->serialize( $value ); 
		$obj->{'m_strtype'} = $strtype;	
		return ( $this->save() ) ? array( "m_strname"=>$obj->{'m_strname'}, 
										  "m_value"=>$value, 
										  "m_strtype"=>$obj->{'m_strtype'} ) : NULL;
	} // end update()
	
	public function delete( $strname ){ 
		if( $this->m_json == NULL || isset( $this->m_json->{ $strname } ) == FALSE )
			return false;
		$this->m_json->{$strname} = NULL;
		unset( $this->m_json->{$strname} );
		return $this->save(); // update the file
	} // end delete()
	
	// misc. methods
	public function error(){
	} // end error()
	public function toString(){ 
		return print_r( $this->m_json, true ); 
	} // end toString()
	public function toJSON(){ 
		return json_encode($this->m_json); 
	} // end toString()
	 
	public function serialize( $value ){ 
		return ( gettype( $value ) == "object" ) ? serialize( $value ) : $value; 
	} // end serialize()
	public function unserialize( $value, $strtype ){ 
		return ( $strtype == "object" ) ? unserialize( $value ) : $value; 
	} // end unserialize()  
	public function save(){
		if( $this->m_json == NULL || ( $infile = fopen( $this->m_hashparams->get( "cresource_path" ), "w" ) ) == NULL )
			return false;
		if( fwrite( $infile, json_encode( $this->m_json ) ) == FALSE ){} 
		fclose( $infile );
		return true;		
	} // end save()
} // end CJSONMemory

function include_json_memory( $strid, $strpath, $params=NULL ){
	return include_memory( $strid, $strpath, "CJSONMemory", $params );
} // end include_memory()

// include the first json memory 
include_memory( "cjsonmemory", dirname(__FILE__) . "/cjsonmemory.json", "CJSONMemory", array("client"=>true) );
?>