<?php
//----------------------------------------------------------------------
// name: csection.usg.php
// desc: demonstrates how to use cwidget object that part of ctheme
//----------------------------------------------------------------------

static public function createCTheme( $strthemepath=NULL ) {
		$strname = strtolower( preg_replace("/[^A-Za-z0-9 ]/", '', get_current_theme() ) );
		$strname = str_replace( " ", "_", $strname );	
		
		includecontents( $strthemepath );
		
		$ctheme = new CTheme();	
		
		// create the main section and add it to the theme
		$csection = new CSection();
		$csection->tag("body");
		$csection->addClass($cbody->id());
		$csection->create("body","body", "Widgets in this area will be shown on the in the body of the theme or document"  );	
		
		$ctheme->setCBody( $csection );
		
		$ctheme->create( $strname, $strcontentspath );		
		return $ctheme;
} // end createCTheme()

?>