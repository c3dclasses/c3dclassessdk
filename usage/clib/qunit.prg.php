<?php
//---------------------------------------------------------------------------
// name: qunit_prg.prg.php
// desc: demonstates how to use qunit_prg
//---------------------------------------------------------------------------

// includes
include_program("qunit_prg");

//---------------------------------------------
// name: CUnitTest2
// desc: my unit test class
//---------------------------------------------
include_unittest("CUnitTest2");
class CUnitTest2 extends CUnitTest {
	public function testCUnitTestClass() {
        $this->assertTrue(1==1);	
    } // end testCUnitTestClass()
} // end CUnitTest2(()

ob_start();
?>
<script parse="true" location="footer">
CUnitTest.register("CUnitTest2");
var CUnitTest2 = new Class({
	Extends: CUnitTest,
	testCUnitTestClass:function() {
       this.m_assert.ok( 1 == "1", "Passed!" );	
    } // end testCUnitTestClass()
}); // end CUnitTest2
CUnitTest.register("CUnitTest3");
var CUnitTest3 = new Class({
	Extends: CUnitTest,
	testCUnitTestClass:function() {
       this.m_assert.ok( 1 == "1", "Passed!" );	
    } // end testCUnitTestClass()
}); // end CUnitTest2

</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later

//---------------------------------------------------
// name: qunit_prg
// desc: demonstatrates how to use minify_prg
//---------------------------------------------------
class qunit_prg extends CProgram{
	public function qunit_prg(){ 
		parent :: CProgram();	
	} // end minify_prg()
	
	public function c_main(){
return <<<SCRIPT
	console.log(this.jq());
	this.jq().css("background","red");
	CUnitTest.doTest(this.jq());
SCRIPT;
	} // end c_main()
		
	// rendering methods
	public function innerhtml(){
ob_start();
	CUnitTest :: doTest();
return ob_end();
	} // end innerhtml()
} // end qunit_prg
?>