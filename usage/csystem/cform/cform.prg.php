<?php
//---------------------------------------------------------------------------
// name: cform.prg.php
// desc: demonstrates how to use cform in a program
//---------------------------------------------------------------------------

// includes
include_program("CFormProgram");

//---------------------------------------------------
// name: CFormProgram 
// desc: demonstrates how to use cform in a program
//---------------------------------------------------
class CFormProgram extends CProgram{
	// constructor
	public function CFormProgram(){ 
		parent :: CProgram();	
	} // end CFormProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>cform.js</b>" );
	var cform = new CForm();
	cform.create("cformprogram-js");	
	var ccontrols = cform.getCControls();		
	echo(ccontrols.label("control1", "Control1: "));
	echo(ccontrols.text("control1", "This is my Text Control"));
	printbr();
	echo(ccontrols.hidden("cprogramtype","CFormProgram"));
	echo(ccontrols.label("control2", "Control2 with attributes: "));
	ccontrols.set("data-attr1", "value1");
	ccontrols.set("data-attr2", "value2");
	ccontrols.set("data-attr3", "value3");	
	echo(ccontrols.text("control2", "This is my Text Control With Html Attributes"));
	ccontrols.clear(); // clear the attributes
	printbr();
	echo(ccontrols.label("control3", "Control6 radio buttons: "));
	echo(ccontrols.radio("control3","red"));
	echo(ccontrols.radio("control3","green"));
	echo(ccontrols.radio("control3","blue"));
	printbr();
	echo(ccontrols.label("control4", "Control7 select control: "));
	echo(ccontrols.select( "control4", "HELLO3", {"HELLO5":"WORLD5", "HELLO1":"WORLD1","HELLO2":"WORLD2","HELLO3":"WORLD3"}));
	printbr();
	echo(ccontrols.button("control5", "Delete Button"));		
	printbr();
	echo(ccontrols.submit("control6", "Submit Button"));
	printbr();
SCRIPT;
	} // end c_main()
	
	public function innerhtml(){
ob_start();
	printbr( "<b>cform.php</b>" );
	$cform = new CForm();
	$cform->create("cformprogram-php");	
	alert($cform->getName());
	
	$ccontrols = $cform->getCControls();		
	echo $ccontrols->label("control1", "Control1: ");
	echo $ccontrols->text("control1", "This is my Text Control");
	printbr();			
	echo $ccontrols->hidden("cprogramtype","CFormProgram");
	echo $ccontrols->label("control2", "Control2 with attributes: ");
	$ccontrols->set("data-attr1", "value1");
	$ccontrols->set("data-attr2", "value2");
	$ccontrols->set("data-attr3", "value3");	
	echo $ccontrols->text("control2", "This is my Text Control With Html Attributes");
	$ccontrols->clear(); // clear the attributes
	printbr();
	echo $ccontrols->label("control3", "Control6 radio buttons: ");
	echo $ccontrols->radio("control3","red");
	echo $ccontrols->radio("control3","green");
	echo $ccontrols->radio("control3","blue");
	printbr();
	echo $ccontrols->label("control4","Control7 select control: ");
	echo $ccontrols->select("control4","HELLO3",array("HELLO5"=>"WORLD5","HELLO1"=>"WORLD1","HELLO2"=>"WORLD2","HELLO3"=>"WORLD3") );
	printbr();
	echo $ccontrols->button("control5", "Delete Button");		
	printbr();
	echo $ccontrols->submit("control6", "Submit Button");
	printbr();
return ob_end();
	} // end innerhtml()
} // end CFormProgram
?>