<?php
//---------------------------------------------------------------------------
// name: cbitarray.tst.php
// desc: test the cbitarray class
//---------------------------------------------------------------------------

//---------------------------------------------------
// name: CBitArrayUnitTest
// desc: hello world program
//---------------------------------------------------
include_unittest("CBitArrayUnitTest");
class CBitArrayUnitTest extends CUnitTest{
	// rendering methods
	public function testCBitArray(){
		$cbitarray = new CBitArray();
		$this->assertTrue($cbitarray != NULL);
		$this->assertTrue($cbitarray->create(56) != false);
		$cbitarray->setBit(0);
		$cbitarray->setBit(1);
		$cbitarray->enableBit(20, true);
		$this->assertTrue($cbitarray->isBitSet(0));
		$this->assertTrue($cbitarray->isBitSet(1));
		$this->assertFalse($cbitarray->isBitSet(2));
		$this->assertTrue("000000000000000000000000000000000000100000000000000000011"==$cbitarray->toBinaryString());
		$cbitarray->clearBit(0);
		$this->assertTrue("000000000000000000000000000000000000100000000000000000010"==$cbitarray->toBinaryString());
		$cbitarray->clearBit(1);
		$this->assertTrue("000000000000000000000000000000000000100000000000000000000"==$cbitarray->toBinaryString());
		$this->assertTrue($cbitarray->toDecimalString()=="56 1 1048576 0");
		
		$cbitarray2 = new CBitArray();
		$this->assertTrue($cbitarray2 != NULL);
		$this->assertTrue($cbitarray2->createFromString( $cbitarray->toDecimalString() ) != false);
		$this->assertTrue($cbitarray->toBinaryString()==$cbitarray->toBinaryString());
		$this->assertTrue($cbitarray2->toDecimalString()==$cbitarray->toDecimalString());
	} // end testCBitArray()
} // end CBitArrayUnitTest
ob_start();
?>
<script parse="true" location="footer">
//---------------------------------------------------
// name: CBitArrayUnitTest
// desc: hello world program
//---------------------------------------------------
include_unittest("CBitArrayUnitTest");
var CBitArrayUnitTest = new Class ({ 
	// meta data
    Extends: CUnitTest,  
	// rendering methods
	testCBitArray : function() {
		var cbitarray = new CBitArray();
		this.assertTrue(cbitarray != null);
		this.assertTrue(cbitarray.create(56) != false);
		cbitarray.setBit(0);
		cbitarray.setBit(1);
		cbitarray.enableBit(20, true);
		this.assertTrue(cbitarray.isBitSet(0));
		this.assertTrue(cbitarray.isBitSet(1));
		this.assertFalse(cbitarray.isBitSet(2));
		this.assertTrue("000000000000000000000000000000000000100000000000000000011"==cbitarray.toBinaryString());
		cbitarray.clearBit(0);
		this.assertTrue("000000000000000000000000000000000000100000000000000000010"==cbitarray.toBinaryString());
		cbitarray.clearBit(1);
		this.assertTrue("000000000000000000000000000000000000100000000000000000000"==cbitarray.toBinaryString());
		this.assertTrue(cbitarray.toDecimalString()=="56 1 1048576 0");
	
		cbitarray2 = new CBitArray();
		this.assertTrue(cbitarray2 != null);
		this.assertTrue(cbitarray2.createFromString( cbitarray.toDecimalString()) != false);
		this.assertTrue(cbitarray2.toBinaryString()==cbitarray.toBinaryString());
		this.assertTrue(cbitarray2.toDecimalString()==cbitarray.toDecimalString());
	} // end testCBitArray()
}); // end CBitArrayUnitTest
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
?>