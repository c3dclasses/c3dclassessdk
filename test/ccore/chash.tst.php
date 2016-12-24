<?php
//---------------------------------------------------------------------------
// file: chash.tst.php
// desc: demonstrates how to to use the chash object
//---------------------------------------------------------------------------

// includes
include_unittest("CHashUnitTest");

//-----------------------------------------------------
// name: CHashUnitTest
// desc: demonstrates how to to use the carray object
//-----------------------------------------------------
class CHashUnitTest extends CUnitTest {
	public function CHashUnitTest() { 
		parent :: CUnitTest();	
	} // end CHashUnitTest()
	
	// test method
	public function testCHash(){		
		global $str;
		$str = "";
		$hash = new CHash();
		$this->assertTrue($hash);
		$this->assertTrue($hash->size()===0);
		$hash->set("01", "1234");
		$hash->set("02", "1235");
		$hash->set("03", "1235");
		$this->assertTrue($hash->size()===3);
		$this->assertCHashEquals($hash, chash(array("01"=>"1234","02"=>"1235","03"=>"1235")));
		$this->assertTrue($hash->get("01")==="1234");	
		$hash->remove("01");
		$this->assertCHashEquals($hash, chash(array("02"=>"1235","03"=>"1235")));
		$hash->clear();
		$this->assertTrue($hash->size()===0);
		$this->assertCHashEquals($hash, chash());
		$hash->set("01", "1234");
		$this->assertTrue($hash->size()===1);
		$this->assertCHashEquals($hash, chash(array("01"=>"1234")));
		$hash->set("01", "12389");
		$hash->set("02", "1235");
		$hash->set("03", "1235");
		$this->assertTrue($hash->size()===3);
		$this->assertCHashEquals($hash, chash(array("01"=>"12389","02"=>"1235","03"=>"1235")));
		$this->assertTrue($hash->keys()->toString() === carray("01","02","03")->toString());
		$this->assertTrue($hash->values()->toString() === carray("12389","1235","1235")->toString());
		$this->assertTrue($hash->containsKey("03"));
		$this->assertTrue($hash->containsValue("1235"));
		$hash->visit("chash_foo");
		$this->assertTrue($str === "0112389021235031235");
		$this->assertTrue($hash->toStringVisit("chash_foo_tostring") === "0112389021235031235");
	} // end testCHash()
	
	//---------------------------------------------
	// name: assertCHashEquals()
 	// desc: test if carrays equal each other
	//---------------------------------------------
	function assertCHashEquals($a1, $a2) {
		$this->assertTrue($a1->toJSON() === $a2->toJSON());
	} // end assertCHashEquals()
} // end CHashProgram

function chash_foo($index, $value){ global $str; $str .= $index . "" . $value; }
function chash_foo_tostring($index, $value){ return $index . "" . $value; }
		
ob_start();
?>
<script parse="true" location="footer">
//-----------------------------------------------------
// name: CHashUnitTest
// desc: demonstrates how to to use the carray object
//-----------------------------------------------------
include_unittest("CHashUnitTest");
var CHashUnitTest = new Class ({ 
    Extends: CUnitTest,
	
	// test method
	testCHash : function() {
		var str="";
		var chash_foo = function(index, value){ str += index + "" + value }
		var chash_foo_tostring = function(index, value){ return index + "" + value; }
		var hash = new CHash();
		this.assertTrue(hash);
		this.assertTrue(hash.size()===0);
		hash.set("01", "1234");
		hash.set("02", "1235");
		hash.set("03", "1235");
		this.assertTrue(hash.size()===3);
		this.assertCHashEquals(hash, chash({"01":"1234","02":"1235","03":"1235"}));
		this.assertTrue(hash.get("01")==="1234");	
		hash.remove("01");
		this.assertCHashEquals(hash, chash({"02":"1235","03":"1235"}));
		hash.clear();
		this.assertTrue(hash.size()===0);
		this.assertCHashEquals(hash, chash({}));
		hash.set("01", "1234");
		this.assertTrue(hash.size()===1);
		this.assertCHashEquals(hash, chash({"01":"1234"}));
		hash.set("01", "12389");
		hash.set("02", "1235");
		hash.set("03", "1235");
		this.assertTrue(hash.size()===3);
		this.assertCHashEquals(hash, chash({"01":"12389","02":"1235","03":"1235"}));
		this.assertTrue(hash.keys()._().toString() === "01,02,03");
		this.assertTrue(hash.values()._().toString() === "12389,1235,1235");
		this.assertTrue(hash.containsKey("03"));
		this.assertTrue(hash.containsValue("1235"));
		hash.visit(chash_foo);
		this.assertTrue(str === "0112389021235031235");
		this.assertTrue(hash.toStringVisit(chash_foo_tostring) === "0112389021235031235");
	}, // end testCHash()
	
	//---------------------------------------------
	// name: assertCHashEquals()
 	// desc: test if carrays equal each other
	//---------------------------------------------
	assertCHashEquals : function(a1, a2) {
 		this.assertTrue(a1.toJSON() == a2.toJSON());
	} // end assertCHashEquals()
}); // end CHashProgram
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
?>