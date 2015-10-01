//-------------------------------------------------------------------
// file: celement.drv.js
// desc: integrates celement with cangularjs 
//-------------------------------------------------------------------

//------------------------------------------------------
// name: CElement_defaultController()
// desc: defualt controller for celement
//------------------------------------------------------
function CElement_defaultController( $scope ){
	$scope.init = function( id ){	
		if( !id || !( $scope.this = CElement.loadCElement( "#" + id ) ) )
			return;
		$scope.this.update = function(){ $scope.$apply(); };
	} // end $scope.init()
} // CElement_defaultController()