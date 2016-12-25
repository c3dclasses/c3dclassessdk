<?php
//---------------------------------------------------------------------------
// file: cmath.tst.php
// desc: demonstrates how to to use the cmath object
//---------------------------------------------------------------------------

// includes
include_unittest("CMathUnitTest");

//-----------------------------------------------------
// name: CMathUnitTest
// desc: demonstrates how to to use the cmath object
//-----------------------------------------------------
class CMathUnitTest extends CUnitTest {
	public function CMathUnitTest() { 
		parent :: CUnitTest();	
	} // end CMathUnitTest()
	
	// test method
	public function testCMath() {
		$this->assertTrue(CMath::abs(-4.0) == 4);
		$this->assertTrue(CMath::round(CMath::acos(0.2)) == 1);
		$this->assertTrue(CMath::round(CMath::asin(0.4)) == 0);
		$this->assertTrue(CMath::round(CMath::sin(0.8)) == 1);
		$this->assertTrue(CMath::round(CMath::cos(1.0)) == 1);
		$this->assertTrue(CMath::max(array(5,7,2,8,6)) == 8);
		$this->assertTrue(CMath::min(array(5,7,2,8,6)) == 2);
		$this->assertTrue(CMath::pow(2,4) == 16);
		$this->assertTrue(CMath::$PI == 3.141592653589793);
		$this->assertTrue(CMath::floor((CMath::rand()*10)+1)); 
		$this->assertTrue(CMath::floor((CMath::rand()*10)+1)); 
		$this->assertTrue(CMath::round(5.666) == 6); 
		$this->assertTrue(CMath::round(8.266) == 8); 
		$this->assertTrue(CMath::in(7,8,10) == false);
		$this->assertTrue(CMath::in(11,9,10) == false);
		$this->assertTrue(CMath::in(9,8,10) == true);
		$this->assertTrue(CMath::bound(7,8,10) == 8);
		$this->assertTrue(CMath::bound(11,9,10) == 10);
		$this->assertTrue(CMath::bound(9,8,10) == 9);
		$this->assertTrue(CMath::round(8.266) == 8); 
	} // end testCMath()
} // end CMathProgram

ob_start();
?>
<script parse="true" location="footer">
//-----------------------------------------------------
// name: CMathUnitTest
// desc: demonstrates how to to use the ccontent object
//-----------------------------------------------------
include_unittest("CMathUnitTest");
var CMathUnitTest = new Class ({ 
    Extends: CUnitTest,
	
	// test method
	testCMath : function() {
		this.assertTrue(CMath.abs(-4.0) == 4);
		this.assertTrue(CMath.round(CMath.acos(0.2)) == 1);
		this.assertTrue(CMath.round(CMath.asin(0.4)) == 0);
		this.assertTrue(CMath.round(CMath.sin(0.8)) == 1);
		this.assertTrue(CMath.round(CMath.cos(1.0)) == 1);
		this.assertTrue(CMath.max(5,7,2,8,6) == 8);
		this.assertTrue(CMath.min(5,7,2,8,6) == 2);
		this.assertTrue(CMath.pow(2,4) == 16);
		this.assertTrue(CMath.PI == 3.141592653589793);
		this.assertTrue(CMath.floor((CMath.rand()*10)+1)); 
		this.assertTrue(CMath.floor((CMath.rand()*10)+1)); 
		this.assertTrue(CMath.round(5.666) == 6); 
		this.assertTrue(CMath.round(8.266) == 8); 
		this.assertTrue(CMath.in(7,8,10) == false);
		this.assertTrue(CMath.in(11,9,10) == false);
		this.assertTrue(CMath.in(9,8,10) == true);
		this.assertTrue(CMath.bound(7,8,10) == 8);
		this.assertTrue(CMath.bound(11,9,10) == 10);
		this.assertTrue(CMath.bound(9,8,10) == 9);
		this.assertTrue(CMath.round(8.266) == 8); 	
	}, // end testCMath()
}); // end CMathProgram
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
?>