<?php
//---------------------------------------------------------------------------
// name: cimage.prg.php
// desc: demonstrates how to construct a basic hello, world!!! program
//---------------------------------------------------------------------------

include_program("CImageProgram");

if( !include_image( "image1", dirname(__FILE__) . "/cimage2.jpg", "CJPEGImage" ) )
	alert("!include_image()");

//---------------------------------------------------
// name: CImageProgram
// desc: hello world program
//---------------------------------------------------
class CImageProgram extends CProgram{
	public function CImageProgram(){ 
		parent :: CProgram();	
	} // end CVideoProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr("<b>cimage.js</b>");
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>cimage.php</b>");
	
	$cjpegimage = new CJPEGImage();
	$cjpegimage->create( dirname(__FILE__) . "/cimage.jpg" );
	$cjpegimage->saveToFile( dirname(__FILE__) . "/cimage2.jpg" );
	
	$img = use_image("image1");
	print_r($img);
	
	$img->get()->saveToFile( dirname(__FILE__) . "/cimage3.jpg" );
	
	printbr( $img->path() );
	
	printbr("<img src='".relname( $img->path() ) . "/cimage2.jpg" . "'/>" );
	
return ob_end();
	} // end innerhtml()
} // end CVideoProgram
?>