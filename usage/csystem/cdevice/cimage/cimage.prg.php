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
	} // end CImageProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr("<b>cimage.js</b>");
	
	//include_image("image5", "https://www.google.com/images/nav_logo242.png", "CImage");
	
	cimage = new CImage();
	cimage.create(dirname(this.__FILE__) + "/cimage.jpg");
	cimage.saveToFile(dirname(this.__FILE__) + "/cimage2.jpg" );
	
	cimageresource = use_image("image1");
	//print_r(cimageresource);
	cimageresource.get().saveToFile( dirname(this.__FILE__) + "/cimage3.jpg" );
	printbr( cimageresource.path() );
	printbr("<img src='" + cimageresource.path() + "'/>" );
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>cimage.php</b>");
	
	$cimage = new CJPEGImage();
	$cimage->create( dirname(__FILE__) . "/cimage.jpg" );
	$cimage->saveToFile( dirname(__FILE__) . "/cimage2.jpg" );
	
	$cimageresource = use_image("image1");
	print_r($cimageresource);
	$cimageresource->get()->saveToFile( dirname(__FILE__) . "/cimage3.jpg" );
	printbr( $cimageresource->path() );
	printbr("<img src='". relname( $cimageresource->path() ) . "/cimage2.jpg" . "'/>" );
return ob_end();
	} // end innerhtml()
} // end CImageProgram
?>