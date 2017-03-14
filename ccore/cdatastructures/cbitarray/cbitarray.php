<?php
//-----------------------------------------------------------------------------------------
// file: cbitarray.php
// desc: defines an object that access a interger bits as an array and sets them on/off
//-----------------------------------------------------------------------------------------

// header
include_js(relname(__FILE__) . "/cbitarray.js"); 

//----------------------------------------------------------------
// name: CBitArray
// desc:  defines an object that defines bit flag 
//----------------------------------------------------------------
class CBitArray{	
	protected $m_arribits;
	protected $m_carribits;
	protected $m_inumofbits;
	protected $m_inumofbitsset;
	static protected $SIZEOFINT = 32;	
	static protected $BITTOINT = 0.03125;
	static protected $ALLBITS = 0xFFFFFF;
	
	public function CBitArray() { 
		$this->m_arribits = NULL;
		$this->m_carribits = NULL;
		$this->m_inumofbits = 0;
		$this->m_inumofbitsset = 0;
	} // end CBitArray
	public function create($inumofbits) {
		$ibitarrays  = NULL;
		$inumbitarrays = 0;
		if($inumofbits < 1) 
			return false;
		$inumbitarrays = CMath::ceil($inumofbits / CBitArray::$SIZEOFINT); 
		$ibitarrays = new CArray();
		for($i=0; $i<$inumbitarrays; $i++)
			$ibitarrays->push(0);	
		$this->m_carribits = $ibitarrays; 
		$this->m_arribits = $this->m_carribits->valueOf();
		$this->m_inumofbits = $inumofbits;	
		$this->m_inumofbitsset = 0;	
		return true;	
	} // end create()
	public function createFromString($strcbitarray, $bhex=false) {
		if($strcbitarray==NULL || $strcbitarray == "") 
			return false;	
		$carrtokens  = new CArray(explode(" ", $strcbitarray));
		$arrtokens 	 = $carrtokens->valueOf();
		$inumbitarrays = CMath::ceil(parseInt($arrtokens[0]) / CBitArray::$SIZEOFINT); 
		for($i=0; $i<$inumbitarrays; $i++)
			$arribits[$i] = parseInt($arrtokens[2+$i]); 
		$this->m_inumofbits = parseInt($arrtokens[0]);
		$this->m_inumofbitsset = parseInt($arrtokens[1]);
		$this->m_carribits = new CArray($arribits);
		$this->m_arribits = $this->m_carribits->valueOf();
		return true;
	} // end create()	
	public function isEmpty() { return $this->m_inumofbitsset <= 0; }
	public function isFull() { return $this->m_inumofbitsset >= $this->m_inumofbits; }
	public function getBitArrays() { return $this->m_arribits; }
	public function getNumOfBits() { return $this->m_inumofbits; } 
	public function getNumOfBitsSet() { return $this->m_inumofbitsset; }	
	public function getAllSetBitIndices() {
		if($this->m_inumofbits == 0 || $this->m_arribits == NULL) 
			return NULL;		
		$inumsetbits = 0;
		for($i=0; i<$this->m_inumofbits; $i++)
			if ($this->isBitSet(i)) 
				$inumsetbits++;		
		if($inumsetbits == 0)
			return NULL;		
		$indices = new CArray($inumsetbits);
		$i=0;
		for($j=0; $i<$this->m_inumofbits; $i++)
			if($this->isBitSet($i)) 
				$indices[$j++] = $i;				
		return $indices;
	} // end getAllSetBitIndices()
	public function setBit($ibit) {
		// compute the bitflag
		$ibitflag = $this->computeBitArray($ibit);	
		if($ibitflag == -1) 
			return false;
		$ibit = $ibit % CBitArray::$SIZEOFINT;		
        $this->m_arribits[ $ibitflag ] = ($this->m_arribits[ $ibitflag ]|(1<<$ibit)); 		
		$this->m_inumofbitsset++;
		return true; 						 
	} // end setBit()
	public function setAllBits() {
		if($this->m_arribits == NULL) 
			return false;
		for($i=0; i<$this->m_arribits->length(); $i++)
			$this->m_arribits[$i] = CBitArray::$ALLBITS;
		$this->m_inumofbitsset = $this->m_inumofbits;
		return true;
	} // end setAllBits()	
	public function clearBit($ibit) {
		$ibitflag = $this->computeBitArray($ibit);
		if ($ibitflag == -1) 
			return false;
		$ibit = $ibit % CBitArray::$SIZEOFINT;		
		$this->m_arribits[ $ibitflag ] &= (~(1<<$ibit)); 
		$this->m_inumofbitsset--;
		return true;		
	} // end clearBit()
	public function clearAllBits() {
		if($this->m_arribits == NULL) 
			return false;		
		for($i=0; $i<$this->m_arribits->length(); $i++)
			$this->m_arribits[$i] = 0;
		$this->m_inumofbitsset=0;
		return true;
	} // end clearAllBits();
	public function enableBit($ibit, $benable) { return ($benable) ? $this->setBit($ibit) : $this->clearBit($ibit); }	
	public function isBitSet($ibit) {		
		$ibitflag = $this->computeBitArray($ibit);	
		if($ibitflag == -1)
			return false;
		$ibit = $ibit % CBitArray::$SIZEOFINT;		
		if(($this->m_arribits[$ibitflag] & (1<<$ibit)) > 0)
			return true;
		return false;
	} // end isBitSet()
	public function toBinaryString() {
		$str="";
		for($ibit=$this->m_inumofbits; $ibit>-1; $ibit--) 	
			$str .= (($this->isBitSet($ibit)) ? "1" : "0");		
		return $str;
	} // toBinaryString()	
	public function toHexString() { return $this->toString(true); }
	public function toDecimalString() { return $this->toString(false); }
	public function toString($bhex=false) {
		$str = "" . $this->m_inumofbits . " " . $this->m_inumofbitsset . " ";
		if($this->m_arribits) 
			for($i=0; $i<$this->m_carribits->length(); $i++) {
				$dec = $this->m_arribits[$i];
			 	$str = $str . (($bhex == false) ? $dec : dechex($dec)) . " ";
			} // end for
		return trim($str);
	} // toString()
	public function computeBitArray($ibit) { 
		return ($this->m_arribits == NULL || $ibit < 0 || $ibit >= $this->m_inumofbits) ? -1 : CMath::floor($ibit * CBitArray::$BITTOINT); 
	} // end computeBitArray() 
} // end CBitArray
?>