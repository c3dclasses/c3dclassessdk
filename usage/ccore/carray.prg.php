<?php
//---------------------------------------------------------------------------
// name: carray.prg.php
// desc: demonstrates how to to use the carray object
//---------------------------------------------------------------------------

// includes
include_program("CArrayProgram");

//---------------------------------------------------
// name: CArrayProgram
// desc: 
//---------------------------------------------------
class CArrayProgram extends CProgram {
	public function CArrayProgram() { 
		parent :: CProgram();	
	} // end CArrayProgram()
	
	public function c_main() {
return <<<SCRIPT
	br("<b>carray.js</b>");
    var a = new Array();
    a.push(8);
    br("Length: " + a.length); 
    a.push(10, 20, 30);
    br("Length: " + a.length);
    br(a.toString());
    a.pop();
    br(a.toString());
    a.shift();
    br(a.toString());
    a.unshift(50, 60, 70);
    br(a.toString());
    br(a.reverse().toString());
	br(a.valueOf());
	br();
	br(a.splice(0, 3).toString());
    br(a.toString());
	a.push(10, 20, 30, 40, 50, 60, 70, 80, 200, 210, 220);
    br(a.toString());
	a.sort(carray_cmp);
    br(a.toString());
	br(a.lastIndexOf(40));
    br(a.join(":"));
    br(a.indexOf(30));
    br(a.slice(0, 3).toString());
	br("indexed value is: " + a._()[0]);
	a._()[0] = 2000;
	br("indexed value is: " + a._()[0]);
	a.visit(carray_foo);
	br(a.toString());
    a.remove(40);
	br(a.toString());
	a.removeAll(50);
	br(a.toString());
	a.removeAt(2);
	br(a.toString());
	a.shuffle();
	br("a.shuffle():" + a.toString());
	a.insertAt(0, 5599);
	br("a.insertAt(0,5599): " + a.toString());
	br();
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml() {
ob_start();
	br("<b>carray.php</b>");
    $a = new CArray();
    $a->push(8);
    br("Length: " . $a->length()); 
    $a->push(10, 20, 30);
    br("Length: " . $a->length());
    br($a->toString());
    $a->pop();
    br($a->toString());
    $a->shift();
    br($a->toString());
    $a->unshift(50, 60, 70);
    br($a->toString());
    br($a->reverse()->toString());
	_r($a->valueOf());
	br();
    br($a->splice(0, 3)->toString());
    br($a->toString());
	$a->push(10, 20, 30, 40, 50, 60, 70, 80, 200, 210, 220);
    br($a->toString());
	$a->sort("carray_cmp");
    br($a->toString());
    br("lastIndexOf(40): " . $a->lastIndexOf(40));
    br($a->join(":"));
    br("indexOf(30): " . $a->indexOf(30));
    br($a->slice(0, 3)->toString());
	$a->visit("carray_foo");
	br($a->toString());
    $a->remove(40);
	br($a->toString());
	$a->removeAll(50);
	br($a->toString());
	$a->removeAt(2);
	br($a->toString());
	$a->shuffle();
	br("a->shuffle(): " . $a->toString());
	$a->insertAt(0, 5599);
	br("a->insertAt(0,5599): " . $a->toString());
	br();
return ob_end();
	} // end innerhtml()
} // end CArrayProgram

//------------------------------------------------------
// name: cmp(), foo()
// desc: used in the sort function below
//------------------------------------------------------
function carray_cmp($a, $b) { if ($a == $b) { return 0; } return ($a < $b) ? -1 : 1; }
function carray_foo($index, $value) { br("a[" . $index . "] = " . $value); }

//------------------------------------------------------
// name: cmp(), foo()
// desc: used in the javascript sort function below
//------------------------------------------------------
ob_start();	// insert this as a script function
?>
function carray_cmp(a, b) { if (a == b) { return 0; } return (a < b) ? -1 : 1; }
function carray_foo(index, value) { br("a[" + index + "] = " + value); }
<?php
ob_end_queue("script");
?>