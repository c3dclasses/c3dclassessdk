//----------------------------------------------------
// file: cincludecssfiles.drv.js
// desc: manipulates css file from the clientside 
//----------------------------------------------------

//-------------------------------------------------------------------
// name: include_css()
// desc: includes a css file within the html document dynamically
//-------------------------------------------------------------------
function include_css( strcssurl ){
	if( strcssurl == "" || strcssurl == null )
		return false;
	var head = document.getElementsByTagName('head')[0];
   	var css = document.createElement("link");	
	if( !head || !css )
		return false;
	css.rel = "stylesheet";
	css.type= "text/css" 
	css.media= "all" 
	css.href = strcssurl;	
	head.appendChild(css);
	return true;
} // include_css()