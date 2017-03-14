<?php
//-------------------------------------------------
// name: cincludeif.php
// desc: includes a file if a parameter is set
//-------------------------------------------------

//-------------------------------------------------------------------------------------------
// name: include_if() 
// desc: include file(s) if param(s) are set
// usage:
//	 	1.) include_if(array($_REQUEST["A"],$_REQUEST["A"],$_REQUEST["A"]), "file.php")
//		2.) include_if($_REQUEST["A"], array("file1.php","file2.php","file3.php"))
//-------------------------------------------------------------------------------------------
function include_if($params, $files) {
	if(!$params || !$files)
		return false;
	
	// build array structure
	if(gettype($params) != "array")
		$params = array($params);
	if(gettype($files) != "array")
		$files = array($files);
	
	// check if the params are set
	$len = count($params);
	for($i=0; $i<$len; $i++)
		if(!$params[$i] && isset($params[$i]))
			return false;	
	
	// include the files
	$len = count($files);
	for($i=0; $i<$len; $i++)
		include_once($files[$i]);
		
	return true;
} // include_if() 
?>