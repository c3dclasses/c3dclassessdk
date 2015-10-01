<?php
//-----------------------------------------------------------
// name: CAngularJSRouteProgram.prg.php
// desc: demonstates how to use CAngularJS with CProgram
//-----------------------------------------------------------

// includes
include_program( "CAngularJSRouteProgram" );	// include this program into the system
include_js( "//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular-route.js" );
include_module("ngRoute");
include_controller("CAngularJSRouteProgram_Controller", '[\'$scope\', \'$routeParams\', function($scope, $routeParams){CElement_defaultController($scope); $scope.param_id=$routeParams.id; alert($routeParams.id); }]', "CAngularJSRouteProgram" ); 
include_route( '/route1/:id', '{\'template\':\'This is route1:{{param_id}}.\', \'controller\':\'CAngularJSRouteProgram_Controller\'}' );
include_route( '/route2/:id', '{\'template\':\'This is route2:{{param_id}}.\', \'controller\':\'CAngularJSRouteProgram_Controller\'}' );
include_route( '/route3/:id', '{\'template\':\'This is route3:{{param_id}}.\', \'controller\':\'CAngularJSRouteProgram_Controller\'}' ); 

//-----------------------------------------------------------
// name: CAngularJSRouteProgram
// desc: demonstates how to use CAngularJS with CProgram
//-----------------------------------------------------------
class CAngularJSRouteProgram extends CProgram{
	public function CAngularJSRouteProgram(){ 
		parent :: CProgram();
	} // end CAngularJSRouteProgram()
	
	public function c_main(){
return <<<SCRIPT
	alert("running the program");
	this.route_program = "Route Program";
	this.update();
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){		
ob_start();
?>
{{this.route_program}}
<div>
Inside inner html
<div ng-view=""></div>
</div>
<?php
return ob_end();
	} // end innerhtml()
} // end CAngularJSRouteProgram
?>