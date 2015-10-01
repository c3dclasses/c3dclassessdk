<?php 
//--------------------------------------------------
// name: cincludefiles.drv.php
// desc: defines a file resources
//--------------------------------------------------

function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}
function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || strpos($haystack, $needle, strlen($haystack) - strlen($needle)) !== FALSE;
}

//////////////////////////////////////
// performs the minification

function CIncludeFiles_minify( $infilepathparams, $filetype="css", $location="head" ){
	// check if the minify path exist - usually set where kernal was instantiated
	$strminpath = CPath :: _( "cincludefiles.min.path" );
	if( $strminpath == "" || $strminpath == NULL  )
		return $infilepathparams;
		
	// minify the files 
	$outfilepathparams=NULL;
	$minifyfiles=NULL;
	foreach($infilepathparams as $strfilename=>$params){
		if(startsWith($strfilename,"//")==false && startsWith($strfilename,"http")==false && isset($params["no-minify"])==false ) // files to minify
			$minifyfiles[] = $strfilename; 
		else $outfilepathparams[] = $params; // files to include
	} // end for
		
	// set the minified absolute and relative file name
	$strabsminfile = $strminpath . "/cincludefiles.min." . $filetype;
	$strrelminfile = relname( $strabsminfile ) . "/cincludefiles.min." . $filetype;
	
	// minify the files to a single file
	if( CMinify :: filesToFile( $minifyfiles, $strabsminfile ) ){
		// include the minified file
		$outfilepathparams[] = array( "filename"=>( $strrelminfile ) );
	} // end if
	return $outfilepathparams;
} // end CIncludeFiles_minify()
	

//////////////////////////////////////////////////////////
// CIncludeJSFiles_toString() / PHP <=> HTML, CSS, JS

function CIncludeJSFilesHead_toString(){
	$cincludefiles = CIncludeFiles :: getCIncludeFiles( "CIncludeJSFiles" );
	if( $cincludefiles == NULL )
		return "";
	$filepathparams = $cincludefiles->getFilePathParams();
	if( $filepathparams == NULL )
		return "";	
	$filepathparams = CIncludeFiles_minify( $filepathparams, "js" );
	$str="";
	foreach( $filepathparams as $strfilename=>$params ){
		if( isset($params["location"]) == false || $params["location"] != "foot" )  
			$str .= toJSString( $params ); 
	} // end foreach()
	return $str;
} // end CIncludeJSFilesHead_toString()

function CIncludeJSFilesFoot_toString(){
	$cincludefiles = CIncludeFiles :: getCIncludeFiles( "CIncludeJSFiles" );
	if( $cincludefiles == NULL )
		return "";
	$filepathparams = $cincludefiles->getFilePathParams();
	if( $filepathparams == NULL )
		return "";
	$str="";
	foreach( $filepathparams as $strfilename=>$params ){
		if( isset($params["location"]) && strtolower($params["location"]) == "foot" ){
			$str .= toJSString( $params ); 
		} // end if
	} // end foreach()
	return $str;
} // end CIncludeJSFilesFoot_toString()

function CIncludeCSSFiles_toString(){
	$cincludefiles = CIncludeFiles :: getCIncludeFiles( "CIncludeCSSFiles" );
	if( $cincludefiles == NULL )
		return "";
	$filepathparams = $cincludefiles->getFilePathParams();
	if( $filepathparams == NULL )
		return "";
	$filepathparams = CIncludeFiles_minify( $filepathparams, "css" );
	$str="";
	foreach( $filepathparams as $strfilename=>$params )
		$str .= toCSSString( $params ); 
	return $str; //toHTMLString( $str, "CSS" );
} // end CIncludeCSSFiles_toString()

function CIncludeFontFiles_toString(){
	$cincludefiles = CIncludeFiles :: getCIncludeFiles( "CIncludeFontFiles" );
	if( $cincludefiles == NULL )
		return "";
	$str = "<style>\n";	
	$fontparams = $cincludefiles->getFilePathParams();
	foreach( $fontparams as $strfontname=>$params )
		$str .= toFontString( $params ) . "\n"; 
	$str .= "</style>\n";
	return $str;
} // end CIncludeFontFiles_toString()

/////////////////////////////////////////////////////
// toString() Javascript, CSS, HTML methods

function toJSString( $params ){
	if( isset( $params["filename"] ) == false /*|| isset( $params["implements"] ) == true*/ )
		return "";
	$strfilename = $params["filename"];
	$condition = ($params && isset( $params['condition'] )) ? $params['condition'] : NULL;
	if( !$condition ) 
		return "<script type=\"text/javascript\" src=\"{$strfilename}\"></script>\n";
	else{
		$jsonparams = json_encode( $params );
		return "<script>if({$condition})\ninclude_js(\"{$strfilename}\",{$jsonparams});</script>\n";
	} // end else
} // end toJSString()

function toCSSString( $params ){
	$strfilename = $params["filename"];
	return "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"{$strfilename}\" />";
} // end toCSSString()

function toHTMLString( $str, $label ){
	return <<<CSS
<!-- CInclude BEGIN include $label files -->
$str
<!-- CInclude END include $label files -->
CSS;
} // end toHTMLString()

function toFontString( $params ){
	$strfontfamily = $params["filename"];
	$strsrc = NULL;
	if( gettype( $params["src"] ) == "array" ){
		foreach( $params["src"] as $params )
			$strsrc[] = "url('".$params['url']."') format('".$params['format']."')";
		$strsrc = implode(",", $strsrc );	
	} // end if
	else{ 
	 	$strsrc = $params["src"];
		$strsrc = "url('$strsrc')";
	} // end else
	return <<<CSS
@font-face {
	font-family: '$strfontfamily';
  	src: $strsrc;
}
CSS;
} // end toCSSString()

////////////////////////////////////////////
// hooks
CHook :: add( "head", "CIncludeFontFiles_toString" );
CHook :: add( "head", "CIncludeCSSFiles_toString" );
CHook :: add( "head", "CIncludeJSFilesHead_toString" );
CHook :: add( "foot", "CIncludeJSFilesFoot_toString" );
