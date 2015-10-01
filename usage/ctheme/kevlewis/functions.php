<?php
//----------------------------------------------------------
// name: functions.php
// desc: creates the theme
//----------------------------------------------------------

// create the theme object here
$ctheme = ( class_exists( "CTheme" ) ) ? CTheme :: createCTheme( dirname(__FILE__) ) : NULL;
?>