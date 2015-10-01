<?php
/*
Plugin Name: C3DClassesSDK
Plugin URI: 
Description: Defines the c3dclassessdk.web api that adds additional function to wordpress components 
Version: 1.0.0
Author: Kevin Lewis
Author URI: 
*/

//-----------------------------------------------------------------------------
// file: c3dclassessdk.php
// desc: c3dclasses framework
//-----------------------------------------------------------------------------

// includes
//include_once("cbase/cbase.php");
include_once("ccore/ccore.php");
include_once("csystem/csystem.php");
includephpfilesfrompath( dirname(__FILE__), ".drv.php" ); // include drivers

// get the class the user wants to see
$class = isset( $_REQUEST["class"] ) ? $_REQUEST["class"] : NULL;
$path = isset( $_REQUEST["path"] ) ? $_REQUEST["path"] : NULL;

if( $class ){
?>
<h1><?php echo $class; ?></h1>
<b>Source</b>
<br />
<?php getusagelink( dirname(__FILE__), $class ); ?>
<?php
}
if( $path ){
?>
<h1><?php echo $path; ?></h1>
<textarea>
<?php echo htmlspecialchars( file_get_contents( $path ), ENT_QUOTES); ?>
</textarea>
<?php
} // end if
function getusagelink( $strpath, $class ){
	if ( is_dir($strpath) == false || ($handle = opendir($strpath)) == NULL )
		return false; 	
	while (false !== ($file = readdir($handle))){
		if( $file == "." || $file == ".." )
			continue;
		else if( is_dir( "".$strpath."/".$file ) ){
			//echo "$strpath/$file";
			getusagelink( "".$strpath."/".$file, $class );
		}
		else if( stripos( $file, $class ) !== FALSE ){
			$base = relname(__FILE__);
			$path = urlencode( "$strpath/$file" );
			echo "<a href=\"$base/c3dclassessdk.php?path=$path\">";
			echo "$strpath/$file";
			echo "</a>";
			
			echo "<br />";
			//include_once( "$strpath/$file" );
		}
		//} // end if
    } // end while()
	closedir($handle);	
	return true;	
} // getusagelinks()
?>