<?php
//---------------------------------------------------------------------------
// name: cbitarray.tst.php
// desc: test the cbitarray class
//---------------------------------------------------------------------------

//---------------------------------------------------
// name: CBitArrayProgram
// desc: hello world program
//---------------------------------------------------
class CBitArrayUnitTest2 extends CUnitTest{
/*	
	public function c_main(){
return <<<SCRIPT
	printbr("<b>cbitarray.js</b>");
			
	// allocate a Bit Array structure
	var cbitarray = new CBitArray();
		
	// create the Bit Array object	
	if( cbitarray == null || cbitarray.create( 56 ) == false )
	{
		printbr("ERROR: couldn't created CBitArray");
		return;
	} // end if
	else printbr("SUCCESS: created CBitArray!");	
			
	// set some of the bits
	printbr("cbitarray.setBit(0) = " + cbitarray.setBit(0) );
	printbr("cbitarray.setBit(1) = " + cbitarray.setBit(1));
	printbr("cbitarray.enableBit( 20, true ) = " + cbitarray.enableBit( 20, true ));
		
	// check if the bits or on or off
	printbr("cbitarray.isBitSet(0) = " + cbitarray.isBitSet(0));
	printbr("cbitarray.isBitSet(1) = " + cbitarray.isBitSet(1));
	printbr("cbitarray.isBitSet(2) = " + cbitarray.isBitSet(2));
		
	// converting bit to a binary string
	printbr("cbitarray.toBinaryString() = " + cbitarray.toBinaryString());
	printbr("cbitarray.clearBit(0) = " + cbitarray.clearBit(0));
	//printbr("cbitarray.clearBit(1) = " + cbitarray.clearBit(1);
		
	// converting bit to a binary string
	printbr("cbitarray.toBinaryString() = " + cbitarray.toBinaryString());
		
	// converting bit to a string
	printbr("cbitarray.toString() = " + cbitarray.toDecimalString());
		
	// testing the create from string 
	cbitarray2 = new CBitArray();
	
	// create the Bit Array object	
	if( cbitarray2 == null || cbitarray2.createFromString( cbitarray.toDecimalString() ) == false )
	{
		printbr("ERROR: couldn't created CBitArray from a string!");
		return;
	} // end if
	else printbr("SUCCESS: created CBitArray from a string!");
		
	// converting bit to a binary string
	printbr("cbitarray2.toBinaryString() = " + cbitarray2.toBinaryString());
		
	// converting bit to a string
	printbr("cbitarray2.toString() = " + cbitarray2.toDecimalString());
	printbr();
SCRIPT;
	} // end load()
*/	
	// rendering methods
	public function testCBitArray(){
	// allocate a Bit Array structure
	$cbitarray = new CBitArray();
	$this->assertTrue($cbitarray != NULL);
	$this->assertTrue($cbitarray->create( 56 ) != false);
	
	/*
		
	// create the Bit Array object	
	if( $cbitarray == NULL || $cbitarray->create( 56 ) == false )
	{
		printbr("ERROR: couldn't created CBitArray");
		return;
	} // end if
	else printbr("SUCCESS: created CBitArray!");	
			
	// set some of the bits
	printbr("cbitarray->setBit(0) = " . $cbitarray->setBit(0) );
	printbr("cbitarray->setBit(1) = " . $cbitarray->setBit(1));
	printbr("cbitarray->enableBit( 20, true ) = " . $cbitarray->enableBit( 20, true ));
		
	// check if the bits or on or off
	printbr("cbitarray->isBitSet(0) = " . $cbitarray->isBitSet(0));
	printbr("cbitarray->isBitSet(1) = " . $cbitarray->isBitSet(1));
	printbr("cbitarray->isBitSet(2) = " . $cbitarray->isBitSet(2));
		
	// converting bit to a binary string
	printbr("cbitarray->toBinaryString() = " . $cbitarray->toBinaryString());
	printbr("cbitarray->clearBit(0) = " . $cbitarray->clearBit(0));
	//printbr("cbitarray->clearBit(1) = " . $cbitarray->clearBit(1);
		
	// converting bit to a binary string
	printbr("cbitarray->toBinaryString() = " . $cbitarray->toBinaryString());
		
	// converting bit to a string
	printbr("cbitarray->toString() = " . $cbitarray->toString());
		
	// testing the create from string 
	$cbitarray2 = new CBitArray();
	
	// create the Bit Array object	
	if( $cbitarray2 == NULL || $cbitarray2->createFromString( $cbitarray->toString() ) == false )
	{
		printbr("ERROR: couldn't created CBitArray from a string!");
		return;
	} // end if
	else printbr("SUCCESS: created CBitArray from a string!");
		
	// converting bit to a binary string
	printbr("cbitarray2->toBinaryString() = " . $cbitarray2->toBinaryString());
		
	// converting bit to a string
	printbr("cbitarray2->toString() = " . $cbitarray2->toString());
	printbr();
return ob_end();
*/
	} // end innerhtml()
} // end CBitArrayProgram
?>