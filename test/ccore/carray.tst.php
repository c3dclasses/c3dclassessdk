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
	} // end CArrayProgram()

/*
	public function c_main() {
return <<<SCRIPT
	printbr("<b>carray.js</b>");
    var a = new Array();
	this.assert(a);
    a.push(8);
    printbr("Length: " + a.length);
    a.push(10, 20, 30);
    printbr("Length: " + a.length);
    printbr(a.toString());
    a.pop();
    printbr(a.toString());
    a.shift();
    printbr(a.toString());
    a.unshift(50, 60, 70);
    printbr(a.toString());
    printbr(a.reverse().toString());
	printbr(a.valueOf());
	printbr();
	printbr(a.splice(0, 3).toString());
    printbr(a.toString());
	a.push(10, 20, 30, 40, 50, 60, 70, 80, 200, 210, 220);
    printbr(a.toString());
	a.sort(carray_cmp);
    printbr(a.toString());
	printbr(a.lastIndexOf(40));
    printbr(a.join(":"));
    printbr(a.indexOf(30));
    printbr(a.slice(0, 3).toString());
	printbr("indexed value is: " + a._()[0]);
	a._()[0] = 2000;
	printbr("indexed value is: " + a._()[0]);
	a.visit(carray_foo);
	printbr(a.toString());
    a.remove(40);
	printbr(a.toString());
	a.removeAll(50);
	printbr(a.toString());
	a.removeAt(2);
	printbr(a.toString());
	a.shuffle();
	printbr("a.shuffle():" + a.toString());
	a.insertAt(0, 5599);
	printbr("a.insertAt(0,5599): " + a.toString());
	printbr();
SCRIPT;
	} // end load()
*/
	
	// test method
	public function testCArray(){
    $a = new CArray();
    $this->assertTrue($a);
	$a->push(8);
	$this->assertTrue($a->length()==1);
    $a->push(10, 20, 30);
	$this->assertTrue($a->length()==4);
   	$this->assertTrue($a->toString()==carray(8,10,20,30)->toString());
    $a->pop();
  	$this->assertTrue($a->toString()==carray(8,10,20)->toString());
	$a->shift();
	$this->assertTrue($a->toString()==carray(10,20)->toString());
	$a->unshift(50, 60, 70);
    $this->assertTrue($a->toString()==carray(50,60,70,10,20)->toString());
	$this->assertTrue($a->reverse()->toString()==carray(20,10,70,60,50)->toString());
	echo carray($a->valueOf())->toString();
	$this->assertTrue(carray($a->valueOf())->toString()==carray(20,10,70,60,50)->toString());
	$this->assertTrue($a->splice(0, 3)->toString()==carray(20,10,70)->toString());
	$this->assertTrue($a->toString()==carray(60,50)->toString());
	$a->push(10, 20, 30, 40, 50, 60, 70, 80, 200, 210, 220);
    $this->assertTrue($a->length()==13);
    $this->assertTrue($a->toString()==carray(60, 50, 10, 20, 30, 40, 50, 60, 70, 80, 200, 210, 220)->toString());
	$this->assertTrue($a->lastIndexOf(40)==5);
    $this->assertTrue($a->join(":") == implode(":", array(60, 50, 10, 20, 30, 40, 50, 60, 70, 80, 200, 210, 220)));
  	$this->assertTrue($a->indexOf(30)==4);
    $this->assertTrue($a->slice(0, 3)->toString()==carray(60,50,10)->toString());

	$a->sort("carray_cmp");
	
/*
    $a->remove(40);
    $this->assertTrue($a->toString()==carray(60, 50, 10, 20, 30, 50, 60, 70, 80, 200, 210, 220)->toString());
   	$a->removeAll(50);
	echo $a->toString();
   	$this->assertTrue($a->toString()==carray(60, 10, 20, 30, 60, 70, 80, 200, 210, 220)->toString());
 	$a->removeAt(2);
	echo $a->toString();
   	$this->assertTrue($a->toString()==carray(60, 10, 30, 60, 70, 80, 200, 210, 220)));
   	$a->insertAt(0, 5599);
   	$this->assertTrue($a->toString()==carray(5599, 60, 10, 30, 60, 70, 80, 200, 210, 220))); 
*/   
   //printbr($a->slice(0, 3)->toString());
    
	
/*	
	printbr($a->toString());
	$a->sort("carray_cmp");
	printbr($a->toString()); 
 	$a->visit("carray_foo");
	printbr($a->toString());

	$a->shuffle();
	printbr("a->shuffle(): " . $a->toString());
	$a->insertAt(0, 5599);
	printbr("a->insertAt(0,5599): " . $a->toString());
*/

	} // end innerhtml()
} // end CArrayProgram

//------------------------------------------------------
// name: cmp(), foo()
// desc: used in the sort function below
//------------------------------------------------------
function carray_cmp($a, $b) { if ($a == $b) { return 0; } return ($a < $b) ? -1 : 1; }
function carray_foo($index, $value) { printbr("a[" . $index . "] = " . $value); }

/*
//------------------------------------------------------
// name: cmp(), foo()
// desc: used in the javascript sort function below
//------------------------------------------------------
ob_start();	// insert this as a script function
?>
function carray_cmp(a, b) { if (a == b) { return 0; } return (a < b) ? -1 : 1; }
function carray_foo(index, value) { printbr("a[" + index + "] = " + value); }
<?php
ob_end_queue("script");
?>
*/
?>