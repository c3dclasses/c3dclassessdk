<?php
//-----------------------------------------------------------
// name: CAngularJSFilterProgram.prg.php
// desc: demonstates how to use CAngularJS with CProgram
//-----------------------------------------------------------

// includes
include_program( "CAngularJSFilterProgram" );
include_controller( "CElement_defaultController", "CElement_defaultController", "CAngularJSFilterProgram" ); 
include_filter( "reverse", "reverse" ); 

//-----------------------------------------------------------
// name: CAngularJSFilterProgram
// desc: demonstates how to use CAngularJS with CProgram
//-----------------------------------------------------------
class CAngularJSFilterProgram extends CProgram{
	public function CAngularJSFilterProgram(){ 
		parent :: CProgram();
	} // end CAngularJSFilterProgram()
	
	public function c_main(){
return <<<SCRIPT
this.message = "practicing filters";
this.update();
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){		
ob_start();
?>
{{this.message | uppercase | reverse }}
<?php
return ob_end();
	} // end innerhtml()
} // end CAngularJSFilterProgram

// put script code here
ob_start();
?>
<script parse="true" location="footer">
function reverse() {
	return function(input, uppercase) {
		input = input || '';
		var out = "";
		for( var i = 0; i < input.length; i++ ){
			out = input.charAt(i) + out;
		}
		// conditional based on optional argument
		if (uppercase) {
			out = out.toUpperCase();
		}
		return out;
	} // end return 
} // end reverse()
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
?>