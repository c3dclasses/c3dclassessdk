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
	
	// creating the cform
	printbr("CForm");
	var cform = new CForm();
	cform.create("cformprogram-js");	
	printbr(cform.getID());
	printbr();
	
	// using coptions
	printbr("COptions");
	coptions = cform.getCOptions();
	printbr("control1:" + coptions.option("control1"));
	printbr("control2:" + coptions.option("control2"));
	printbr("control3:" + coptions.option("control3"));
	printbr("control4:" + coptions.option("control4"));
	printbr();
	
	// using ccontrols
	printbr("CControls");
	var ccontrols = cform.getCControls();	
	echo(ccontrols.form("form", "myform"));	
	echo(ccontrols.label("control1", "Control1: "));
	echo(ccontrols.text("control1", "This is my Text Control"));
	printbr();
	var id = cform.getID();
	cform.setID("");
	echo(ccontrols.hidden("cprogramtype","CFormProgram"));
	cform.setID(id);
	echo(ccontrols.label("control2", "Control2 with attributes: "));
	ccontrols.set("data-attr1", "value1");
	ccontrols.set("data-attr2", "value2");
	ccontrols.set("data-attr3", "value3");	
	echo(ccontrols.text("control2", "This is my Text Control With Html Attributes"));
	ccontrols.clear(); // clear the attributes
	printbr();
	echo(ccontrols.label("control3", "Control3 radio buttons: "));
	echo(ccontrols.radio("control3","red"));
	echo(ccontrols.radio("control3","green"));
	ccontrols.set("checked", "checked");
	echo(ccontrols.radio("control3","blue"));
	ccontrols.clear(); // clear the attributes
	printbr();
	echo(ccontrols.label("control4", "Control7 select control: "));
	echo(ccontrols.select( "control4", "HELLO3", {"HELLO5":"WORLD5", "HELLO1":"WORLD1","HELLO2":"WORLD2","HELLO3":"WORLD3"}));
	printbr();
	echo(ccontrols.button("control5", "Control5"));		
	printbr();
	echo(ccontrols.submit("control6", "Control6"));
	echo(ccontrols.endform());
	printbr();
SCRIPT;
	} // end c_main()
	
	public function innerhtml(){
ob_start();
	printbr( "<b>cform.php</b>" );
	
	// creating the cform
	printbr("CForm");
	$cform = new CForm();
	$cform->create("cformprogram-php");	
	printbr($cform->getID());
	printbr();
	
	// using options
	printbr("COptions");
	$coptions = $cform->getCOptions();
	printbr("control1:" . $coptions->option("control1"));
	printbr("control2:" . $coptions->option("control2"));
	printbr("control3:" . $coptions->option("control3"));
	printbr("control4:" . $coptions->option("control4"));
	printbr();
	
	// using controls
	printbr("CControls");
	$ccontrols = $cform->getCControls();		
	echo $ccontrols->form("form", "myform");
	echo $ccontrols->label("control1", "Control1: ");
	echo $ccontrols->text("control1", "This is my Text Control");
	printbr();
	$id = $cform->getID();
	$cform->setID("");
	echo $ccontrols->hidden("cprogramtype","CFormProgram");
	$cform->setID($id);
	echo $ccontrols->label("control2", "Control2 with attributes: ");
	$ccontrols->set("data-attr1", "value1");
	$ccontrols->set("data-attr2", "value2");
	$ccontrols->set("data-attr3", "value3");	
	echo $ccontrols->text("control2", "This is my Text Control With Html Attributes");
	$ccontrols->clear(); // clear the attributes
	printbr();
	echo $ccontrols->label("control3", "Control3 radio buttons: ");
	echo $ccontrols->radio("control3","red");
	echo $ccontrols->radio("control3","green");
	$ccontrols->set("checked", "checked");
	echo $ccontrols->radio("control3","blue");
	$ccontrols->clear();
	printbr();
	echo $ccontrols->label("control4","Control4 select control: ");
	echo $ccontrols->select("control4","HELLO3",array("HELLO5"=>"WORLD5","HELLO1"=>"WORLD1","HELLO2"=>"WORLD2","HELLO3"=>"WORLD3") );
	printbr();
	echo $ccontrols->button("control5", "Control5");		
	printbr();
	echo $ccontrols->submit("Control6", "Control6");
	echo $ccontrols->endform();
	printbr();
return ob_end();
	} // end innerhtml()
} // end CFormProgram
?>