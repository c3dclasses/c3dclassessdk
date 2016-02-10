<?php
//-------------------------------------------
// file: test.php
// desc: defines the test file
//-------------------------------------------

// include kernal libraries
include_once(dirname(dirname(__FILE__)) . "/c3dclassessdk.php");

// include the clientside main
include_js(relname(__FILE__) . "/test.js", array("no-minify"=>true));

// include all of the test 
include_unittests(dirname(__FILE__));

// create the kernal object with ckernaltype = CKernal, mainentrypoint = ./main.php 
if(($ckernal = CKernal :: createCKernal("CKernal", relname(__FILE__) . "/test.php")) == NULL)
	return false;
	
// load kernal and it's programs - $strprogrampath = dirname(__FILE__)
$ckernal->load(dirname(__FILE__));	
//include_program("CUnitTestProgram");

// get all of the programs that where included
//$cprogramtypes = CProgram :: getCProgramTypes();
// get the selected program
//$cprogramtype = isset($_REQUEST["cprogramtype"]) ? $_REQUEST["cprogramtype"] : "";
// use the seletected program
//if($cprogramtype)

use_program(new CUnitTestProgram());

// intialize the kernal - this initializes all the objects including programs, elements, events
echo $ckernal->init();

// check if kernal executed any ajax components including ( main methods or events ), if so shut the kernal down
if ($ckernal->s_main()) {
	// unload the kernal and it's object 
	echo $ckernal->unload();
	// deinit the kernal and it's object 
	echo $ckernal->deinit();
	// destory the kernal and it's object 
	CKernal :: destroyCKernal($ckernal);
	return;
} // end if

// prerender the kernal's body including the body of all of it's object (cprogram, celements, etc.)
echo $ckernal->prebody();

// render the html to the browser
echo $ckernal->render("main_html");

// unload the kernal and it's objects
echo $ckernal->unload();

// deinit the kernal and it's objects
echo $ckernal->deinit();

// destory the kernal and it's object 
CKernal :: destroyCKernal($ckernal);
?>