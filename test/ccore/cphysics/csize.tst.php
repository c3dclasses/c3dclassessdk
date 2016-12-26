<?php
//---------------------------------------------------------------------------
// file: csize.tst.php
// desc: demonstrates how to to use the csize object
//---------------------------------------------------------------------------

// includes
include_unittest("CSizeUnitTest");

//-----------------------------------------------------
// name: CSizeUnitTest
// desc: demonstrates how to to use the csize object
//-----------------------------------------------------
class CSizeUnitTest extends CUnitTest {
	public function CSizeUnitTest() { 
		parent :: CUnitTest();	
	} // end CSizeUnitTest()
	
	// test method
	public function testCSize() {
		$csize = new CSize();
		$csize->set(100,200,300);
		$this->assertTrue($csize->w===100);
		$this->assertTrue($csize->h===200);
		$this->assertTrue($csize->l===300);
		$csize->scale(0.5,2.0,1.5);
		$this->assertTrue($csize->w==50);
		$this->assertTrue($csize->h==400);
		$this->assertTrue($csize->l==450);
	} // end testCSize()
} // end CSizeProgram

ob_start();
?>
<script parse="true" location="footer">
//-----------------------------------------------------
// name: CSizeUnitTest
// desc: demonstrates how to to use the ccontent object
//-----------------------------------------------------
include_unittest("CSizeUnitTest");
var CSizeUnitTest = new Class ({ 
    Extends: CUnitTest,	
	// test method
	testCSize : function() {
		var csize = new CSize();
		csize.set(100,200,300);
		this.assertTrue(csize.w===100);
		this.assertTrue(csize.h===200);
		this.assertTrue(csize.l===300);
		csize.scale(0.5,2.0,1.5);
		this.assertTrue(csize.w==50);
		this.assertTrue(csize.h==400);
		this.assertTrue(csize.l==450);
	} // end testCSize
}); // end CSizeProgram
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
?>