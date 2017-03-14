<?php
//---------------------------------------------------------------------------
// file: cpoint.tst.php
// desc: demonstrates how to to use the cpoint object
//---------------------------------------------------------------------------

// includes
include_unittest("CPointUnitTest");

//-----------------------------------------------------
// name: CPointUnitTest
// desc: demonstrates how to to use the cpoint object
//-----------------------------------------------------
class CPointUnitTest extends CUnitTest {
	public function CPointUnitTest() { 
		parent :: CUnitTest();	
	} // end CPointUnitTest()
	
	// test method
	public function testCPoint() {
		$cpoint = new CPoint();
		$cpoint->set(300, 400, 500);
		$this->assertTrue($cpoint->x===300);
		$this->assertTrue($cpoint->y===400);
		$this->assertTrue($cpoint->z===500);
		
		$cpoint->translate(5, 5, 5);
		$this->assertTrue($cpoint->x===305);
		$this->assertTrue($cpoint->y===405);
		$this->assertTrue($cpoint->z===505);	
	} // end testCPoint()
} // end CPointProgram

ob_start();
?>
<script parse="true" location="footer">
//-----------------------------------------------------
// name: CPointUnitTest
// desc: demonstrates how to to use the ccontent object
//-----------------------------------------------------
include_unittest("CPointUnitTest");
var CPointUnitTest = new Class ({ 
    Extends: CUnitTest,	
	// test method
	testCPoint : function() {
		cpoint = new CPoint();
		cpoint.set(300, 400, 500);
		this.assertTrue(cpoint.x===300);
		this.assertTrue(cpoint.y===400);
		this.assertTrue(cpoint.z===500);
		
		cpoint.translate(5, 5, 5);
		this.assertTrue(cpoint.x===305);
		this.assertTrue(cpoint.y===405);
		this.assertTrue(cpoint.z===505);	
	} // end testCPoint
}); // end CPointProgram
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
?>