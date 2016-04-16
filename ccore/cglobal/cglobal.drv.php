<?php
//-------------------------------------------------------------------
// file: cglobal.drv.php
// desc: contains global functions used throughout the SDK
//-------------------------------------------------------------------

///////////////////////////////////////////////////////////////////////////

//-----------------------------------------------------------------
// name: buildHTMLTag*()
// desc: helper functions
//-----------------------------------------------------------------
function buildHTMLTag( $strtagname, $attributes=NULL, $bmultitag=false, $strbody="" ){
	$strattributes="";
	if( $attributes != NULL )
		foreach( $attributes as $name => $value )
			$strattributes .= "$name=\"$value\" ";
	$str = "<{$strtagname} {$strattributes}"; 
	$str .= ( $bmultitag )? ">{$strbody}</{$strtagname}>" : "/>";
	return $str;
} // end buildHTMLTag()

function buildHTMLOpenTag( $strtagname, $attributes ){
	$strattributes="";
	foreach( $attributes as $name => $value )
		$strattributes .= "$name=\"$value\" ";
	$str = "<{$strtagname} {$strattributes}>"; 
	return $str;	
} // end buildHTMLOpenTag()

function buildHTMLCloseTag( $strtagname ){
	return "</{$strtagname}>";
} // buildHTMLClosingTag()

////////////////////////////////////////

function method_exists_ex( $strclasstype, $strmethodname ){
	if( $strclasstype == "" )
		return false;
	if( method_exists( $strclasstype, $strmethodname ) )
		return true;
	return method_exists_ex( get_parent_class( $strclasstype ), $strmethodname );
} // end method_exists_ex()

function get_classtype_of_method( $strclasstype, $strmethodname ){
	if( $strclasstype == "" )
		return "";
	if( method_exists( $strclasstype, $strmethodname ) )
		return $strclasstype;
	return get_classtype_of_method( get_parent_class( $strclasstype ), $strmethodname );
} // end get_classtype_of_method()

function bind( $strfunction, $object ){ 
	return Closure::bind($strfunction, $object, get_class($object) ); 
} // end bind()

function functionToString( $functionorclosure, $bbindglobals=false ){ 
	$strfunc=__functionToString($functionorclosure); 
	return ($bbindglobals)?__functionGlobalsToString( $strfunc ) : $strfunc; 
} // end functionToString()

function stringToFunction( $strfunction ){ 
	$strfunction = "\$_closure = " . $strfunction; 
	$ret = eval( $strfunction . "return TRUE;" ); 
	return ( $ret == TRUE ) ? $_closure : NULL; 
} // end stringToFunction()

function __functionToString( $functionorclosure ){	
	$type = getTypeOf( $functionorclosure );
	if( $type != "function" && $type != "closure" )
		return "";
	if( ($reflection = new ReflectionFunction($functionorclosure)) == NULL )
		return "";
	$strfunctionorclosure="";
	try {
		if( ($file = new SplFileObject($reflection->getFileName())) == NULL )
			return "";	
		$file->seek($reflection->getStartLine()-1);
		for( $strfunctionorclosure=''; $file->key()<$reflection->getEndLine(); $file->next() )
			$strfunctionorclosure .= $file->current();	
		$strfunctionorclosure = preg_replace( array("/\/\/.*/", "!/\*.*?\*/!s"), "", $strfunctionorclosure );	
		if( $type == "function" ) 
			$strpattern = '/function[[:space:]]*(\w+)[[:space:]]*\(/';	
		else $strpattern = '/.*function[[:space:]]*\(/';	// make function into closure
		$strfunctionorclosure = preg_replace( $strpattern, "function(",$strfunctionorclosure );
		$strfunctionorclosure = trim( $strfunctionorclosure );
		$strfunctionorclosure .= ( $type == "function" ) ? ";" : "";	
	} // end try
	catch( Exception $ex ){
		$strfunctionorclosure = "";
	} // end catch()
	return $strfunctionorclosure;
} // end __functionToString()  

function __functionGlobalsToString( $strfunction ){
	$strpattern = '/global[[:space:]]*\$(?P<global>\w+)[[:space:]]*;/';
	$nummatches = preg_match_all( $strpattern, $strfunction, $matches );
	if( $nummatches == 0 ) 
		return $strfunction;
	if( $nummatches == FALSE ) 
		return "";
	for( $i=0; $i<$nummatches; $i++ ){
		$strglobalname 	= trim($matches['global'][$i]);
		$value = __globalToString( $strglobalname );
		$strreplacepattern = "\$$1 = $value;";	// replace varibles with object members
		$strpattern = '/global[[:space:]]*\$(?P<global>'.$strglobalname.')[[:space:]]*;/';
		$strfunction = preg_replace( $strpattern, $strreplacepattern, $strfunction );	
	} // end for()
	return $strfunction;
} // end __functionGlobalsToString()

function __globalToString( $strglobalname ){
	if( isset( $GLOBALS ) == false || isset( $GLOBALS[$strglobalname] ) == false )
		return "NULL";
	$value = $GLOBALS[$strglobalname];
	$type = gettype( $value );
	if( $type == "string" )
		return '"'.$value.'"';
	else if( $type == "integer" || $type == "double" )
		return $value;
	else if( $type == "object" );
		return "unserialize('".serialize($value)."')"; 
	return $value;
} // end __globalToString()
/*
var filename = (new Error).fileName;
//alert( "This is the name of this script: " + filename);

var scriptSource = (function() {
    var scripts = document.getElementsByTagName('script');
    var script = scripts[scripts.length - 1].src;
    return script;//.substring(0, script.lastIndexOf('/')) + '/';
}());
 
//alert(scriptSource);
*/
/*
function __FILE__(){
	return (new Error).fileName;
} // end __FILE__()


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//-----------------------------------------------------------------
// name: helper functions
// desc: 
//-----------------------------------------------------------------

function functionToString( _function ){ 
	return "" + _function;
} // end functionToString()

function stringToFunction( strfunction ){ 
	return;
} // end stringToFunction()

*/
?>