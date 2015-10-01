<?php
//-----------------------------------------------------------
// name: CAngularJSControllerProgram.prg.php
// desc: demonstates how to use CAngularJS with CProgram
//-----------------------------------------------------------

// includes
include_program( "CAngularJSControllerProgram", __FILE__ ); // include this program into the system
include_controller( "CElement_defaultController", 
					"['\$scope',CElement_defaultController]", 
					"CAngularJSControllerProgram" );
include_path( "CAngularJSControllerProgram", __FILE__ );
//echo CPath :: _( "CAngularJSControllerProgram" );
//include_controller( "CElement_defaultController", "CElement_defaultController" );
//include_controller( "CElement_defaultController", "['\$scope', function(\$scope){alert('in new controller');}]", "CAngularJSControllerProgram" );
//-----------------------------------------------------------
// name: CAngularJSControllerProgram
// desc: demonstates how to use CAngularJS with CProgram
//-----------------------------------------------------------
class CAngularJSControllerProgram extends CProgram{
	public function CAngularJSControllerProgram(){ 
		parent :: CProgram();
	} // end CAngularJSControllerProgram()
	
	public function c_main(){
return <<<SCRIPT
	// update iteration variable every 
	var _this = this;
	this.css("background", "red");
	_for( Math.floor((Math.random() * 1000) + 1), function(){
		_this.iteration = this.getIteration();
		_this.update();
	}); // end _for()
	this.update();
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){		
ob_start();
?>
   this.id - this.class - this.iteration: <span>{{this.iteration}}</span><br />
<?php
return ob_end();
	} // end innerhtml()
} // end CAngularJSControllerProgram
?>