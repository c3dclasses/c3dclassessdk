function foo( $scope, params ){
	if( params && params.thisfn ){
		alert("this function exist");
		$scope.this = params.thisfn( "#" + params.id );		// set up the this object
		$scope.this.update = function(){ $scope.$apply(); }	// add update function
		$scope.name = "hello";
		$scope.this.name = "kev";
	} // end if		
} // end defaultController()	