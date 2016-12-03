<?php
//---------------------------------------------------------------------------
// name: cparse.prg.php
// desc: demonstrates how to use cparse methods 
//---------------------------------------------------------------------------

// includes
include_program( "CParseProgram" );

//---------------------------------------------------
// name: CParseProgram
// desc: hello world program
//---------------------------------------------------
class CParseProgram extends CProgram{
	// constructorobj
	public function CParseProgram(){ 
		parent :: CProgram();	
	} // end CParseProgram()
	
	public function c_main(){
return <<<SCRIPT
	_print("<h1>cparse.js</h1>");
	printbr("CParse.toInt(\"100\") + 3 = " + (CParse.toInt("100") + 3));
	printbr("CParse.toFloat(\"100.05\") + 3 = " + (CParse.toFloat("100.05") + 3));
	printbr("CParse.toString(true) = " + CParse.toString(true));
	printbr("CParse.toString(false) = " + CParse.toString(false));
	
	var jsonobj = {name1:"value1",name2:"value2",name3:"value3"};
	_print("CParse.toJSONString(");
	print_r(jsonobj);
	_print(") = ")
	printbr(CParse.toJSONString(jsonobj));
	
	var jsonstring = CParse.toJSONString(jsonobj);
	_print("CParse.toJSONObject(");
	_print(jsonstring);
	_print(") = ");
	print_r(CParse.toJSONObject(jsonstring));
	printbr();
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){			
ob_start();
	print("<h1>cparse.php</h1>");
	printbr("CParse::toInt(\"100\") + 3 = " . (CParse::toInt("100") + 3));
	printbr("CParse::toFloat(\"100.05\") + 3 = " . (CParse::toFloat("100.05") + 3));
	printbr("CParse::toString(true) = " . CParse::toString(true));
	printbr("CParse::toString(false) = " . CParse::toString(false));
	
	$jsonobj = array("name1"=>"value1","name2"=>"value2","name3"=>"value3");
	_print("CParse::toJSONString(");
	print_r($jsonobj);
	_print(") = ");
	printbr(CParse::toJSONString($jsonobj));
	
	$jsonstring = CParse::toJSONString($jsonobj);
	print("CParse::toJSONObject(");
	print($jsonstring);
	print(") = ");
	print_r(CParse::toJSONObject($jsonstring));
	printbr();
return ob_end();
	} // end innerhtml()
} // end CParseProgram
?>