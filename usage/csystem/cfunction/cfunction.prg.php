<?php
//---------------------------------------------------------------------------
// name: cfunction.prg.php
// desc: demonstrates how to use remote variable in your program
//---------------------------------------------------------------------------

// includes
include_program("CFunctionProgram");
include_function("testfn", "testfunction", NULL, NULL, NULL);
include_function("testremotefn", "testfunction2", "http://localhost/usage/csystem/cfunction/prac.php",
__FILE__,NULL);

//--------------------------------------------
// name: CFunctionProgram
// desc: hello world program
//--------------------------------------------
class CFunctionProgram extends CProgram{
	public function CFunctionProgram(){ 
		parent :: CProgram();	
	} // end CFunctionProgram()
	
	public function c_main(){
return <<<SCRIPT
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	$ret = use_function("testfn")->call("bye");
	printbr("use_function(\"testfn\")->call(\"bye\") = " . $ret->data());
	$ret = use_function("testremotefn")->call(array("param1"=>"value1"));
	printbr("use_function(\"testremotefn\")->call(\"byefhjkfhks\") = " . print_r($ret->data(),true));
return ob_end();
	} // end innerhtml()
} // end CFunctionProgram

function testfunction($param) {
	return _return_done($param . ", world");
} // end testfunction()

function testfunction2($params) {
	return _return_done($params);
} // end testfunction()

?>