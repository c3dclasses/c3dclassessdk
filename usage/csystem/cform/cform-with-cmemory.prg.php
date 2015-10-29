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
		var action = btn.attr("data-action");		
		var ctrl = jQuery("#"+name); 	
		
		if (!ctrl)
			return;
		
		var type = ctrl.attr("type");
		if (type == "checkbox" || type == "radio") { 
			// get the control that's checked
			ctrl = jQuery('input[name='+name+']:checked');
		} // end if
		
		// get the data for the control	
		var data = ctrl.val();
		if (!data) {
			data="";
		} // end if
		
		// if checkbox or radio box - get selected value 
		//if(type == "checkbox" || type == "radio"){
		//	ctrl = jQuery('input[name='+name+']:checked');
		//	data = ctrl.val();
		//	if( data == undefined )
		//		data = "";
		//	alert(data);
		//}
		
		//	var data = ctrl.selected().value();
	
		var creturn = cmemory[action](name, data, "string");		
		if(creturn) {
			_if( function(){ return creturn.isdone(); }, function(){ 
				if( action == "retrieve" ){
					var data = creturn.data();
					console.log(data);
					data = jQuery.parseJSON(data[0].m_jsondata);
					ctrl.val(data.m_value);
					
					// if this is a checkbox or radio box make it selected
					if(type == "radio" || type == "checkbox"){
						ctrl = jQuery('input[value='+data.m_value+']');
						ctrl.prop("checked",true);
					} // end if
					
				} // end if
				else if(action == "delete"){
					ctrl.val("");
				} // end else if
				printbr(cmemory._toString());
				alert("done");
			})._endif();
		} // end if
	});

//alert(type);
		//var type = btn.attr("data-type");

SCRIPT;
	} // end c_main()
	
	public function innerhtml(){	
		$ccontrols = $this->m_cform->getCControls();		
		print("Enter your name: ");
		
		$ccontrols->set("data-foo","this is my attribute");
		echo $ccontrols->text("name", "");
		echo $ccontrols->crud("name", "");
		printbr();
		
		echo $ccontrols->textarea("name2", "");
		echo $ccontrols->crud("name2", "");
		printbr();
		
		echo $ccontrols->checkbox("fruit", "apple");
		echo $ccontrols->crud("fruit", "");
		printbr();
		
		echo $ccontrols->radio("veges", "carrots");
		echo $ccontrols->radio("veges", "spanich");
		echo $ccontrols->radio("veges", "tomatoe");
		echo $ccontrols->crud("veges", "");
		
		
		return ob_end();
	} // end innerhtml()
} // end CFormWithCMemoryProgram
?>