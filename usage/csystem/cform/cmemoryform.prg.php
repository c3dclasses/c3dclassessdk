<?php
//---------------------------------------------------------------------------
// name: cmemoryform.prg.php
// desc: demonstrates how to use cmemoryform program
//---------------------------------------------------------------------------

// includes
include_program("CMemoryFormProgram");
include_memory("cmemoryform", dirname(__FILE__) . "/cmemoryform.json", "CJSONMemory", array("client"=>true));

//---------------------------------------------------
// name: CMemoryFormProgram 
// desc: hello world program
//---------------------------------------------------
class CMemoryFormProgram extends CProgram{
	public function CMemoryFormProgram(){ 
		parent :: CProgram();	
	} // end CMemoryFormProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr("<b>cmemoryform.js</b>");

	// cform
	var cform = new CForm();
	cform.create("cmemoryform-js");
		
	// coptions
	coptions = cform.getCOptions();
	if( coptions == null )
		return;
	cform.setCMemoryID("cmemoryform");
	printbr("control1: " + coptions.option("control1"));
	printbr("control2: " + coptions.option("control2"));
	cform.setCMemoryID("");
	printbr("control3: " + (coptions.option("control3") ? "true" : "false"));	
	printbr();
	
	// cmemory
	cmemoryid = "cmemoryform";
	cmemory = use_memory(cmemoryid);
	printbr(cmemoryid);
	printbr(cmemory._toString());
	printbr();
	printbr("crequestmemory")
	printbr(use_memory("crequestmemory")._toString());
	printbr();
		
	// ccontrols
	ccontrols = cform.getCControls();		
	echo(ccontrols.form("form1","form1value"));
	
	// unbounded ccontrols
	var id = cform.getID();
	cform.setID("");
	echo(ccontrols.hidden("cprogramtype","CMemoryFormProgram"));
	cform.setID(id);
	
	// binded ccontrols
	cform.setCMemoryID("cmemoryform");
	echo(ccontrols.label("control1", "control1: "));
	printbr(ccontrols.text("control1", ""));
	echo(ccontrols.label("control2", "control2-a: "));
	printbr(ccontrols.radio("control2", "cmemory-control2-v1"));
	echo(ccontrols.label("control2", "control2-b: "));
	printbr(ccontrols.radio("control2", "cmemory-control2-v2"));
	cform.setCMemoryID("");
	
	// unbinded ccontrols
	echo(ccontrols.label("control3", "control3: "));
	printbr(ccontrols.checkbox("control3", "control3"));
	printbr(ccontrols.submit("control4", "control4"));
	printbr(ccontrols.endform());
	
SCRIPT;
	} // end c_main()
	
	public function innerhtml(){	
		printbr("<b>cmemoryform.php</b>");	
		
		// cform
		$cform = new CForm();
		$cform->create("cmemoryform-php");
		
		// coptions
		$coptions = $cform->getCOptions();
		if( $coptions == NULL )
			return;
		$cform->setCMemoryID("cmemoryform");
		printbr("control1: " . $coptions->option("control1"));
		printbr("control2: " . $coptions->option("control2"));
		$cform->setCMemoryID("");
		printbr("control3: " . (($coptions->option("control3")) ? "true" : "false"));	
		printbr();
		
		// cmemory
		$cmemoryid = "cmemoryform";
		$cmemory = use_memory($cmemoryid);
		printbr("$cmemoryid:");
		printbr($cmemory->toString());
		printbr();
		printbr("crequestmemory:");
		printbr(use_memory("crequestmemory")->toString());
		printbr();
		
		// ccontrols
		$ccontrols = $cform->getCControls();		
		echo $ccontrols->form("form1","form1value");
		
		// unbounded ccontrols
		$id = $cform->getID();
		$cform->setID("");
		echo $ccontrols->hidden("cprogramtype","CMemoryFormProgram");
		$cform->setID($id);
		
		// binded ccontrols
		$cform->setCMemoryID("cmemoryform");
		echo $ccontrols->label("control1", "control1: ");
		printbr($ccontrols->text("control1", ""));
		echo $ccontrols->label("control2", "control2-a: ");
		printbr($ccontrols->radio("control2", "cmemory-control2-v1"));
		echo $ccontrols->label("control2", "control2-b: ");
		printbr($ccontrols->radio("control2", "cmemory-control2-v2"));
		$cform->setCMemoryID("");
		
		// unbinded ccontrols
		echo $ccontrols->label("control3", "control3: ");
		printbr($ccontrols->checkbox("control3", "control3"));
		printbr($ccontrols->submit("control4", "control4"));
		printbr($ccontrols->endform());
		
		return ob_end();
	} // end innerhtml()
} // end CMemoryFormProgram
?>