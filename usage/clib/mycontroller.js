/*
function namesController(scope) {
    scope.names = [
        {name:'Jani',country:'Norway'},
        {name:'Hege',country:'Sweden'},
        {name:'Kai',country:'Denmark'}
    ];
} 
*/

function personController2(scope) {
    scope.person = {
        firstName: "John",
        lastName: "Doe",
    	fullName: function() {
            var x;
            x = scope.person;
            return x.firstName + " " + x.lastName;
        }
	};
	
	scope.fullName = function() {
         var x;
         x = scope.person;
         return x.firstName + " " + x.lastName;
    };
	scope.names = [
        {name:'Jani',country:'Norway'},
        {name:'Hege',country:'Sweden'},
        {name:'Kai',country:'Denmark'}
    ];
}

function personController2(scope, $http) {
    scope.person = {
        firstName: "John",
        lastName: "Doe",
    	fullName: function() {
            var x;
            x = scope.person;
            return x.firstName + " " + x.lastName;
        }
	};
	
	scope.fullName = function() {
         var x;
         x = scope.person;
         return x.firstName + " " + x.lastName;
    };
	
	$http.get("http://www.w3schools.com/website/Customers_JSON.php")
    .success(function(response){
		scope.names2 = response;
	});
	
	scope.names = [
        {name:'Jani',country:'Norway'},
        {name:'Hege',country:'Sweden'},
        {name:'Kai',country:'Denmark'}
    ];
	
}