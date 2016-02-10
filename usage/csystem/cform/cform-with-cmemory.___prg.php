<?php
//---------------------------------------------------------------------------
// name: cformwithcmemory.prg.php
// desc: demonstrates how to use cformwithcmemory program
//---------------------------------------------------------------------------

// includes
include_program( "CFormWithCMemoryProgram" );
include_array_memory("mymemory", "session", $_SESSION );

//---------------------------------------------------
// name: CFormWithCMemoryProgram 
// desc: hello world program
//---------------------------------------------------
class CFormWithCMemoryProgram extends CProgram{
	
	protected $m_cfrom;
	
	public function CFormWithCMemoryProgram(){ 
		parent :: CProgram();	
		$cmemory = use_memory("mymemory");
		$this->m_cform = new CForm();
		$this->m_cform->create("cform-with-cmemory");
		$this->m_cform->setCMemoryId("mymemory");	
		$this->prop("m_cform", $this->m_cform);
		
		$coptions = $this->m_cform->getCOptions();
		if( $coptions == NULL )
			return;
			
		printbr( "User Entered" );
		printbr( "Name: " . $coptions->option("name") );
		printbr( "Desert: " . $coptions->option("desert") );
		printbr( "Toppings: " . (($coptions->option("toppings")) ? "true" : "false") );	
		printbr();
		
		if( $coptions->option("store-name") ){
			$coptions->storeOption("name");	
			alert("stored the name");
		} // end if
		else if( $coptions->option("restore-name") ){
			$coptions->restoreOption("name");	
			alert("restored the name");
		} // end if
		else if( $coptions->option("remove-name") ){
			$coptions->deleteOption("name");	
			alert("deleted the name");
		} // end else
		
		printbr( "CMemory: " . $cmemory->toString() );
		printbr();
	} // end CFormWithCMemoryProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>cform.js</b>" );
	alert("on the js side");
	
SCRIPT;
	} // end c_main()
	
	public function innerhtml(){	
		$ccontrols = $this->m_cform->getCControls();		
		echo $ccontrols->form("fooname","foovalue");
		echo $ccontrols->hidden("cprogramtype","CFormWithCMemoryProgram");
		
		print("Enter your name: ");
		echo $ccontrols->text("name", "");
		echo $ccontrols->text_ex("name", "");
		
		printbr();	
		
		print("Enter your name: ");
		echo $ccontrols->text("name", "");
		
		
		printbr();
			
		printbr();
		printbr("Pick a Desert");
		echo $ccontrols->radio("desert", "icecream");
		printbr(" icecream");
		
		echo $ccontrols->radio("desert", "sorbet");
		printbr(" sorbet");
		
		echo $ccontrols->radio("desert", "yogurt");
		printbr(" yogurt");
		printbr();
		
		print("Do you want toppings? ");
		echo $ccontrols->checkbox("toppings", "toppings");
		printbr();
		printbr();
			
		echo $ccontrols->submit("store-name", "store name");
		echo $ccontrols->submit("remove-name", "remove name");
		echo $ccontrols->submit("restore-name", "restore name");
		printbr();
		
		echo $ccontrols->submit("submit-name", "submit info");
		echo $ccontrols->endform();
		return ob_end();
	} // end innerhtml()
} // end CFormWithCMemoryProgram
?>