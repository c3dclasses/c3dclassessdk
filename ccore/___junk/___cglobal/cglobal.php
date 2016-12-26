<?php
//-------------------------------------------------------------------
// file: cglobal.php
// desc: contains global functions used throughout the SDK
//-------------------------------------------------------------------

// returns the absolute path of the file
function abs_path( $strfilename ){
	return dirname( $strfilename ); 
} // end abs_path()

// returns the url path of the file
function uri_path( $strfilename, $bfullpath=true ){
	$strfilepath = str_replace("\\","/", dirname( $strfilename ));	
	$strdocroot  = docroot();	
	$pos = strpos( $strfilepath, $strdocroot );
	if( $pos === false ) 
		return ""; 		
	$strurlpath = substr( $strfilepath, strlen( $strdocroot ) );
	if( !$bfullpath )
		return $strurlpath;			
	$strhttp = isset($_SERVER["HTTPS"]) ? "https://" : "http://";
	$strport = ( isset($_SERVER["SERVER_PORT"] ) && $_SERVER["SERVER_PORT"] != "80") ? (":".$_SERVER["SERVER_PORT"]) : "";
	$strurlpath = $strhttp . $_SERVER['SERVER_NAME'] . $strport . $strurlpath;
	return $strurlpath;
} // end uri_path()

// returns the relative path of a file
function rel_path( $strfilename ){
	return uri_path( $strfilename, false );
} // end rel_path()

/////////////////

// returns the absolute filename of the file
function abs_name( $strfilename ){
	return $strfilename;
} // end abs_name()

// returns the relative filename of the file
function uri_name( $strfilename ){
	return uri_path( $strfilename, true ) . "/" . basename( $strfilename );
} // end uri_name()

// returns the relative name of the file
function rel_name( $strfilename ){
	return uri_name( $strfilename );
} // end rel_name()

//-------------------------------------------------------
// name: filepath(), dirpath(), docroot()
// desc: path / root / filenames
//-------------------------------------------------------
function filepath( $strfilepath, $brelative=true ){
} // end filepath()

function dirpath( $strpathpath, $brelative=true ){
} // end dirpath()

function docroot(){	
	static $strdocroot = NULL; 
	if( $strdocroot ) 
		return $strdocroot;	
	$strlocalpath = getenv("SCRIPT_NAME");		
	$strabsolutepath = str_replace("\\","/", realpath(basename($strlocalpath)) );	
	$strdocroot=substr($strabsolutepath,0,stripos($strabsolutepath,$strlocalpath));
	return $strdocroot;
} // end docroot()

function sdkroot(){ 
	static $strsdkroot = NULL;
	if( $strsdkroot ) 
		return $strsdkroot;	
	$strsdkroot = dirname( __FILE__ );
	while( $strsdkroot != NULL && (basename($strsdkroot) != "c3dclassessdk") ) 
		$strsdkroot = dirname( $strsdkroot );
	$strsdkroot = str_replace( "\\", "/", $strsdkroot );
	return $strsdkroot;
} // end sdkroot()

function webroot( $bfullpath=false ){ 
	static $strwebroot = NULL;
	static $strfullwebroot = NULL;
	if( $strwebroot && $bfullpath == false ) 
		return $strwebroot;
	else if( $strfullwebroot )
		return $strfullwebroot;
	$strwebroot = str_replace( docroot() ,"", str_replace( "\\", "/", sdkroot() ) );
	$strhttp = isset($_SERVER["HTTPS"]) ? "https://" : "http://";
	$strport = isset($_SERVER["SERVER_PORT"]) ? (":".$_SERVER["SERVER_PORT"]) : "";
	$strfullwebroot = $strhttp . $_SERVER['SERVER_NAME'] . $strport . $strwebroot;
	return( $bfullpath == false ) ? $strwebroot : $strfullwebroot;
} // end webroot()

function exename( $bfullname=true ){ 
	static $strexename = NULL;
	static $strfullexename = NULL;
	if( $strexename && $bfullname == false )
		return $strexename;
	else if( $strfullexename )
		return $strfullexename;
	$strexename = $_SERVER["PHP_SELF"];
	$strhttp = isset($_SERVER["HTTPS"]) ? "https://" : "http://";
	$strport = isset($_SERVER["SERVER_PORT"]) ? (":".$_SERVER["SERVER_PORT"]) : "";
	$strfullexename = $strhttp . $_SERVER['SERVER_NAME'] . $strport . $strexename;
	return ( $bfullname == true ) ? $strfullexename : $strexename;
} // end exename()

/*
function basepath( $strpath=NULL ){
	static $strbasepath="";
	if( $strpath )
		$strbasepath = $strpath;
	return $strbasepath;
} // end basepath()
*/

function relname( $strfilename, $bfullpath=false ){ 
	global $_BASE_PATH;
	$relname = urlpath( $strfilename, $bfullpath );
	if( !$relname )
		$relname = $_BASE_PATH;
	return $relname;
} // end relname()

