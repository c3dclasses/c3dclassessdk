//----------------------------------------------------------------
// file: cglobal.js
// desc: global function called throughout the sdk
//----------------------------------------------------------------

//-------------------------------------------------------
// name: filepath(), dirpath(), docroot(), etc
// desc: path / root / filenames
//-------------------------------------------------------
function filepath( strfilepath, brelative ){
} // end filepath()

function dirpath( strpathpath, brelative ){
} // end dirpath()

// returns the path of the document root
function docroot(){	
	//return "NA";
	return CPath._("main");
} // end docroot()

function dirname( path ){
	return path.replace(/\\/g, '/').replace(/\/[^\/]*\/?$/, '');;
} // end dirname()

// returns the path of the c3dclassessdk path
function sdkroot(){ 
	return "NA";
} // end sdkroot()

// returns the path of the webroot or docroot
function webroot( bfullpath ){ 
	return "NA";
} // end webroot()

function exename(){
	return document.URL;
} // end exename()

// returns the relative url path of the file
function relname( strfilename, bfullpath ){ 
	return dirname( strfilename )
	//return urlpath( strfilename, bfullpath );
} // end relname()

// returns the absolute url path of the file
function absname( strfilename ){ 
	return urlpath( strfilename, true );
} // end absname()

// returns the url and the filename
function urlfile( strfilename, strfilepath ){
	return strfilepath + "/" + strfilename;
} // end fileurl()

// returns the absolute url path or absolute url path if true
function urlpath( strfilename, bfullpath ){
	return "NA";
} // end urlpath();

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//------------------------------------------------------------------------------
// name: print*() / alert() / confirm() / console()
// desc: printing methods
//------------------------------------------------------------------------------
function printbr( str, dst ){
	if( !str && isNaN( str ) ) 
		str=""; 
	_print( str + "<br />", dst ); 
} // end printbr()

function println( str, dst ){ 
	if( !str && isNaN( str ) )
		str=""; 
	_print( str + "\n", dst ); 
} // end println()

function _print( str, dst ){ 
	if( !str && isNaN( str ) ) 
		str=""; 
	if( !dst ){ 
		//document.write( document.body.innerHTML + str ); 
		//document.body.innerHTML += str; 
		dst = "#ckernal-output";
		//return; 
	} // end if	
	
	if( CObqueue != null && CObqueue.m_bstart == true ){
		CObqueue.m_buffer += str
		return;
	} // end if
	
	var node = jQuery(dst);
	node.html(node.html()+str); 
	return; 
} // end _print();

function print_r( mixed, btostring, dst ){ 
	var str = dump( mixed ); 
	if( btostring ) 
		return str;
	return _print( str, dst );
} // end print_r()

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//-------------------------------------------------------------------
// name: getTimeInMilliseconds() / getTimeInMicroseconds()
// desc: time - milliseconds / microseconds
//-------------------------------------------------------------------
function getTimeInMilliseconds(){ 
	return new Date().getTime(); 
} // end getCurrentTimeInMicroseconds()

function getTimeInMicroseconds(){ 
	return new Date().getTime(); 
} // end getCurrentTimeInMicroseconds()

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//---------------------------------------------------------------
// name: parseInt(), parseFloat(), toString()
// desc: parsing methods
//---------------------------------------------------------------

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//---------------------------------------------------------------
// name: getImagesFromHTML()
// desc: other methods
//---------------------------------------------------------------

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//------------------------------------------------------------------------------
// name: getClassOf(), getTypeOf(), isFunction(), callFunction()
// desc: info about functions / methods / types / objects / vars / classes
//------------------------------------------------------------------------------
function getTypeOf( mixed ){
	return typeof mixed;
} // end getType()

function getClassOf( mixed ){ 
	return ( getTypeOf(mixed) == "object" ) ? mixed.constructor : ""; 
} // end getClass()

function isFunction( mixed ){
	return ( typeof( mixed ) == "function" ); 
} // end isFunction()

function callFunction( mixed ){
	if( isFunction( $mixed ) );
} // end callFunction()