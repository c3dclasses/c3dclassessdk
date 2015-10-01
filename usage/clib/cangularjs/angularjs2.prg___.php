<?php
//---------------------------------------------------------------------------
// name: angularjs.prg.php
// desc: demonstates how to use angularjs functions for cform
//---------------------------------------------------------------------------

// includes
include_program( "angularjs2" );
include_js( "http://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js" ); // include angular js lib
include_js( relname(__FILE__) . "/" . "mycontroller.js");

//---------------------------------------------------
// name: angularjs
// desc: demonstates how to use angularjs functions
//---------------------------------------------------
class angularjs2 extends CProgram{
	public function CBaseProgram(){ 
		parent :: CProgram();	
		$this->attr("hello","hello");
	} // end video_js()
	
	public function c_main(){
return <<<SCRIPT
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){		
ob_start();
?>
<div ng-app="" ng-controller="customersController">
<table>
  <tr ng-repeat="x in names">
    <td>{{ x.m_strname }}</td>
    <td>{{ x.m_value }}</td>
    <td>{{ x.m_strtype }}</td>
  </tr>
</table>
</div>
<script>
function customersController($scope,$http) {
	//alert("hello, in the controller");
    //var site = "http://www.w3schools.com";
	//var page = "/website/Customers_SQL.aspx";
	var site = "";
    var page = "libs/sql.php";
	$http.get(site + page).success(function(response) {$scope.names = response;});
} // end customersController()
</script>
<?php
return ob_end();
	} // end innerhtml()
} // end angularjs
?>