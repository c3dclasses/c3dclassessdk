<?php
//---------------------------------------------------------------------------
// file: carray.prg.php
// desc: demonstrates how to to use the carray object
//---------------------------------------------------------------------------

// includes
include_unittest("CArrayUnitTest");

//-----------------------------------------------------
// name: CArrayUnitTest
// desc: demonstrates how to to use the carray object
//-----------------------------------------------------
class CArrayUnitTest extends CUnitTest {
	public function CArrayUnitTest() { 
		parent :: CUnitTest();	
	} // end CArrayUnitTest()
	
	// test method
	public function testCArray(){
		global $str;
		$a = new CArray();
		$this->assertTrue($a);
		$a->push(8);
		$this->assertTrue($a->length()==1);
		$a->push(10, 20, 30);
		$this->assertTrue($a->length()==4);
		$this->assertCArrayEquals($a, carray(8,10,20,30));
		$a->pop();
		$this->assertCArrayEquals($a,carray(8,10,20));
		$a->shift();
		$this->assertCArrayEquals($a,carray(10,20));
		$a->unshift(50, 60, 70);
		$this->assertCArrayEquals($a,carray(50,60,70,10,20));
		$this->assertCArrayEquals($a->reverse(),carray(20,10,70,60,50));	
		$this->assertCArrayEquals($a,carray(50,60,70,10,20));
		$this->assertCArrayEquals($a->splice(0, 3), carray(50,60,70));
		$this->assertCArrayEquals($a,carray(10,20));
		$a->push(10, 20, 30, 40, 50, 60, 70, 80, 200, 210, 220);
		$this->assertTrue($a->length()==13);
		$this->assertCArrayEquals($a,carray(10, 20, 10, 20, 30, 40, 50, 60, 70, 80, 200, 210, 220));
		$this->assertTrue($a->lastIndexOf(40)==5);
		$this->assertTrue($a->join(":") == carray(10, 20, 10, 20, 30, 40, 50, 60, 70, 80, 200, 210, 220)->join(":"));
		$this->assertTrue($a->indexOf(30)==4);  
		$this->assertCArrayEquals($a->slice(0, 3),carray(10,20,10));
		$a->remove(10);
		$this->assertCArrayEquals($a,carray(20, 10, 20, 30, 40, 50, 60, 70, 80, 200, 210, 220));
		$a->removeAll(20);
		$this->assertCArrayEquals($a,carray(10, 30, 40, 50, 60, 70, 80, 200, 210, 220));
		$a->sort("carray_cmp");
		$this->assertCArrayEquals($a,carray(10, 30, 40, 50, 60, 70, 80, 200, 210, 220));
		$a->removeAt(2);
		$this->assertCArrayEquals($a,carray(10, 30, 50, 60, 70, 80, 200, 210, 220));	
		$a->insertAt(0, 5599);
		$this->assertCArrayEquals($a,carray(5599,10, 30, 50, 60, 70, 80, 200, 210, 220)); 
		$a->insertAt(10, 5599);
		$this->assertCArrayEquals($a,carray(5599,10, 30, 50, 60, 70, 80, 200, 210, 220, 5599)); 
		$a->sort("carray_cmp");
		$this->assertCArrayEquals($a,carray(10, 30, 50, 60, 70, 80, 200, 210, 220, 5599, 5599));
		$a->visit("carray_foo");
		$this->assertTrue($str=="10305060708020021022055995599"); 
		$str=""; 		
		$a->shuffle();
		$this->assertTrue($a->length()==carray(10, 30, 50, 60, 70, 80, 200, 210, 220, 5599, 5599)->length());
	} // end innerhtml()
	
	//---------------------------------------------
	// name: assertCArrayEquals()
 	// desc: test if carrays equal each other
	//---------------------------------------------
	function assertCArrayEquals($a1, $a2) {
 		$this->assertTrue($a1->toString() == $a2->toString());
	} // end carrayEquals()
} // end CArrayProgram

//------------------------------------------------------
// name: cmp(), foo()
// desc: used in the sort function below
//------------------------------------------------------
function carray_cmp($a, $b) { if ($a == $b) { return 0; } return ($a < $b) ? -1 : 1; }
$str="";
function carray_foo($index, $value) { global $str; $str .= $value; }

