<?php
//---------------------------------------------------------------------------
// file: carray.prg.php
// desc: demonstrates how to to use the carray object
//---------------------------------------------------------------------------

// includes
include_program("CArrayProgram");

//-----------------------------------------------------
// name: CArrayProgram
// desc: demonstrates how to to use the carray object
//-----------------------------------------------------
class CArrayProgram extends CProgram {
	public function CArrayProgram() { 
		parent :: CProgram();	
	} // end CArrayProgram()
	
	public function c_main() {
return <<<SCRIPT
	printbr("<b>carray.js</b>");
    var a = new Array();
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
	
	// rendering methods
	public function innerhtml() {
ob_start();
	printbr("<b>carray.php</b>");
    $a = new CArray();
    $a->push(8);
    printbr("Length: " . $a->length());
    $a->push(10, 20, 30);
    printbr("Length: " . $a->length());
    printbr($a->toString());
    $a->pop();
    printbr($a->toString());
    $a->shift();
    printbr($a->toString());
    $a->unshift(50, 60, 70);
    printbr($a->toString());
    printbr($a->reverse()->toString());
	print_r($a->valueOf());
	printbr();
    printbr($a->splice(0, 3)->toString());
    printbr($a->toString());
	$a->push(10, 20, 30, 40, 50, 60, 70, 80, 200, 210, 220);
    printbr($a->toString());
	$a->sort("carray_cmp");
    printbr($a->toString());
    printbr("lastIndexOf(40): " . $a->lastIndexOf(40));
    printbr($a->join(":"));
    printbr("indexOf(30): " . $a->indexOf(30));
    printbr($a->slice(0, 3)->toString());
	$a->visit("carray_foo");
	printbr($a->toString());
    $a->remove(40);
	printbr($a->toString());
	$a->removeAll(50);
	printbr($a->toString());
	$a->removeAt(2);
	printbr($a->toString());
	$a->shuffle();
	printbr("a->shuffle(): " . $a->toString());
	$a->insertAt(0, 5599);
	printbr("a->insertAt(0,5599): " . $a->toString());
	printbr();
return ob_end();
	} // end innerhtml()
} // end CArrayProgram

//------------------------------------------------------
// name: cmp(), foo()
// desc: used in the sort function below
//------------------------------------------------------
function carray_cmp($a, $b) { if ($a == $b) { return 0; } return ($a < $b) ? -1 : 1; }
function carray_foo($index, $value) { printbr("a[" . $index . "] = " . $value); }

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