<?php
//------------------------------------------------------------------------------------
// file: cattributes.php
// desc: defines base class attributes class
//------------------------------------------------------------------------------------

// headers
include_js(relname(__FILE__).'/cattributes.js');

//-------------------------------------------------------------
// class: CAttributes
// desc:  a class that stores name/value attributes in a hash
//-------------------------------------------------------------
class CAttributes extends CHash{ 
	protected 			$m_celement;	// the object that owns the attributes
	public function 	CAttributes(){ $this->m_celement=NULL; }
	public function 	setCElement( $celement ){ $this->m_celement = $celement; }
	public function 	getCElement(){ return $this->m_celement; }
	public function 	toString(){ return parent::toStringVisit( "CAttributes_ToString" ); }
	public function 	attr( $strattrname ){
		$nargs = func_num_args();	
		if( $nargs == 1 )
			return $this->get( $strattrname ); 	
		else if( $nargs == 3 && (func_get_arg(2) == true) )
			$this->set( $strattrname, "" );
		else if( $nargs == 2 )
			$this->set( $strattrname, func_get_arg(1) );
		else $this->remove( $strattrname );
		return $this;
	} // end attr()
} // end CAttributes
function CAttributes_ToString( $name, $value ){ 
	return ( $value == "" ) ? "$name=\"\" " : "$name=\"$value\" "; 
}  // end CAttributes_ToString()

//-----------------------------------------------------------------------
// class: CCSSAttributes
// desc: defines the attributes defined in the elements style attributes
//-----------------------------------------------------------------------
class CCSSAttributes extends CAttributes{ 
	public function toString(){ 
		return trim( parent::toStringVisit( "CCSSAttributes_ToString" ) ); 
	} // end toString() 
} // end CCSSAttributes
function CCSSAttributes_ToString( $strname, $strvalue ){ 
	return ( $strvalue == "" ) ? $strname : "$strname:$strvalue; "; 
} // end CCSSAttributes_ToString()

//--------------------------------------------------------------
// class: CEventAttributes
// desc: defines event attribute of the element
//--------------------------------------------------------------
class CEventAttributes extends CAttributes{
	public function getHandlers( $streventname ){ return $this->get( $streventname ); }
	public function addHandler( $streventname, $strhandlername ){ 
		$strclassname=""; $strmethodname="";
		if( preg_match( '/(?P<class>\w+)[:|::|.](?P<method>\w+)/', $strhandlername, $matches ) == 1 ){
			$strclassname = $matches['class'];
			$strmethodname = $matches['method'];
		} // end if
		if( method_exists_ex( $strclassname, $strmethodname ) == false && 
			function_exists( $strhandlername ) == false )
			return $this;
		if(($handlers = $this->get( $streventname )) == NULL) 
			$handlers = new CArray();
		$handlers->push( $strhandlername );
		$this->set( $streventname, $handlers );
		return $this;
	} // end addHandlers()
	public function removeHandler( $streventname, $strhandlername ){ 
		if(($handlers = $this->get( $streventname )) == NULL) 
			return $this;
		$handlers->remove( $strhandlername );
		return $this;
	} // end addHandlers()
	public function toString(){ return parent::toStringVisit( "CEventAttributes_ToString", $this ); }
	public function toStringHandlers(){ return "{" . trim( parent::toStringVisit( "CEventAttributes_ToStringHandlers", $this ), "," ) . "}"; }
} // end CEventAttributes
function CEventAttributes_ToStringHandlers( $strevent, $arreventhandlers, $cattributes ){
	return "\"{$strevent}\":[" . implode( ",", $arreventhandlers->valueOf() ) . "],";
} // end CEventAttributes_ToStringHandlers()
function CEventAttributes_ToString( $strevent, $arreventhandlers, $cattributes ){ 
	static $isdefined;
	$celement=NULL;
	if( $strevent == "" || 
		$arreventhandlers == NULL || 
		$cattributes == NULL  )
		return "";
	$l = $arreventhandlers->length();
	$str = "";//"\r\n";
	for( $i=0; $i<$l; $i++ ){		
		$strhandlername 	= $arreventhandlers->get($i);	
		$strclassname=""; $strmethodname="";
		if( preg_match( '/(?P<class>\w+)[:|::|.](?P<method>\w+)/', $strhandlername, $matches ) == 1 ){
			$strclassname = $matches['class'];
			$strmethodname = $matches['method'];
		} // end if
		$bmethod = method_exists_ex($strclassname,$strmethodname);
		// check if the handler already exist
		if( $isdefined != NULL && 
			isset( $isdefined[$strhandlername] ) == true && 
			$isdefined[$strhandlername] == true )
			continue;
		$strbody = ($bmethod) ? call_user_func(array($cattributes->getCElement(),$strmethodname)) : $strhandlername(); 
		// define the handler
		$str .= ($bmethod) ? "" : "var ";
		$str .= "{$strhandlername} = function(event)\r\n";
		$str .= "{\r\n";
		$str .= $strbody;
		$str .= "\r\n}; // end function {$strhandlername}\r\n\r\n";
		$isdefined[$strhandlername]=true;
	} // end for
	return $str;
} // end CEventAttributes_ToString()

//---------------------------------------------------------------------
// class: CPropertyAttributes
// desc: defines the property attributes 
//---------------------------------------------------------------------
class CPropertyAttributes extends CAttributes{ 
	public function toString(){ $str = json_encode( $this->getModifiedArray( $this->valueOf() ) ); return ($str != "") ? $str : ""; } 
	public function getModifiedArray( $array ){ 
		if( $array == NULL )
			return NULL;
		$marray=NULL;
		foreach( $array as $name => $value ){
			$type = gettype( $value );		
			/*if( $value == NULL )
			{
				echo "no properites";
				$type = "undefined";	
				$value = "null";
			}*/
			if( $type == "string" && function_exists( $value ) ){
				$type = "string";
				$value = $value();
			}
			else if( $type == "object" && method_exists( $value, "id" ) ){
				$type = "celement";//get_class( $value );
				$value = $value->id(); 
			} // end if
			else if( $type == "array" )
				$value = $this->getModifiedArray( $value );	
			$marray[$name] = array( "value"=>$value, "type"=>$type );
		} // end for
		return $marray;
	} // end getModifiedArray()
} // end CPropertyAttributes

//---------------------------------------------------------------------
// class: CUnModifiedPropertyAttributes
// desc: defines the property attributes 
//---------------------------------------------------------------------
class CUnModifiedPropertyAttributes extends CPropertyAttributes{ 
	public function toString(){ 
		$str = json_encode( $this->valueOf() ); 
		return ($str != "") ? $str : ""; 
	} // end toString() 
} // end CUnModifiedPropertyAttributes
?>