function absname( $strfilename ){ 
	return urlpath( $strfilename, true );
} // end absname()

function urlfile( $strfilename, $strfilepath = __FILE__ ){
	$dirpath = str_replace("\\","/", dirname( $strfilepath ) );		
	if( file_exists( $dirpath . "/" . $strfilename ) == FALSE ) 
		return "";	
	$urlpath = urlpath( $strfilepath, true );
	return $urlpath . "/" . $strfilename;
} // end urlfile()

function urlpath( $strfilename, $bfullpath=false ){
	$strfilepath = str_replace("\\","/", dirname( $strfilename ));	
	$strdocroot  = docroot();	
	$pos = strpos( $strfilepath, $strdocroot );
	if( $pos === false ) 
		return ""; 		
	$strurlpath = substr( $strfilepath, strlen( $strdocroot ) );
	if( !$bfullpath )
		return $strurlpath;			
	$strhttp = isset($_SERVER["HTTPS"]) ? "https://" : "http://";
	$strport = isset($_SERVER["SERVER_PORT"]) ? (":".$_SERVER["SERVER_PORT"]) : "";
	$strurlpath = $strhttp . $_SERVER['SERVER_NAME'] . $strport . $strurlpath;
	return $strurlpath;
} // end urlpath()

/*
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//------------------------------------------------------------------------------
// name: print*() / alert() / confirm() / console()
// desc: printing methods
//------------------------------------------------------------------------------
function printbr( $str="" ){ 
	_print( $str . "<br />" ); 
} // end printbr()

function println( $str="" ){
	_print( $str . "\n", $strmemid ); 
} // end println()

function printjs( $strjstoprint ){ 
	_print( "<script>$strjstoprint</script>", $strmemid ); 
} // end printjs();

function _print( $str="" ){
	if( isset( $strmemid ) == false || $strmemid=="" )	
		print( $str );
	else _printbuffer( $str );	
} // end print()

function console( $strmessage, $bscript=true ){ 
	if( $bscript ) 
		echo "<script parse=\"false\">"; 
	echo "console.log('{$strmessage}');"; 
	if( $bscript ) 
		echo "</script>"; 
} // end console()

function alert( $strmessage, $bscript=true ){ 
	if( $bscript ) 
		echo "<script parse=\"false\">"; 
	echo "alert('{$strmessage}');"; 
	if( $bscript ) 
		echo "</script>"; 
} // end alert()

function confirm( $strmessage, $strjsyesbody, $strjsnobody, $bscript=true ){ 
	if( $bscript ) 
		echo "<script parse=\"false\">"; 
	echo "if( confirm( '$strmessage' ) == true ) { $strjsyesbody; } else { $strjsnobody; }";
	if( $bscript ) 
		echo "</script>"; 
} // end confirm()

function precode( $str ){
	return "<pre><code>$str</code></pre>";
} // end precode()
*/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//-------------------------------------------------------------------
// name: getTimeInMilliseconds() / getTimeInMicroseconds()
// desc: time - milliseconds / microseconds
//-------------------------------------------------------------------
function getTimeInMicroseconds(){
	return microtime(true);
} // end getCurrentTimeInMicroseconds()

function getTimeInMilliseconds(){ 
	return getTimeInMicroseconds()*1000;
} // end getTimeInMilliseconds()

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//---------------------------------------------------------------
// name: parseInt(), parseFloat(), toString()
// desc: parsing methods
//---------------------------------------------------------------
function parseInt( $str ){ 
	return intval( $str ); 
} // end parseInt()

function parseFloat( $str ){ 
	return floatval( $str );
} // end parseFloat()

function toString( $value ){
	$type = gettype( $value );
	if( $type == "boolean" ) return ( $value ) ? "true" : "false";
	return $value;
} // toString()

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//---------------------------------------------------------------
// name: getImagesFromHTML()
// desc: other methods
//---------------------------------------------------------------
function getImagesFromHTML( $strhtml ){ 
	return ( preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $strhtml, $matches) > 0 ) ? $matches[1] : NULL; 
} // end getImagesFromHTML()

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//------------------------------------------------------------------------------
// name: getClassOf(), getTypeOf(), isFunction(), callFunction()
// desc: info about functions / methods / types / objects / vars / classes
//------------------------------------------------------------------------------
function getClassOf( $mixed ){ 
	return ( gettype($mixed) == "object" ) ? get_class($mixed) : ""; 
} // end getClassOf()

function getTypeOf( $mixed ){ 
	if( $mixed instanceof Closure )
		return "closure";
	if( ($type=gettype( $mixed )) && $type != "string" )
		return $type;	
	if( function_exists( $mixed ) )
		return "function";
	return $type;
} // end getTypeOf()

function isFunction( $mixed ){
	return ( is_callable( $mixed ) );
} // isFunction()

function callFunction( $mixed ){
	if( isFunction( $mixed ) );
} // callFunction()