<?php
//-----------------------------------------------------------------------------
// file: libs.php
// desc: defines the class and framework that makes up the base of c3dclasses
//-----------------------------------------------------------------------------

// includes
include_js(relname(__FILE__) . '/mootools/mootools-1.2.4-core-nc.js');	
include_js(relname(__FILE__) . '/mootools/mootools-1.2.4-core-nc-ex.js');	
include_js("https://code.jquery.com/jquery-2.1.3.js");
//include_js("http://code.jquery.com/jquery-1.7.min.js");
//include_js("https://code.jquery.com/jquery-1.11.2.min.js");
//include_js("https://code.jquery.com/jquery-1.9.0.min.js");

//include_js(relname(__FILE__) . "/jquery/jquery-1.7.min.js", "typeof(jQuery) == 'undefined'"); 
include_js(relname(__FILE__) . '/jquery/jquery.sizes.js');	
include_js("http://yui.yahooapis.com/3.4.1/build/yui/yui-min.js");
//include_js( "http://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js" ); // include angular js lib
include_once("phpquery/phpQuery-onefile.php");
include_once("extract_css_urls/extract_css_urls.php");
include_once("cminify/cminify.php");
$prev = ini_get("error_reporting");
error_reporting(0);
include_once("csass/csass.php");
error_reporting($prev);
include_once("phpquery/phpQuery-onefile.php");
include_once("other/other.php");
include_once("cfunction/cfunction.php");
include_once("clogger/clogger.php");
include_once("cunittest/cunittest.php");

?>