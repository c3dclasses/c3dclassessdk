<?php
//-------------------------------------------
// file: test.php
// desc: defines the test file
//-------------------------------------------

include_unittest("TestOfLogging");
class TestOfLogging extends CUnitTest {
    function testLogCreatesNewFileOnFirstMessage1() {
        $this->assertFalse(1==1);
        $this->assertTrue(1==1);	
    }
	
	function testLogCreatesNewFileOnFirstMessage2() {
        $this->assertFalse(0==1);
        $this->assertTrue(1==0);	
    }
	
	function testLogCreatesNewFileOnFirstMessage3() {
        $this->assertFalse(0==1);
        $this->assertTrue(1==1);	
    }
} // end TestOfLogging

include_unittest("TestOfLogging2");
class TestOfLogging2 extends CUnitTest {
    function testLogCreatesNewFileOnFirstMessage1() {
        $this->assertFalse(0==1);
        $this->assertTrue(1==1);	
    }
	
	function testLogCreatesNewFileOnFirstMessage2() {
        $this->assertFalse(0==1);
        $this->assertTrue(1==1);	
    }
	
	function testLogCreatesNewFileOnFirstMessage3() {
        $this->assertFalse(0==1);
        $this->assertTrue(1==1);	
    }
} // end TestOfLogging

include_unittest("TestOfLogging3");
class TestOfLogging3 extends CUnitTest {
    function testLogCreatesNewFileOnFirstMessage1() {
        $this->assertFalse(0==1);
        $this->assertTrue(0==1);	
    }
	
	function testLogCreatesNewFileOnFirstMessage2() {
        $this->assertFalse(0==1);
        $this->assertTrue(1==1);	
    }
	
	function testLogCreatesNewFileOnFirstMessage3() {
        $this->assertFalse(0==1);
        $this->assertTrue(1==1);	
    }
} // end TestOfLogging
?>