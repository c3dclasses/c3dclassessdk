<?php
//----------------------------------------------------------------------------------------------
// name: CAngularJS.php
// desc: abstracts the functionality for angularjs and makes it easy to use in c3dclassesSDK
//----------------------------------------------------------------------------------------------

// includes
include_js( "http://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js" ); 
include_js( relname(__FILE__) . "/cangularjs.js" );

//------------------------------------------------------------------------------------------------
// name: CAngularJS
// desc:  abstracts the functionality for angularjs and makes it easy to use in c3dclassesSDK
//------------------------------------------------------------------------------------------------
class CAngularJS {
	// members
	public static $m_strappname="";
	public static $m_controllers=NULL;
	public static $m_modules=NULL;
	public static $m_filters=NULL;
	public static $m_directives=NULL;
	public static $m_routes=NULL;
	public static $m_classes=NULL;

	// methods
	public static function getApp(){
		return CAngularJS :: $m_strappname;
	} // end getApp()
	
	public static function getControllerNameByClass( $classtype ){
		return ( isset( CAngularJS::$m_classes ) && isset( CAngularJS::$m_classes[$classtype] ) ) ? ( CAngularJS::$m_classes[$classtype] ) : "";
	} // end getControllerNameByClass()
	
	public static function includeApp( $strappname ){
		CAngularJS :: $m_strappname = $strappname;
	} // end includeApp()
	
	public static function includeController( $name, $params, $classtype=NULL ){
		$ret = CAngularJS :: includeComponent( $name, $params, CAngularJS :: $m_controllers );
		if( $ret == true && $classtype != NULL )
			CAngularJS :: $m_classes[$classtype] = $name;
		return $ret;	
	} // end includeController()

	public static function includeFilter( $name, $params ){
		return CAngularJS :: includeComponent( $name, $params, CAngularJS :: $m_filters );	
	} // end includeFilter()
	
	public static function includeDirective( $name, $params ){
		return CAngularJS :: includeComponent( $name, $params, CAngularJS :: $m_directives );	
	} // end includeFilter()
	
	public static function includeRoute( $name, $params ){
		return CAngularJS :: includeComponent( $name, $params, CAngularJS :: $m_routes );	
	} // end includeRoute()
	
	public static function includeModule( $name, $params=NULL ){
		$params = $name;
		return CAngularJS :: includeComponent( $name, $params, CAngularJS :: $m_modules );	
	} // end includeModules()

	public static function includeComponent( $name, $params, &$buffer ){
		if( isset( $params ) == false )
			return false;
		if( $buffer == NULL )
			$buffer = array();
		$buffer[$name] = "<params>" . $params . "<params>";
		return true;
	} // end includeComponent()
} // end CAngularJS

/////////////////////
// includes
function include_app( $app ){
	return CAngularJS :: includeApp( $app );
} // end include_app()

function include_controller( $strname, $params, $classtype=NULL ){
	return CAngularJS :: includeController( $strname, $params, $classtype );
} // end include_controller()

function include_filter( $strname, $params ){
	return CAngularJS :: includeFilter( $strname, $params );
} // end include_filter()

function include_directive( $strname, $params ){
	return CAngularJS :: includeDirective( $strname, $params );
} // end include_directive()

function include_route( $strpath, $params ){
	return CAngularJS :: includeRoute( $strpath, $params );
} // end include_route()

function include_module( $module ){
	return CAngularJS :: includeModule( $module );
} // end include_route()
?>