ob_start();
?>
<script parse="true" location="footer">
//-----------------------------------------------------
// name: CArrayUnitTest
// desc: demonstrates how to to use the carray object
//-----------------------------------------------------
include_unittest("CArrayUnitTest");
var CArrayUnitTest = new Class ({ 
    Extends: CUnitTest,
	
	// test method
	testCArray : function() {
		//this.assertTrue(false);
		//global str;
		//a = new CArray();
		alert("testing");
		
		var a = [];
		this.assertTrue(a);
		a.push(8);
		this.assertTrue(a.length==1);
		a.push(10, 20, 30);
		this.assertTrue(a.length==4);
		this.assertCArrayEquals(a, [8,10,20,30]);
		a.pop();
		this.assertCArrayEquals(a,[8,10,20]);
		a.shift();
		this.assertCArrayEquals(a,[10,20]);
		a.unshift(50, 60, 70);
		this.assertCArrayEquals(a,[50,60,70,10,20]);
		this.assertCArrayEquals(a.reverse(),[20,10,70,60,50]);	
		this.assertCArrayEquals(a,[50,60,70,10,20]);
		
		/*
		this.assertCArrayEquals(a.splice(0, 3), [50,60,70]);
		*/
		/*
		this.assertCArrayEquals(a,[10,20]);
		a.push(10, 20, 30, 40, 50, 60, 70, 80, 200, 210, 220);
		this.assertTrue(a.length()==13);
		this.assertCArrayEquals(a,[10, 20, 10, 20, 30, 40, 50, 60, 70, 80, 200, 210, 220]);
		this.assertTrue(a.lastIndexOf(40)==5);
		this.assertTrue(a.join(":") == [10, 20, 10, 20, 30, 40, 50, 60, 70, 80, 200, 210, 220].join(":"));
		this.assertTrue(a.indexOf(30)==4);  
		this.assertCArrayEquals(a.slice(0, 3),[10,20,10]);
		
		/*
		a.remove(10);
		this.assertCArrayEquals(a,[20, 10, 20, 30, 40, 50, 60, 70, 80, 200, 210, 220]);
		a.removeAll(20);
		this.assertCArrayEquals(a,[10, 30, 40, 50, 60, 70, 80, 200, 210, 220]);
		a.sort(carray_cmp);
		this.assertCArrayEquals(a,[10, 30, 40, 50, 60, 70, 80, 200, 210, 220]);
		a.removeAt(2);
		this.assertCArrayEquals(a,[10, 30, 50, 60, 70, 80, 200, 210, 220]);	
		a.insertAt(0, 5599);
		this.assertCArrayEquals(a,[5599,10, 30, 50, 60, 70, 80, 200, 210, 220]); 
		a.insertAt(10, 5599);
		this.assertCArrayEquals(a,[5599,10, 30, 50, 60, 70, 80, 200, 210, 220, 5599]); 
		a.sort(carray_cmp);
		this.assertCArrayEquals(a,[10, 30, 50, 60, 70, 80, 200, 210, 220, 5599, 5599]);
		a.visit(carray_foo);
		this.assertTrue(str=="10305060708020021022055995599"); 
		str=""; 		
		a.shuffle();
		this.assertTrue(a.length==[10, 30, 50, 60, 70, 80, 200, 210, 220, 5599, 5599].length);
		*/
	}, // end innerhtml()
	
	//---------------------------------------------
	// name: assertCArrayEquals()
 	// desc: test if carrays equal each other
	//---------------------------------------------
	assertCArrayEquals : function(a1, a2) {
 		this.assertTrue(a1.toString() == a2.toString());
	} // end carrayEquals()
}); // end CArrayProgram
//------------------------------------------------------
// name: cmp(), foo()
// desc: used in the sort function below
//------------------------------------------------------
function carray_cmp(a, b) { if (a == b) { return 0; } return (a < b) ? -1 : 1; }
var str="";
function carray_foo(index, value) { str; str += value; }
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
?>