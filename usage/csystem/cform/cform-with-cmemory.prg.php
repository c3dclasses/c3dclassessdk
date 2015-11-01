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

/*
	jQuery(".ccontrol-crud").click(function(){ 
		var btn = jQuery(this);
		var name = btn.attr("data-name");
		var action = btn.attr("data-action");		
		var ctrl = jQuery("#"+name); 	
		
		if (!ctrl || !action)
			return;
			
		var type = ctrl.attr("type");
		var tag = ctrl.prop("tagName");	
		var data = ctrl.val();
		
		if(type == "checkbox") {
			if(!ctrl.prop('checked')) {
				alert("not check so dont save data point");
				data = "";
			}
		} // end if()
		else if(type=="radio") {
			ctrl = jQuery('input[name='+name+']:checked'); // get the checked control
		 	if(ctrl.length==0){
		 		alert("not check so dont save data point");
				data = "";
			}
		} // end else if
		 
		 
		 /*
		 || type == "radio") {
			ctrl = jQuery('input[name='+name+']:checked');
			if(ctrl) {
				alert("
				//alert("the control exist: " + ctrl.val() );
				//ctrl.css("border","none");
			}
		}*/
		
		//if(!ctrl)
		//	return;

		//if(!data) 
		//	data="";
	/*			
		var creturn = cmemory[action](name, data, "string");
		if(!creturn)
			return;
		
		_if(function(){ return creturn.isdone(); }, function(){ 
			if(action == "retrieve"){
				var data = creturn.data();
				data = jQuery.parseJSON(data[0].m_jsondata);
				if(type == "checkbox" || type == "radio") {
					ctrl.prop("checked", data.m_value!=null);
				} // end if
				else ctrl.val(data.m_value);
			} // end if
			else if(action=="delete"){
				if(type == "checkbox" || type == "radio")
					ctrl.prop("checked",false);
				else ctrl.val("");
			} // end elseif
			printbr(cmemory._toString());
		})._endif();
			
			
		
	}); // jQuery(".ccontrol-crud").click()

//alert(type);
		//var type = btn.attr("data-type");
*/
SCRIPT;
	} // end c_main()
	
	public function innerhtml(){	
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
		echo $ccontrols->submit("hello","hello");
		echo $ccontrols->endform();
		echo $ccontrols->crud("group", "");
		
		return ob_end();
	} // end innerhtml()
} // end CFormWithCMemoryProgram
?>