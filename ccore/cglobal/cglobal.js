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
/*
function dirname( path ){
	return path.replace(/\\/g, '/').replace(/\/[^\/]*\/?/, '');
} // end dirname()
*/

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
	
	if(ob_started) {
		ob_output += str;
		return;
	} // end if
	
	if(!dst){ 
		dst = "#ckernal-output";
		if(CThread.m_objcontext_cur) 
			dst = CThread.m_objcontext_cur.jq();
		else if( CThread.m_cthread_cur && CThread.m_cthread_cur.m_objcontext)
			dst = CThread.m_cthread_cur.m_objcontext.jq();
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

function echo( str, dst ) {
	_print(str,dst);
} // end echo()

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
	if( isFunction( mixed ) );
} // end callFunction()



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

//--------------------------------------------
// name: ob_start()
// desc: start sending output to a buffer
//--------------------------------------------
var ob_start_stack = [];
var ob_output = "";
var ob_started = false;
function ob_start() {
	if(ob_output) {
		ob_start_stack.push(ob_output);
		ob_output="";
	} // end if
	ob_started = true;
	return;
} // end ob_start()

//---------------------------------------
// name: ob_end()
// desc: returns the accumulated output
//---------------------------------------
function ob_end() {
	var ret = ob_output;
	if(ob_start_stack.length > 0)
		ob_output=ob_start_stack.pop();
	else ob_started = false;
	return ret;
} // end ob_end()

//--------------------------------------------
// name: ob_end_queue()
// desc: dumps the output contents to a queue
//--------------------------------------------
var ob_queues = {};
function ob_end_queue(queueid){
	if( !ob_queues[queueid] )
		ob_queues[queueid] = "";
	ob_queues[queueid] += ob_end();
} // end ob_end_queue()

//--------------------------------------------------------------
// name: ob_queue_dump()
// desc: dumps the contents of the queue
//--------------------------------------------------------------
function ob_queue_dump( strid ){
	return (!strid || !ob_queues[strid])  ? "" : !ob_queues[strid];	
} // end ob_queue_dump()