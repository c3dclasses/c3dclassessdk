<?php
//-----------------------------------------------------------
// name: CAngularJSModuleProgram.prg.php
// desc: demonstates how to use CAngularJS with CProgram
//-----------------------------------------------------------

// includes
include_program( "CAngularJSModuleProgram" );	// include this program into the system

// include routes
//include_controller( "CAngularJSModuleProgram", array( "name"=>"CElement.defaultController", "constructor"=>"CElement.defaultController" ) ); 
//include_module( "CAngularJSModuleProgram", "ngCookies" );
//include_js("angular-sanitize.js"); 
//include_module( "CAngularJSModuleProgram", "ngSanitize" ); 
//include_module( "CAngularJSModuleProgram", "ngDragDrop" ); 


//-----------------------------------------------------------
// name: CAngularJSModuleProgram
// desc: demonstates how to use CAngularJS with CProgram
//-----------------------------------------------------------
class CAngularJSModuleProgram extends CProgram{
	public function CAngularJSModuleProgram(){ 
		parent :: CProgram();
	} // end CAngularJSModuleProgram()
	
	public function c_main(){
return <<<SCRIPT
this.message = "practicing modules";
this.update();
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){		
ob_start();
?>
{{this.message | uppercase }}
<?php
return ob_end();
	} // end innerhtml()
} // end CAngularJSModuleProgram
// put script code here
ob_start();
?>
<script parse="true" location="footer">
function controller( $sce ){
	$cookies.foo = "hello, from cookies";
} // end controller
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
?>