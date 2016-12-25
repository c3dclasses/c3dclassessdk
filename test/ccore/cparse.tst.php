<?php
//---------------------------------------------------------------------------
// file: cparse.tst.php
// desc: demonstrates how to to use the cparse object
//---------------------------------------------------------------------------

// includes
include_unittest("CParseUnitTest");

//-----------------------------------------------------
// name: CParseUnitTest
// desc: demonstrates how to to use the cparse object
//-----------------------------------------------------
class CParseUnitTest extends CUnitTest {
	public function CParseUnitTest() { 
		parent :: CUnitTest();	
	} // end CParseUnitTest()
	
	// test method
	public function testCParse() {
		$this->assertTrue((CParse::toInt("100") + 3) === 103);
		$this->assertTrue((CParse::toFloat("100.05") + 3) === 103.05);
		$this->assertTrue(CParse::toString(true) === "true");
		$this->assertTrue(CParse::toString(false) === "false");
		$jsonobj = array("name1"=>"value1","name2"=>"value2","name3"=>"value3");
		$jsonstr = '{"name1":"value1","name2":"value2","name3":"value3"}';
		$this->assertTrue(CParse::toJSONString($jsonobj) === $jsonstr);
		$this->assertTrue(print_r(CParse::toJSONObject($jsonstr),true) === print_r($jsonobj,true));
	} // end testCParse()
} // end CParseUnitTest

ob_start();
?>
<script parse="true" location="footer">
//-----------------------------------------------------
// name: CParseUnitTest
// desc: demonstrates how to to use the ccontent object
//-----------------------------------------------------
include_unittest("CParseUnitTest");
var CParseUnitTest = new Class ({ 
    Extends: CUnitTest,	
	
	// test method
	testCParse : function() {
		this.assertTrue((CParse.toInt("100") + 3) === 103);
		this.assertTrue((CParse.toFloat("100.05") + 3) === 103.05);
		this.assertTrue(CParse.toString(true) === "true");
		this.assertTrue(CParse.toString(false) === "false");
		var jsonobj = {"name1":"value1","name2":"value2","name3":"value3"};
		var jsonstr = '{"name1":"value1","name2":"value2","name3":"value3"}';
		this.assertTrue(CParse.toJSONString(jsonobj) === jsonstr);
		this.assertTrue(print_r(CParse.toJSONObject(jsonstr),true) === print_r(jsonobj,true));
	}, // end testCParse()
}); // end CParseUnitTest
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
?>