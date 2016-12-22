<?php
//---------------------------------------------------------------------------
// name: cbitarray.tst.php
// desc: test the cbitarray class
//---------------------------------------------------------------------------

//---------------------------------------------------
// name: CBitUnitTest
// desc: hello world program
//---------------------------------------------------
include_unittest("CBitUnitTest");
class CBitUnitTest extends CUnitTest {
	// rendering methods
	public function testCBit(){
		$this->assertTrue(CBit::$BIT[0]==0);
		$this->assertTrue(CBit::$BIT[1]==1);
		$this->assertTrue(CBit::$BIT[2]==2);
		$this->assertTrue(CBit::$BIT[3]==4);
		$this->assertTrue(CBit::$BIT[4]==8);
		$this->assertTrue(CBit::$BIT[5]==16);
	} // end testCBit()
} // end CBitUnitTest
ob_start();
?>
<script parse="true" location="footer">
//---------------------------------------------------
// name: CBitUnitTest
// desc: hello world program
//---------------------------------------------------
include_unittest("CBitUnitTest");
var CBitUnitTest = new Class ({ 
	// meta data
    Extends: CUnitTest,  
	// rendering methods
	testCBit : function(){
		this.assertTrue(CBit.BIT[0]==0);
		this.assertTrue(CBit.BIT[1]==1);
		this.assertTrue(CBit.BIT[2]==2);
		this.assertTrue(CBit.BIT[3]==4);
		this.assertTrue(CBit.BIT[4]==8);
		this.assertTrue(CBit.BIT[5]==16);
	} // end testCBit()
}); // end CBitUnitTest
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
?>