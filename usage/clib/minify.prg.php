<?php
//---------------------------------------------------------------------------
// name: minify_prg.prg.php
// desc: demonstates how to use minify_prg
//---------------------------------------------------------------------------

// includes
include_program("minify_prg");

//---------------------------------------------------
// name: minify_prg
// desc: demonstatrates how to use minify_prg
//---------------------------------------------------
class minify_prg extends CProgram{
	public function minify_prg(){ 
		parent :: CProgram();	
	} // end minify_prg()
		
	// rendering methods
	public function innerhtml(){
		$custom_scripts[]="http://s.w.org/wp-includes/js/jquery/jquery.js";
		$custom_scripts[]="http://s.w.org/wp-includes/js/jquery/jquery.js";
		$custom_styles[]="http://s.w.org/style/wp4.css";
		$custom_styles[]="http://s.w.org/style/wp4.css";
		
		
		// scripts
		$js = Minify_getUri($custom_scripts);
		echo $js;
		
		$file = fopen("custom-min.js","w");
		$strcontent = file_get_contents( "http://localhost/clib/minify/minify-2.1.7" . $js );
		fwrite( $file, $strcontent );
		fclose( $file );		
		
		// styles
		$css = Minify_getUri($custom_styles);
		$file = fopen("custom-min.css","w");
		$strcontent = file_get_contents( "http://localhost/clib/minify/minify-2.1.7" . $css );
		fwrite( $file, $strcontent );
		fclose( $file );
		
		// write contents to the screen
ob_start();
		printbr("<b>minify_prg.php</b>");
		printbr("check if program created custom-min.css and custom-min.js files in its directory.");
return ob_end();
	} // end innerhtml()
} // end minify_prg
?>