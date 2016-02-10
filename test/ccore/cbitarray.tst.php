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
		// allocate a Bit Array structure
		$cbitarray = new CBitArray();
		$this->assertTrue($cbitarray != NULL);
		$this->assertTrue($cbitarray->create(56) != false);
	} // end innerhtml()
} // end CBitArrayUnitTest

// put script code here
ob_start();
?>
<script parse="true" location="footer">
//---------------------------------------------------
// name: CBitArrayUnitTest
// desc: hello world program
//---------------------------------------------------
include_unittest("CBitArrayUnitTest");
var CBitArrayUnitTest = new Class
({ 
	// meta data
    Extends: CUnitTest,  
	// rendering methods
	testCBitArray : function(){
		this.m_assert.ok( 1 == "1", "Passed!" );
		this.m_assert.ok( 2 == "2", "Passed!" );
	} // end innerhtml()
}); // end CBitArrayUnitTest
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
?>