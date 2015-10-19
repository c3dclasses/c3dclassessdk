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
	
	//_if( function(){ return 1 == 1; }, function(){ 
		//alert("1==1");
		//this._return();
	//})._endif();
	
	_if( function(){ return ( cmemory.data() != null ); }, function(){ 
		printbr( "cmemory = use_memory( cjsonmemory ):");
		printbr( cmemory._toString() );		
		printbr();
		this._return();
	})._else(function(){
		//alert("no memory yet");
	})._endif();

	jQuery("#btn-name").click(function(){ 
		alert("do ajax using cmemory api"); 
		var _return = cmemory.update("name", jQuery("#name").val(), 'string');
	/*	
		_if( _return ) {
			printbr(cmemory._toString());
		}
		_else {
			printbr("waiting for results");
		}
	*/	
		
		_if( function(){ return _return.isdone(); }, function(){ 
			printbr(cmemory._toString());
		})._endif();
	});

SCRIPT;
	} // end c_main()
	
	public function innerhtml(){	
		$ccontrols = $this->m_cform->getCControls();		
		print("Enter your name: ");
		echo $ccontrols->text_ex("name", "");
		return ob_end();
	} // end innerhtml()
} // end CFormWithCMemoryProgram
?>