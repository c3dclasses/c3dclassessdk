<?php
//---------------------------------------------------------------------------
// name: cfunction.prg.php
// desc: demonstrates how to use remote variable in your program
//---------------------------------------------------------------------------

// includes
include_program("CFunctionProgram");
include_function("testfn", "testfunction", NULL, NULL, NULL);
include_function("testremotefn", 	// identifier
	"testfunction2", 	// function to call
	//relname(CPath._("CFunctionDriver_Path"))
	"http://localhost/ccore/cfunction/cfunction.drv.php", // function driver uri
	__FILE__, 	// the file the function is in - this file
	NULL
);

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
	printbr("<b>cfunction.js</b>");
	/*
	include_function("testremotefn", "testfunction2", "http://localhost/csystem/cfunction/cfunction.drv.php",
	this.__FILE__,null);
	var _return = use_function("testremotefn").call({"param1":"value1","param2":"value2"});
	
	_if(function(){return _return.isdone(); }, function(){
		printbr("use_function(\"testremotefn\")->call(\"{\"param1\"=>\"value1\"}\") = " + print_r(_return.data(),true));
	})._endif();
	*/
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>cfunction.php</b>");
	
	printbr("<b>local function</b>");
	$ret = use_function("testfn")->call("bye");
	printbr("use_function(\"testfn\")->call(\"bye\") = " . $ret->data());
	
	printbr("<b>remote function</b>");
	$ret = use_function("testremotefn")->call(array("param1"=>"value1"));
	printbr("use_function(\"testremotefn\")->call(\"byefhjkfhks\") = " . print_r($ret->data(), true));
	// set some params before calling
	// $fn->timeout(3);
	// $fn->retry(2);
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