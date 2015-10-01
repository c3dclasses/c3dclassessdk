<?php
//-----------------------------------------------------------------------------------------
// file: cpath.drv.php
// desc: defines a class that store path information used globally throughout the sdk
//-----------------------------------------------------------------------------------------

//----------------------------------------------------------------------
// name: CPath_Section()
// desc: 
//----------------------------------------------------------------------
function CPath_Section(){
	// filter out paths to show on client
	if( !CPath :: $m_chashpath )
		return "";
	$pathparams = CPath :: $m_chashpath->valueOf();
	if( $pathparams )
		return "";
	$filterpathparams = NULL;
	foreach( $pathparams as $key=>$params ){
		if( isset($params["client"]) && strtolower($params["client"]) == "false" )
			continue;
		$filterpathparams[$key]=$params;
	} // end foreach()
	$paths = json_encode( $filterpathparams );
$str = <<<SCRIPT
// BEGIN - CPath section
try{ CPath.m_chashpath.merge($paths); } catch(e){}
// END - CPath section
SCRIPT;
	$str .= "\n";
	return $str;
} // end CPath_Section()
CHook :: add( "script", "CPath_Section" );	// put the code in the footer 
//CHook :: add( "fscript", "CPath_Section" );	// put the code in the footer 
?>