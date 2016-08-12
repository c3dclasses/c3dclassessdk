//----------------------------------------------------
// file: cincludejsfiles.js
// desc: includes a js file within a javascript file
//----------------------------------------------------

//-------------------------------------------------------------------
// name: include_js()
// desc: includes a js file within the html document dynamically
//-------------------------------------------------------------------
function include_js( strjsurl, fnloadcallback ){
	if( strjsurl == "" || strjsurl == null )
		return false;	
	var head = document.getElementsByTagName('head')[0];
   	var script = document.createElement("script");	
	if( !head || !script )
		return false;
	script.type = "text/javascript";
	script.src = strjsurl;		// the script will automatically be downloaded and executed
   	// script.onreadystatechange = fncallback;
   	// script.onload = fncallback
	head.appendChild(script);
	return true;
} // include_js()

//-------------------------------------------------------------------
// name: defaultcallback()
// desc: defines a default callback function for below
//-------------------------------------------------------------------
function defaultcallback(){
} // end defaultcallback()