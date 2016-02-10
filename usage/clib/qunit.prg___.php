<?php
//---------------------------------------------------------------------------
// name: qunit_prg.prg.php
// desc: demonstates how to use qunit_prg
//---------------------------------------------------------------------------

// includes
include_program("qunit_prg");
include_unittest("CUnitTest2");

//---------------------------------------------
// name: CUnitTest2
// desc: my unit test class
//---------------------------------------------
class CUnitTest2 extends CUnitTest {
	public function testCUnitTestClass() {
        $this->assertTrue(1==1);	
    } // end testCUnitTestClass()
} // end CUnitTest2(()

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
	
	/*
	QUnit.test( "hello test", function( assert ) {
		assert.ok( 1 == "1", "Passed!" );
		assert.ok( 2 == "2", "Passed!" );
		
		var actual = '1';
		var expected = 1;
		assert.ok(actual == expected, 'Truthy!');
		assert.equal(actual, expected, '.... are Equal');
		
		
	}); // end test()


	QUnit.test( "hello test2", function( assert ) {
		assert.ok( 1 == "1", "Passed!" );
		assert.ok( 2 == "2", "Passed!" );
		
		var actual = '1';
		var expected = 1;
		assert.ok(actual == expected, 'Truthy!');
		assert.equal(actual, expected, '.... are Equal');
		
		
	}); // end test()
*/
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