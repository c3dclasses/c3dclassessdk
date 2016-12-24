<?php
//---------------------------------------------------------------------------
// file: chook.tst.php
// desc: demonstrates how to to use the chook object
//---------------------------------------------------------------------------

// includes
include_unittest("CHookUnitTest");

//-----------------------------------------------------
// name: CHookUnitTest
// desc: demonstrates how to to use the chook object
//-----------------------------------------------------
class CHookUnitTest extends CUnitTest {
	public function CHookUnitTest() { 
		parent :: CUnitTest();		
	} // end CHookUnitTest()
		
	// test method
	public function testCHook() {	
		CHook :: add("hook_foo", "chook_foo1");
		CHook :: add("hook_foo", "chook_foo2");
		CHook :: add("hook_foo", "chook_foo3");
		CHook :: fire("hook_foo");
		$this->assertTrue(chook_result() === "in foo1in foo2in foo3");
		CHook :: remove("hook_foo", "chook_foo3");
		CHook :: fire("hook_foo");
		$this->assertTrue(chook_result() == "in foo1in foo2");
		CHook :: remove("hook_foo", "chook_foo2");
		CHook :: fire("hook_foo");
		$this->assertTrue(chook_result() == "in foo1");
		CHook :: remove("hook_foo", "chook_foo1");
		CHook :: fire("hook_foo");
		$this->assertTrue(chook_result() == "");		
		CHook :: remove("hook_foo");
		CHook :: fire("hook_foo");
		$this->assertTrue(chook_result() == "");
	} // end testCHook()
} // end CHookProgram

// hook callback methods
$strhook="";
function chook_foo1() { global $strhook; $strhook .= "in foo1"; }
function chook_foo2() { global $strhook; $strhook .= "in foo2"; }
function chook_foo3() { global $strhook; $strhook .= "in foo3"; }
function chook_result() { global $strhook; $out = $strhook; $strhook = ""; return $out; }

ob_start();
?>
<script parse="true" location="footer">
//-----------------------------------------------------
// name: CHookUnitTest
// desc: demonstrates how to to use the ccontent object
//-----------------------------------------------------
include_unittest("CHookUnitTest");
var CHookUnitTest = new Class ({ 
    Extends: CUnitTest,
	// test method

	testCHook : function() {
		CHook.add("hook_foo", chook_foo1);
		CHook.add("hook_foo", chook_foo2);
		CHook.add("hook_foo", chook_foo3);
		CHook.fire("hook_foo");
		this.assertTrue(chook_result() === "in foo1in foo2in foo3");
		CHook.remove("hook_foo", chook_foo3);
		CHook.fire("hook_foo");
		this.assertTrue(chook_result() == "in foo1in foo2");
		CHook.remove("hook_foo", chook_foo2);
		CHook.fire("hook_foo");
		this.assertTrue(chook_result() == "in foo1");
		CHook.remove("hook_foo", chook_foo1);
		CHook.fire("hook_foo");
		this.assertTrue(chook_result() == "");
		CHook.remove("hook_foo");
		CHook.fire("hook_foo");
		this.assertTrue(chook_result() == "");
	} // end testCHook()
}); // end CHookProgram

var strhook="";
function chook_foo1() { strhook += "in foo1"; }
function chook_foo2() { strhook += "in foo2"; }
function chook_foo3() { strhook += "in foo3"; }
function chook_result() { var out = strhook; strhook = ""; return out; }
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
?>