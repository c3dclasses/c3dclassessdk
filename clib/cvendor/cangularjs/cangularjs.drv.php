<?php
//----------------------------------------------------------------------------------------------
// name: CAngularJS.drv.php
// desc: abstracts the functionality for angularjs and makes it easy to use in c3dclassesSDK
//----------------------------------------------------------------------------------------------


//--------------------------------------------------
// name: CAngularJS_includes()
// desc: includes all of the angularjs components 
//--------------------------------------------------
function CAngularJS_includes(){
	if( class_exists("CAngularJS") == false || CAngularJS :: $m_strappname == "" )
		return "";
	$pattern = "/\"<params>(.*?)<params>\"/";
	$replacement = '$1'; 
	$strjsoncontrollers = preg_replace($pattern, $replacement, json_encode( CAngularJS :: $m_controllers ));
	$strjsonfilters = preg_replace($pattern, $replacement, json_encode( CAngularJS :: $m_filters ));
	$strjsondirectives = preg_replace($pattern, $replacement, json_encode( CAngularJS :: $m_directives ));
	$strjsonroutes = preg_replace($pattern, $replacement, json_encode( CAngularJS :: $m_routes ));
	$strjsonmodules = json_encode( (CAngularJS :: $m_modules!=NULL) ? array_keys( CAngularJS :: $m_modules ) : NULL );	
$strjs = <<<SCRIPT
try{ CAngularJS.m_modules = $strjsonmodules; } catch(e){ CAngularJS.m_modules = []; }
try{ CAngularJS.m_controllers = $strjsoncontrollers; } catch(e){ CAngularJS.m_controllers = null; }
try{ CAngularJS.m_filters = $strjsonfilters; } catch(e){ CAngularJS.m_filters = null; }
try{ CAngularJS.m_directives = $strjsondirectives; } catch(e){ CAngularJS.m_directives = null; }
try{ CAngularJS.m_routes = $strjsonroutes; } catch(e){ CAngularJS.m_routes = null; }
SCRIPT;
	return $strjs . "\n";
} // end CAngularJS_includes()
CHook :: add( "cangularjs", "CAngularJS_includes" );	// put it in the angularjs section

//----------------------------------------------------------------------
// name: CAngularJS_loadMainModule()
// desc: loads the angularjs main module in the angularjs section
//----------------------------------------------------------------------
function CAngularJS_loadMainModule(){
	if( class_exists("CAngularJS") == false )
		return "";
	$strapp = CAngularJS :: getApp(); 
	if( $strapp == NULL )
		return "";
$strjs = <<<SCRIPT
if( CAngularJS.loadMainModule("$strapp") == false ) 
	alert("ERROR: CAngularJS.loadMainModule('$strapp')");
SCRIPT;
return $strjs;
} // end CAngularJS_loadMainModule()
CHook :: add( "cangularjs", "CAngularJS_loadMainModule" );

//////////////////////////////
// Angular JS Drivers 

//----------------------------------------------------------------------
// name: CAngularJS_Section()
// desc: renders and runs the angularjs section on fscript section
//----------------------------------------------------------------------
function CAngularJS_Section(){
	if( class_exists("CAngularJS") == false )
		return "";
	$str = CHook :: fire( "cangularjs" );
$strjs = <<<SCRIPT
// BEGIN - CAngularJS section
$str
// END - CAngularJS section
SCRIPT;
	$strjs .= "\n";
	return $strjs;
} // end CAngularJS_Section()
CHook :: add( "fscript", "CAngularJS_Section", 5 );	// level 5 
?>