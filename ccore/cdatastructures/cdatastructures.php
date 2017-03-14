<?php
//------------------------------------------------------------------------------------
// file: ccore.php
// desc: includes all of the files (php,js,css) needed to make the underlying system 
//------------------------------------------------------------------------------------

// includes cbase files
//include_once("cglobal/cglobal.php");

// include global classes
//include_once("cparse/cparse.php");
//include_once("cincludefiles/cincludefiles.php");
//include_once(dirname(dirname(__FILE__))."/clib/clib.php");

// includes
//include_once("other/other.php");
include_once("cmath/cmath.php");
//include_once("cstdio/cstdio.php");
//include_once("ctag/ctag.php");

// includes php files
//include_js( relname(__FILE__) . "/cparse/cparse.js" );
include_once("carray/carray.php");
//include("cbit/cbit.php"); 
include_once("cstring/cstring.php");
include_once("cbitarray/cbitarray.php"); 
include_once("chash/chash.php");
//include("chook/chook.php");
//include("cconstants/cconstants.php");
include_once("cphysics/cphysics.php");
//include_once(dirname(dirname(__FILE__))."/clib/cangularjs/cangularjs.php");
//include_once("cpath/cpath.php");
//include_once("ctime/ctime.php");
?>