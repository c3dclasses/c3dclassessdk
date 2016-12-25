<?php
//---------------------------------------------------------------------------
// file: cstdio.tst.php
// desc: demonstrates how to to use the cstdio object
//---------------------------------------------------------------------------

// includes
include_unittest("CStdioUnitTest");

//-----------------------------------------------------
// name: CStdioUnitTest
// desc: demonstrates how to to use the cstdio object
//-----------------------------------------------------
class CStdioUnitTest extends CUnitTest {
	public function CStdioUnitTest() { 
		parent :: CUnitTest();	
	} // end CStdioUnitTest()
	
	// test method
	public function testCStdio() {
		ob_start();
		print("A1");
		ob_end_queue("foo");
		ob_start();
		print("A2");
		ob_end_queue("foo");
		ob_start();
		print("A3");
		ob_end_queue("foo");
		ob_start();
		print("A4");
		ob_end_queue("foo");
		ob_start();
		print("A5");
		ob_end_queue("foo");		
		ob_start();
		print("B1");
		ob_end_queue("foo7");
		ob_start();
		print("B2");
		ob_end_queue("foo7");
		ob_start();
		print("B3");
		ob_end_queue("foo7");
		ob_start();
		print("B4");
		ob_end_queue("foo7");
		ob_start();
		print("B5");
		ob_end_queue("foo7");
		$this->assertTrue(ob_queue_dump("foo") == "A1A2A3A4A5");
		$this->assertTrue(ob_queue_dump("foo7") == "B1B2B3B4B5");
	} // end testCStdio()
} // end CStdioProgram

ob_start();
?>
<script parse="true" location="footer">
//-----------------------------------------------------
// name: CStdioUnitTest
// desc: demonstrates how to to use the ccontent object
//-----------------------------------------------------
include_unittest("CStdioUnitTest");
var CStdioUnitTest = new Class ({ 
    Extends: CUnitTest,	
	// test method
	testCStdio : function() {
		ob_start();
		_print("A1");
		ob_end_queue("foo");
		ob_start();
		_print("A2");
		ob_end_queue("foo");
		ob_start();
		_print("A3");
		ob_end_queue("foo");
		ob_start();
		_print("A4");
		ob_end_queue("foo");
		ob_start();
		_print("A5");
		ob_end_queue("foo");		
		ob_start();
		_print("B1");
		ob_end_queue("foo7");
		ob_start();
		_print("B2");
		ob_end_queue("foo7");
		ob_start();
		_print("B3");
		ob_end_queue("foo7");
		ob_start();
		_print("B4");
		ob_end_queue("foo7");
		ob_start();
		_print("B5");
		ob_end_queue("foo7");
		this.assertTrue(ob_queue_dump("foo") == "A1A2A3A4A5");
		this.assertTrue(ob_queue_dump("foo7") == "B1B2B3B4B5");	}, // end testCStdio()
}); // end CStdioProgram
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
?>