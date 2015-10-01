<?php
//-------------------------------------------------------------------------
// file: optimize_tag.php
// desc: defines useful methods used to optimize tags in an html content
//-------------------------------------------------------------------------

//------------------------------------------------------------------------------
// name: optimize_tags()
// desc: takes an unoptimized string of script tags with code and/or references 
//	 returns a string containing a single tag the refences a file containing 
//       optimized code
//------------------------------------------------------------------------------
function optimize_tags( $strhtml, $strcallbacks=NULL, $params=NULL ){
	if( !$strhtml || 
		!($dom = new DOMDocument()) || 
		!($dom->loadHTML($strhtml)) )
		return $strhtml;
	
	// get the optimized nodes and insert them into dom
	foreach( $strcallbacks as $callback ){
		if( $callback && function_exists( $callback ) )
			$node = $callback( $dom );
	} // end foreach()
	
	// get the element to return
	$element = NULL;
	if( $params && isset($params["root_tag"]) )
		if( !($element = $dom->getElementsByTagName( $params["root_element"] ) ) )
			return $strhtml;
	return $dom->saveHTML( $element );	
} // end optimize_tags()

//----------------------------------------------------------------------------------------------------------
// name: optimize_script_tag()
// desc: returns a script node pointing to a file containing the optimized(minimized/combined) contents
//----------------------------------------------------------------------------------------------------------
function optimize_script_tag( $dom ){
	if( !$dom )
		return NULL;
	
	
	$scripts = getResources($dom, "script", "src");
	if( file_exists( dirname(__FILE__) . "/script-{$strname}-min.js" ) == FALSE && $scripts != NULL ){
		$file = fopen( dirname(__FILE__) . "/script-{$strname}-min.js", "w" );
		$strcontent = combine( $scripts );
		fwrite( $file, $strcontent );
		fclose( $file );		
	} // end if
	if( ( $node = $dom->createElement( "script" ) ) == NULL )
		return NULL;
	$node->setAttribute("src", "http://culturesoflove.com/wp-content/themes/maya/custom/script-{$strname}-min.js" );
	$node->setAttribute( "type", "text/javascript");
	return $node;
} // end getScriptResources()

?>