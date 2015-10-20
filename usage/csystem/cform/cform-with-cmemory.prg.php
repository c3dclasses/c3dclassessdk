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

	jQuery("#btn-name-create").click(function(){ 
		alert("creating the name"); 
		var name = jQuery(this).attr("data-name");
		var creturn = cmemory.create( name, jQuery("#"+name).val(), "string" );
		if( creturn ){
			_if( function(){ return creturn.isdone() }, function(){
				alert("created the name");
				printbr(cmemory._toString());
				this._return();
			})._endif();
		} // end if
	});


	jQuery("#btn-name-retrieve").click(function(){ 
		alert("retrieving the name"); 
		var name = jQuery(this).attr("data-name");
		var creturn = cmemory.retrieve(name);		
		if( creturn ){
			_if( function(){ return creturn.isdone(); }, function(){ 
				alert("retrieved the name");
				printbr(cmemory._toString());
			})._endif();
		} // end if
	});

	/*
	jQuery("#btn-name-update").click(function(){ 
		alert("updating the name"); 
		var _return = cmemory.update("name", jQuery("#name").val(), 'string');		
		_if( function(){ return _return.isdone(); }, function(){ 
			alert("deleted the name");
				printbr(cmemory._toString());
			print_r(_return.data()[0]);
		})._endif();
	});*/

	jQuery("#btn-name-delete").click(function(){ 
		alert("deleting the name"); 
		var name = jQuery(this).attr("data-name");
		var creturn = cmemory.delete(name);
		if( creturn ){
			_if( function(){ return creturn.isdone(); }, function(){
				alert("deleted the name");
				printbr(cmemory._toString());
				this._return();
			})._endif(); // end _if
		} // end if
		else alert("does not exist in memory");			
	});	 // end jQuery()


SCRIPT;
	} // end c_main()
	
	public function innerhtml(){	
		$ccontrols = $this->m_cform->getCControls();		
		print("Enter your name: ");
		
		$ccontrols->set("data-foo","this is my attribute");
		echo $ccontrols->text_ex("name", "");
		return ob_end();
	} // end innerhtml()
} // end CFormWithCMemoryProgram
?>