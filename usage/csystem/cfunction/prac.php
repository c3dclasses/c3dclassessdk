<?php
//---------------------------------------------------------------------------
// name: cfunction.prg.php
// desc: demonstrates how to use remote variable in your program
//----------------------------------------------------------------------------

if($_REQUEST) {
	// include the bootstrap stuff
	include_once("../../../ccore/ccore.php");
	include_once("../../../csystem/csystem.php");
	$file = $_REQUEST["cfunction_file"];
	$function = $_REQUEST["cfunction_function"];
	$inparams = isset($_REQUEST["cfunction_inparam"]) ? $_REQUEST["cfunction_inparam"] : $_REQUEST;
	$outparams = NULL;
	$file = urldecode($file);
	$function = urldecode($function);
	include_once($file);
	if(function_exists($function)) {
		$_return = call_user_func($function, $inparams);
		echo json_encode($_return->data());
	} // end if
	else echo json_encode($outparams); 
} // end if
?>