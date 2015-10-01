//----------------------------------------------------------------------------------------------
// name: cangularjs.js
// desc: abstracts the functionality for angularjs and makes it easy to use in c3dclassesSDK
//----------------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------------------
// name: CAngularJS
// desc: abstracts the functionality for angularjs and makes it easy to use in c3dclassesSDK
//---------------------------------------------------------------------------------------------
var CAngularJS = new Class({	
	ClassMethods : {
		// members
		m_strappname: "",
		m_module: null,			// the main module
		m_modules : [],
		m_controllers: null,
		m_filters: null,
		m_directives: null,
		m_routes: null,
		
		// methods
		loadMainModule : function( strappname ){
			//alert("loading the module");
			if( CAngularJS.m_module != null )
				return true;
			var module = angular.module( strappname, (CAngularJS.m_modules)?CAngularJS.m_modules:[] );
			if( !module )
				return false;	
			CAngularJS.m_module = module;
			CAngularJS.m_strappname = strappname;
			//alert("loaded the main module");	
			CAngularJS.loadControllers();	
			CAngularJS.loadFilters();
			CAngularJS.loadDirectives();
			CAngularJS.loadRoutes();
			return true;
		}, // end loadMainModule()
		
		loadControllers : function(){
			if( CAngularJS.m_controllers == null )
				return false;
			var controllers = CAngularJS.m_controllers;
			var module = CAngularJS.m_module;
			for( var name in controllers )
				module.controller( name, controllers[name] );	
			return true;
		}, // end loadControllers()
		
		loadFilters : function(){
			if( !CAngularJS.m_filters || !CAngularJS.m_module  )
				return false;
			var filters = CAngularJS.m_filters;
			var module = CAngularJS.m_module;
			for( var name in filters )
				module.filter( name, filters[name] );
			return true;
		}, // end loadFilters() 
		
		loadDirectives : function(){ 
			var directives = CAngularJS.m_directives;
			var module = CAngularJS.m_module;
			if( !module || !directives )
				return false;
			for( var name in directives )
				module.directive( name, directives[name] );
			return true;
		}, // end loadDirective()
		
		loadRoutes : function(){
			var routes = CAngularJS.m_routes;
			var module = CAngularJS.m_module;
			if( !module || !routes )
				return false;
			module.config( 
				['$routeProvider', function($routeProvider) {
					for( var path in routes )
						$routeProvider.when( path, routes[path] );
					$routeProvider.otherwise({
						redirectTo: '/'
					}); // end $routeProvider.otherwise()			
				}] // end ['$routeProvider', function($routeProvider) {}]
			); // end module.config()
			return true;
		} // end loadRoutes()
	} // end ClassMethods
}); // end CAngularJS