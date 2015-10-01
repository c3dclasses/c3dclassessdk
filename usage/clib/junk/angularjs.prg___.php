<?php
//---------------------------------------------------------------------------
// name: angularjs.prg.php
// desc: demonstates how to use angularjs functions for cform
//---------------------------------------------------------------------------

// includes
include_program( "angularjs" );
include_js( "http://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js" ); // include angular js lib
include_js( relname(__FILE__) . "/" . "mycontroller.js");

//---------------------------------------------------
// name: angularjs
// desc: demonstates how to use angularjs functions 
//---------------------------------------------------
class angularjs extends CProgram{
	public function CBaseProgram(){ 
		parent :: CProgram();	
	} // end video_js()
	
	public function c_main(){
return <<<SCRIPT
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){		
ob_start();
?>	
<!--
<div ng-app="" ng-init="firstName='John';lastName='Doe';points=[1,15,19,2,40];names=[
{name:'Jani',country:'Norway'},
{name:'Hege',country:'Sweden'},
{name:'Kai',country:'Denmark'}]" ng-controller="personController2"><!-- hook ng-app to ckernal to make it angular js ( app ) -->
<div ng-app="" ng-init="firstName='John';lastName='Doe';points=[1,15,19,2,40];" ng-controller="personController2"><!-- hook ng-app to ckernal to make it angular js ( app ) -->

    <p>Input something in the input box:</p>

	<p>Name: <input type="text" ng-model="name" value="John"></p> <!-- ccontrols->text("name", "John"); hook "ng-model" to ccontrols ( app.name )-->

    <p ng-bind="name"></p> <!-- p.innerHtml = app.name -->
    <span ng-bind="name"></span>
    <p>The name is <span ng-bind="firstName"></span></p> <!-- span.innerHTML = app.firstName -->
	<p>firstName: {{firstName}}</p> <!-- span.innerHTML = app.firstName -->
    <p>5 + 5: {{ 5 + 5 }}</p>
    <p>points[2]: {{ points[2] }}</p>
    <p>points[2]: <span ng-bind="points[2]"></span></p>
    <p>person.firstName: {{person.firstName}}</p> <!-- span.innerHTML = app.firstName -->
    <p>person.lastName: {{person.lastName}}</p> <!-- span.innerHTML = app.firstName -->
    First Name: <input type="text" ng-model="firstName">
    <br>
	Last Name: <input type="text" ng-model="lastName">
    <br>
	Full Name: {{ (firstName|uppercase) + " " + lastName }}
    <br>
    Full Name2: {{person.fullName()}}
    <br>
	Full Name3: {{fullName()}}

    
    <ul>
  		<li ng-repeat="x in names | orderBy:'country'">
    		{{ x.name + ', ' + x.country }}
  		</li>
	</ul>
    
     <ul>
  		<li ng-repeat="x in names2 | orderBy:'country'">
    		{{ x.Name + ', ' + x.Country }}
  		</li>
	</ul>
    
    <table>
  		<tr ng-repeat="x in names2">
    		<td>{{ x.Name }}</td>
    		<td>{{ x.Country }}</td>
  		</tr>
	</table>

    
    <!--
    First Name: <input type="text" ng-model="person.firstName"><br>
	Last Name: <input type="text" ng-model="person.lastName"><br>
	<br>
	Full Name: {{person.firstName + " " + person.lastName}}
	-->
    
</div>

<script>
/*
function personController($scope) {
    $scope.firstName = "John";
    $scope.lastName = "Doe";
}*/

</script>

<script>
/*
function personController2($scope) {
    $scope.person = {
        firstName: "John",
        lastName: "Doe",
    	fullName: function() {
            var x;
            x = $scope.person;
            return x.firstName + " " + x.lastName;
        }
	};
	
	$scope.fullName = function() {
         var x;
         x = $scope.person;
         return x.firstName + " " + x.lastName;
    };
}*/
</script>

<!-- ng-app -> ( $scope ) / root element / auto-bootstrap (initialize the application) / ng-app="myModule" -->

<!-- ng-init="firstName='John'" -> $scope.firstName = 'John'; / initial values / use a controller instead  -->

<!-- ng-model -> ( app.name ) / binds - input, select, textarea / type validation / status (invalid, dirty, touched, error ) / CSS classes / Form <=> Element Binding -->

<!-- ng-bind -> ( app.name ) = innerHTML -->

<!-- {{ expr }} -> data binding expression -->

<!-- ng-repeat="x in names" / clones HTML elements once for each collection item --> 

<!-- data-ng-app / data-ng-bind -->

<!-- {{ person.lastName | uppercase }} -> filters ( currency / lowercase / orderBy / uppercase ) -->

<!-- $http  AngularJS service for reading data from remote servers -> function customersController($scope,$http){ $http.get("http://www.w3schools.com/website/Customers_JSON.php")
    .success(function(response) {$scope.names = response;});}

<!-- table <table>
  		<tr ng-repeat="x in names">
    		<td>{{ x.Name }}</td>
    		<td>{{ x.Country }}</td>
  		</tr>
	</table>
-->


<?php  
return ob_end();
	} // end innerhtml()
} // end angularjs
?>