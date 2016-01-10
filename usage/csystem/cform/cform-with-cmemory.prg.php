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
		$cmemory = use_memory("cjsonmemory");
		$this->m_cform = new CForm();
		$this->m_cform->create("cform-with-cmemory");
		$this->m_cform->setCMemoryId("cjsonmemory");	
		$this->prop("m_cform", $this->m_cform);
		$coptions = $this->m_cform->getCOptions();
		if( $coptions == NULL )
			return;
		printbr( "User Entered" );
		printbr( "Name: " . $coptions->option("name") );
	} // end CFormWithCMemoryProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr("cform-with-cmemory.js");
	var cmemory = use_memory( "cjsonmemory" );
	if( !cmemory ){
		alert("cmemory is not availiable");
		return;
	}
	
	_if( function(){ return ( cmemory.data() != null ); }, function(){ 
		printbr( "cmemory = use_memory(cjsonmemory):");
		printbr( cmemory._toString() );		
		printbr();
		this._return();
	})._endif();
	
	CControls.doCRUD(cmemory);
SCRIPT;
	} // end c_main()
	
	public function innerhtml(){	
		ob_start();
		
		$ccontrols = $this->m_cform->getCControls();		
		print("Enter your name: ");
		
		$ccontrols->set("data-cmemory", "cjsonmemory");
		$ccontrols->set("data-foo","this is my attribute");
		echo $ccontrols->label("name","text");
		echo $ccontrols->text("name", "");
		echo $ccontrols->crud("name", "");
		printbr();
		
		echo $ccontrols->label("name2","text");
		echo $ccontrols->textarea("name2", "");
		echo $ccontrols->crud("name2", "");
		printbr();
		
		echo $ccontrols->label("fruit","fruit - apple");
		echo $ccontrols->checkbox("fruit", "apple");
		echo $ccontrols->crud("fruit", "");
		printbr();
		
		echo $ccontrols->label("veges","veges");
		echo $ccontrols->radio("veges", "carrots");
		echo $ccontrols->radio("veges", "spanich");
		echo $ccontrols->radio("veges", "tomatoe");
		echo $ccontrols->crud("veges", "");
		
		printbr();
		echo $ccontrols->label("colors", "select");
		echo $ccontrols->select("colors", "RED", array( "RED"=>"red", "GREEN"=>"green", "BLUE"=>"blue"));
		echo $ccontrols->crud("colors", "");
		
		printbr();
		echo $ccontrols->label("group", "");
		echo $ccontrols->form("group");
		echo $ccontrols->select("colors", "RED", array( "RED"=>"red", "GREEN"=>"green", "BLUE"=>"blue"));
		echo $ccontrols->textarea("name55", "");
		echo $ccontrols->submit("hello","hello");
		echo $ccontrols->radio("race", "black");
		echo $ccontrols->radio("race", "white");
		echo $ccontrols->radio("race", "other");
		echo $ccontrols->endform();
		echo $ccontrols->crud("group", "");
		
		return ob_end();
	} // end innerhtml()
} // end CFormWithCMemoryProgram
?>