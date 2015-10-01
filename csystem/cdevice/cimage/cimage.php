<?php
//---------------------------------------------------------
// file: cimage.php
// desc: defines image object
//---------------------------------------------------------

class CImage{
	// members
	protected $m_image;
	
	public function CImage(){
		$this->m_image = NULL;
	} // end CImage()
	
	public function create( $strfilename ){		
	} // end create()
	
	public function createBlank( $width, $height ){		
		// make this generic
		$image = imagecreatetruecolor( $width, $height );
		if( $image )
			return FALSE;
 		$this->m_image = $image;
		return TRUE;
	} // end createBlank()
	
	public function getSize(){ 
		return new CSize( imagesx( $this->m_image ), imagesx( $this->m_image ) );
	} // end getSize()
	
	public function saveToFile( $strfilename ){
	} // end saveToFile()	
} // end CImage

class CJPEGImage extends CImage{	
	public function create( $strfilename ){		
		// make this generic
		$image = imagecreatefromjpeg( $strfilename );
		if( !$image )
			return FALSE;
 		$this->m_image = $image;
		return TRUE;
	} // end create()

	public function saveToFile( $strfilename ){
		if( !$this->m_image )
			return FALSE;
		return imagejpeg( $this->m_image, $strfilename );
	} // end saveToFile()	
} // end CJPEGImage

class CPNGImage extends CImage{	
} // end CPNGImage


?>