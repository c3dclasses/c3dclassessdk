<?php
//---------------------------------------------------------------------------
// file: cpath.tst.php
// desc: demonstrates how to to use the cpath object
//---------------------------------------------------------------------------

// includes
include_unittest("CPathUnitTest");

//-----------------------------------------------------
// name: CPathUnitTest
// desc: demonstrates how to to use the cpath object
//-----------------------------------------------------
class CPathUnitTest extends CUnitTest {
	public function CPathUnitTest() { 
		parent :: CUnitTest();	
	} // end CPathUnitTest()
	
	// test method
	public function testCPath() {
		include_path("CPathUnitTest", "C:/foo/foo/foo/foo.txt");
		$this->assertTrue(CPath :: _("CPathUnitTest") == "C:/foo/foo/foo/foo.txt");		
	} // end testCPath()
} // end CPathProgram

ob_start();
?>
<script parse="true" location="footer">
//-----------------------------------------------------
// name: CPathUnitTest
// desc: demonstrates how to to use the ccontent object
//-----------------------------------------------------
include_unittest("CPathUnitTest");
var CPathUnitTest = new Class ({ 
    Extends: CUnitTest,	
	// test method
	testCPath : function() {
		include_path("CPathUnitTest", "C:/foo/foo/foo/foo.txt");
		this.assertTrue(CPath._("CPathUnitTest") == "C:/foo/foo/foo/foo.txt");
	}, // end testCPath()
}); // end CPathProgram
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
?>