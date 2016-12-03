<?php
//------------------------------------------------------------------------------------
// file: ccore.php
// desc: includes all of the files (php,js,css) needed to make the underlying system 
//------------------------------------------------------------------------------------

// includes cbase files
include_once("cglobal/cglobal.php");

// include global classes
include_once("cparse/cparse.php");

include_once("cincludefiles/cincludefiles.php");
include_once(dirname(dirname(__FILE__))."/clib/clib.php");

// includes
include_js( relname(__FILE__) . "/cparse/cparse.js" );
include_js(relname(__FILE__)."/cglobal/cglobal.js");
//include_once("other/other.php");
include_once("cmath/cmath.php");
include_once("cobqueue/cobqueue.php");
//include_once("ctag/ctag.php");

// includes php files
include("carray/carray.php");
include("cbit/cbit.php"); 
include("cstring/cstring.php");
include("cbitarray/cbitarray.php"); 
include("chash/chash.php");
include("chook/chook.php");
include("cconstants/cconstants.php");
include("cgeometry/cgeometry.php");
include_once(dirname(dirname(__FILE__))."/clib/cangularjs/cangularjs.php");
include_once("ccompiler/ccompiler.php");
include_once("cpath/cpath.php");
?>