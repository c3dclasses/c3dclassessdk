<?php
//---------------------------------------------------------------------------
// name: PHamIP.prg.php
// desc: demonstates how to use PHamIP
//---------------------------------------------------------------------------

// includes
include_program("PHamIP");
include_sass( dirname(__FILE__ ) . "/style.scss" );
include_sass( dirname(__FILE__ ) . "/style3.scss" );


//---------------------------------------------------
// name: PHamIP
// desc: demonstatrates how to use PHamIP
//---------------------------------------------------
class PHamIP extends CProgram{
	public function PHamIP(){ 
		parent :: CProgram();	
	} // end PHamIP()
		
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>PHamIP.php - (Sass/HamL parser)</b>");
	echo "Before: <br/>"; 
	echo file_get_contents( dirname(__FILE__ ) . "/style.scss");
	//$prev = ini_get("error_reporting");
	$css = CSASS :: scssFileToString( 'style.scss' );
	//error_reporting(0);
	//$sass = new SassParser(array('style'=>'nested'));
	//$css = $sass->toCss('style.scss');
	//error_reporting($prev);
	
	echo "After: <br />";
	echo $css;
	
	//CSASS :: scssFileToCSSFile( 'style.scss', 'style.css' );
	
return ob_end();
	} // end innerhtml()
} // end PHamIP
?>