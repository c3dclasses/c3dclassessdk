<?php
//---------------------------------------------------------------------------
// file: cconstant.tst.php
// desc: demonstrates how to to use the cconstant object
//---------------------------------------------------------------------------

// includes
include_unittest("CConstantUnitTest");

//-----------------------------------------------------
// name: CConstantUnitTest
// desc: demonstrates how to to use the cconstant object
//-----------------------------------------------------
class CConstantUnitTest extends CUnitTest {
	public function CConstantUnitTest() { 
		parent :: CUnitTest();	
	} // end CConstantUnitTest()
	
	// test method
	public function testCConstant() {
		$this->assertTrue(CConstants :: $TOP == 1);
		$this->assertTrue(CConstants :: $BOTTOM === 2);
		$this->assertTrue(CConstants :: $LEFT === 8);
		$this->assertTrue(CConstants :: $RIGHT === 4);
	} // end testCConstant()
} // end CConstantProgram

ob_start();
?>
<script parse="true" location="footer">
//-----------------------------------------------------
// name: CConstantUnitTest
// desc: demonstrates how to to use the ccontent object
//-----------------------------------------------------
include_unittest("CConstantUnitTest");
var CConstantUnitTest = new Class ({ 
    Extends: CUnitTest,
	
	// test method
	testCConstant : function() {
		this.assertTrue(CConstants.TOP == 1);
		this.assertTrue(CConstants.BOTTOM === 2);
		this.assertTrue(CConstants.LEFT === 8);
		this.assertTrue(CConstants.RIGHT === 4);
	}, // end testCConstant()
}); // end CConstantProgram
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
?>