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

	jQuery(".ccontrol-crud").click(function(){ 
		var btn = jQuery(this);
		var name = btn.attr("data-name");
		var ctrl = jQuery("#"+name); 
		var action = btn.attr("data-action");
		var type = btn.attr("data-type");
		var data = ctrl.val();
		alert(action); 
	
		var creturn = cmemory[action](name, data, type);		
		if( creturn ){
			_if( function(){ return creturn.isdone(); }, function(){ 
				if( action == "retrieve" ){
					var data = creturn.data();
					console.log(data);
					data = jQuery.parseJSON(data[0].m_jsondata);
					ctrl.val(data.m_value);
				} // end if
				else if(action == "delete"){
					ctrl.val("");
				} // end else if
				printbr(cmemory._toString());
				alert("done");
			})._endif();
		} // end if
	});

SCRIPT;
	} // end c_main()
	
	public function innerhtml(){	
		$ccontrols = $this->m_cform->getCControls();		
		print("Enter your name: ");
		
		$ccontrols->set("data-foo","this is my attribute");
		echo $ccontrols->text("name", "");
		echo $ccontrols->crud("name", "");
		
		return ob_end();
	} // end innerhtml()
} // end CFormWithCMemoryProgram
?>