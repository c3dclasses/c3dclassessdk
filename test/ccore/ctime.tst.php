<?php
//---------------------------------------------------------------------------
// file: ctime.tst.php
// desc: demonstrates how to to use the ctime object
//---------------------------------------------------------------------------

// includes
include_unittest("CTimeUnitTest");

//-----------------------------------------------------
// name: CTimeUnitTest
// desc: demonstrates how to to use the ctime object
//-----------------------------------------------------
class CTimeUnitTest extends CUnitTest {
	public function CTimeUnitTest() { 
		parent :: CUnitTest();	
	} // end CTimeUnitTest()
	
	// test method
	public function testCTime() {
		$this->assertTrue(CTime::us()*.001 == CTime::ms());		
		$this->assertTrue(CTime::ms()*.001 == CTime::s());		
	} // end testCTime()
} // end CTimeProgram

ob_start();
?>
<script parse="true" location="footer">
//-----------------------------------------------------
// name: CTimeUnitTest
// desc: demonstrates how to to use the ccontent object
//-----------------------------------------------------
include_unittest("CTimeUnitTest");
var CTimeUnitTest = new Class ({ 
    Extends: CUnitTest,	
	// test method
	testCTime : function() {
		this.assertTrue(CTime.us()*.001 == CTime.ms());		
		this.assertTrue(CTime.ms()*.001 == CTime.s());		
	} // end testCTime
}); // end CTimeProgram
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
?>