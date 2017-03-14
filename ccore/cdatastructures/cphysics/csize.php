<?php
//---------------------------------------------------
// file: csize.php
// desc: defines a size object 
//---------------------------------------------------

// includes
include_js(relname(__FILE__) . '/csize.js' ); 

//------------------------------------------------------
// name: CSize
// desc: defines a object that stores size information
//------------------------------------------------------
class CSize{
	public function CSize($w=0, $h=0, $l=0) { 
		$this->set($w, $h, $l ); 
	} // end CSize()
	public function set($w, $h, $l) { 
		$this->w = $w; 
		$this->h = $h; 
		$this->l = $l; 
	} // end set
	public function scale($sw, $sh, $sl) { 
		$this->w *= $sw; 
		$this->h *= $sh; 
		$this->l *= $sl; 
	} // end scale()
	public $w;
	public $h;
	public $l;	
} // end CSize
?>