<?php
//-----------------------------------------------------------
// name: CAngularJSDirectiveProgram.prg.php
// desc: demonstates how to use CAngularJS with CProgram
//-----------------------------------------------------------

// includes
include_program( "CAngularJSDirectiveProgram" );
include_controller("CElement_defaultController", "CElement_defaultController", "CAngularJSDirectiveProgram" );
include_directive( "myDirective", "myDirective" ); 

//-----------------------------------------------------------
// name: CAngularJSDirectiveProgram
// desc: demonstates how to use CAngularJS with CProgram
//-----------------------------------------------------------
class CAngularJSDirectiveProgram extends CProgram{
	public function CAngularJSDirectiveProgram(){ 
		parent :: CProgram();
	} // end CAngularJSDirectiveProgram()
	
	public function c_main(){
return <<<SCRIPT
	this.name="kevin";
	this.street="elm-street";
	this.update();
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){		
ob_start();
?>
 <div my-shared-scope></div>
 <div my-directive></div>
<?php
return ob_end();
	} // end innerhtml()
} // end CAngularJSDirectiveProgram

// put script code here
ob_start();
?>
<script parse="true" location="footer">
function myDirective() {
	return { template: "Name: {{this.name}}<br />Street: {{this.street}}" };
} // end myDirective()
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later		
?>