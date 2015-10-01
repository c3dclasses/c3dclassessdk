<?php
//---------------------------------------------------------------------------
// name: celement.prg.php
// desc: demonstrates how to use CElement
//---------------------------------------------------------------------------

// includes
include_program( "CElementProgram" );

//---------------------------------------------------
// name: CElementProgram
// desc: celement program demo
//---------------------------------------------------
class CElementProgram extends CProgram{
	protected $m_celement;
	public function CElementProgram(){ 
		parent :: CProgram();
		$this->event("onclick", "click_pseudo_server");
		css( "CElementProgram", "background", "yellow" );	// make the background of all celement programs yellow
		$this->m_celement = new CElement();
		$this->prop( "m_celement", $this->m_celement );
		$this->m_celement->html("hello, world");
		
		$this->border("left", "15px solid transparent");
		$this->border("right", "15px solid transparent");
		$this->border("top", "15px solid transparent");
		$this->border("bottom", "15px solid transparent");
		
		$this->linearGradient( "red 60%, blue 30%, orange 10%", "top left");		// direction / degree / 
		$this->linearGradient( "red 60%, blue 30%, orange 10%", "90deg");		// direction / degree / 
	
		$this->radialGradient( "red, blue, green", "ellipse");		// direction / degree / 
		
		
		
		
		//$this->backgroundColor("blue");
		//$this->backgroundImage( array( "http://www.w3schools.com/cssref/img_tree.gif", "http://www.w3schools.com/cssref/img_flwr.gif" ));
		//$this->borderImage( "url(http://www.w3schools.com/cssref/border.png) 30 30 stretch" );
	} // end CElementProgram()
	
	public function c_main(){ 
return <<<JSCRIPT
//this.m_celement.css("background","red");
//this.m_celement.css("color","yellow");
this.event("click",click_pseudo_server);	
this.event("click",click_client);	
this.sevent("click","click_server");	
//this.css("color","red");
//this.css("background","blue");
alert("CElementProgram::c_main()");
JSCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){
ob_start();
echo $this->m_celement->body();
printbr("CElementProgram :: innerhtml()");
printbr("Please click here!!!");
return ob_end();
	} // end innerhtml()
} // end CElementProgram

function click_pseudo_server(){
 	return "alert('in the click method of the pseudo server');";
} // end click

function click_server(){
 	return "alert('in the click method of the real server');";
} // end click

ob_start();
?>
function click_client(){
	alert("in the click method on the client");
} // end click
<?php
ob_end_queue("script");
?>