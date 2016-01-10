<?php
//---------------------------------------------------------------------------
// name: cform.prg.php
// desc: demonstrates how to use cform program
//---------------------------------------------------------------------------

// includes
include_program("CFormProgram");
include_array_memory("mymemory", "session", $_SESSION );

include_css("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css");
include_css("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css");
include_js("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js");


//---------------------------------------------------
// name: CFormProgram 
// desc: hello world program
//---------------------------------------------------
class CFormProgram extends CProgram{
	// members
	protected $m_cfrom;
	
	// constructor
	public function CFormProgram(){ 
		parent :: CProgram();	
		$this->m_cform = new CForm();
		$this->m_cform->create( "mymemory" );	
		$this->prop( "m_cform", $this->m_cform );
	} // end CFormProgram()
	
	// main
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>cform.js</b>" );

	var coptions = this.m_cform.getCOptions();
	var ccontrols = this.m_cform.getCControls();
	
	// printing out the value of the options
	printbr( "Control1: " + coptions.option("control1") );
	printbr( "Control2: " + coptions.option("control2") );
	printbr( "Control3: " + coptions.option("control3") );
	printbr( "Control4: " + coptions.option("control4") );
	printbr( "Control5: " + coptions.option("control5") );
	printbr( "Control6: " + coptions.option("control6") );
	printbr( "Control7: " + coptions.option("control7") );
	printbr( "Control8: " + coptions.option("control8") );
	printbr( "Control9: " + coptions.option("control9") );
	coptions.option("control4", "red");
	coptions.option("control9", "red");
	coptions.option("control7", "HELLO1");
	coptions.option("control1", "red");
	
	// getting the controls
	alert("getting the radio group");
	var cradiogroup = ccontrols.radiogroup("control6");
	for( var i=0; i<cradiogroup.length(); i++ ){
		cradiogroup.get(i).css("background","black");
		alert("have the group");
	} // end for
	
	if( cradiogroup.selected() )
		alert( "The selected value: " + cradiogroup.selected().value() );
	
	cradiogroup.selected( 0 );
	cradiogroup.selected().value("hello-mannnnnnnnnnnnnnn")
	
	var ctext = ccontrols.text("control1").css("background","black");
	
	var cselect = ccontrols.select("control7").css("background", "blue");
	
	cselect.option(0).value("this is the newvalue");
	cselect.option(0).html("this is the newname");
	cselect.option(0).remove();
	
	var coption = cselect.addoption(0);
	if( coption ){
		coption.value("bluevalue")
		coption.html("blackname")
	}
	var cselect = ccontrols.select("control76666");//.css("background", "blue");
	var coption = cselect.addoption(0);
	coption.value("bluevalue1");
	coption.html("blackname1");
	var coption = cselect.addoption(1);
	coption.value("bluevalue2");
	coption.html("blackname2");
	var coption = cselect.addoption();
	coption.value("bluevalue3");
	coption.html("blackname3");
	
	var coption = cselect.addoption(3);
	if( coption ){
		coption.value("bluevalue6");
		coption.html("blackname6");
	} // end if
	
	var celement = CElement.createCElement("div", CControl );
	celement.create();
	celement.html("hello, world");
	celement.css("background", "none");
	
	
	this.m_cform.pushChild( celement );
	this.m_cform.pushChild( cselect );
	
	var cform = new CForm()
	if( !cform || cform.create() == false )
		alert("no cform");
	else alert("created the cform");
	
	this.pushChild( cform );
	
	//printbr( this.m_cform.jq("control9").attr("value") );
	//this.m_cform.jq("control1").css("background","red");


SCRIPT;
	} // end c_main()
	
	// html
	public function innerhtml(){	
		$ccontrols = $this->m_cform->begin();	// build the forms body
		$ccontrols->hidden("cprogramtype","CFormProgram");
		print("Control1:");			
		$ccontrols->text("control1", "default hello, world");
		printbr();			
		print("Control2:");			
		$ccontrols->text("control2", "default hello, world");
		
		print('<div class="input-group">');
  		$ccontrols->text("control2", "default hello, world", array( "attributes"=>array( "class"=>"form-control", "placeholder"=>"Username", "aria-describedby"=>"basic-addon1" ) ) );
		print('<span class="input-group-addon" id="basic-addon1">@</span>');
		print('</div>');
		
		printbr();		
		print("Control3:");			
		$ccontrols->textarea("control3", "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).");
		printbr();		
		print("Control4:");				
		$ccontrols->checkbox("control4","red");
		printbr();
		print("Control5:");			
		$ccontrols->hidden("control5","value");
		printbr();
		print("Control6:");			
		$ccontrols->radio("control6","red");
		$ccontrols->radio("control6","green");
		$ccontrols->radio("control6","blue");
		printbr();
		print("Control7:");			
		$ccontrols->select( "control7", 1, array("HELLO5"=>"WORLD1", "HELLO1"=>"WORLD1","HELLO2"=>"WORLD2","HELLO3"=>"WORLD3") );
		printbr();
		print("Control8:");			
		$ccontrols->button("control8", "delete", array( "attributes"=>array( "class"=>"btn btn-primary btn-lg" ) ) );		
		printbr();
		print("Control9:");			
		$ccontrols->submit("control9", "Enter the Form Data");
		printbr();
		$this->m_cform->end();
		
		$cmemory = use_memory("mymemory");
		
		
		ob_start();
		printbr( "<b>cform.php</b>" );
		printbr( $this->m_cform->body() );
		
		//printbr();
		//printbr( "CMemory contents of this form" );
		//printbr( "CMemory: " . $cmemory->toString() );
		
		return ob_end();
	} // end innerhtml()
} // end CFormProgram
?>