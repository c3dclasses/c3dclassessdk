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
	return (path) ? path.replace( /\\/g, '/' ).replace( /\/[^\/]*$/, '' ) : "";
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
	if( isFunction( mixed ) );
} // end callFunction()

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//-----------------------------------------------------------------
// name: buildHTMLTag*()
// desc: helper functions
//-----------------------------------------------------------------
function buildHTMLTag( strtagname, attributes, bmultitag, strbody ){
	var strattributes="";
	if( attributes != null )
		for(name in attributes) {
			var value = attributes[name];
			strattributes += name + '="' + value + '" ';
		} // end for
	var str = "<"+strtagname+" "+strattributes; 
	str += ( bmultitag ) ? ">"+strbody+"</"+strtagname+">" : "/>";
	return str;
} // end buildHTMLTag()

function buildHTMLOpenTag( strtagname, attributes ){
	var strattributes="";
	for( name in attributes ) {
		var value = attributes[name];
		strattributes += name + '="' + value + '" ';
	} // end for
	var str = "<"+strtagname+" "+strattributes+">"; 
	return str;	
} // end buildHTMLOpenTag()

function buildHTMLCloseTag( strtagname ){
	return "</"+strtagname+ ">";
} // buildHTMLClosingTag()