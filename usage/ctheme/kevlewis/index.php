<?php
//----------------------------------------------------------
// name: index.php
// desc: main page for the theme
//----------------------------------------------------------


// use the theme object here
if( class_exists( "CTheme" ) == false || ($ctheme = CTheme::getCTheme()) == NULL ) 
	return;
$ctheme->body();
?>
