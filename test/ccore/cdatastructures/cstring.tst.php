<?php
//---------------------------------------------------------------------------
// file: cstring.tst.php
// desc: demonstrates how to to use the cstring object
//---------------------------------------------------------------------------

// includes
include_unittest("CStringUnitTest");

//-----------------------------------------------------
// name: CStringUnitTest
// desc: demonstrates how to to use the cstring object
//-----------------------------------------------------
class CStringUnitTest extends CUnitTest {
	public function CStringUnitTest() { 
		parent :: CUnitTest();	
	} // end CStringUnitTest()
	
	// test method
	public function testCString() {
		$str = new CString("Hello,World");
		$this->assertTrue($str->length() === 11);
		$this->assertTrue($str->charAt(5) === ',');
		$this->assertTrue($str->charCodeAt(5) === 44);
		$this->assertTrue($str->indexOf("ld") === 9);
		$this->assertTrue($str->lastIndexOf("ld") === 9);
		$this->assertTrue($str->valueOf() === "Hello,World");
		$this->assertTrue($str->toUpperCase()->valueOf() === "HELLO,WORLD");
		$this->assertTrue($str->toLowerCase()->valueOf() === "hello,world");
		$this->assertTrue($str->substring(1, 5)->valueOf() === "ello");
		$this->assertTrue($str->slice(1, 5)->valueOf() === "ello");
		$this->assertTrue($str->substr(1, 3)->valueOf() === "ell");
		$this->assertTrue($str->concat(['hello2, world2', 'world3', 'world4'])->valueOf() === 'Hello,Worldhello2, world2world3world4');		
		$_str = $str->_();
		$this->assertTrue($_str[0] === "H");
		//$_str[0] = '3';
		//$this->assertTrue($_str[0] !== "H");
		//$this->assertTrue($_str[0] === "3");
		$this->assertTrue($str->valueOf() === "Hello,World");
		$this->assertTrue($str->length() === 11);	
		$str2 = new CString("This is my strong new string to strong manipulate!!!");
		$this->assertTrue($str2->match('/strong/')->toString() === carray('strong')->toString());
		$this->assertTrue($str2->match('/manipulate/')->toString() === carray('manipulate')->toString());
		$this->assertTrue($str2->match('/strong/g')->toString() === carray('strong', 'strong')->toString());
		$this->assertTrue($str2->match('/manipulate/g')->toString() === carray('manipulate')->toString());	
		$this->assertTrue($str2->replace('/strong/', 'weak') === "This is my weak new string to strong manipulate!!!");
		$this->assertTrue($str2->replace('/strong/g', 'weak') === "This is my weak new string to weak manipulate!!!");
		$matches = $str2->match('/strong/');
		$this->assertTrue($str2->replaceMatch($matches, "small") === "This is my small new string to small manipulate!!!");	
	} // end testCString()
} // end CStringProgram

ob_start();
?>
<script parse="true" location="footer">
//-----------------------------------------------------
// name: CStringUnitTest
// desc: demonstrates how to to use the ccontent object
//-----------------------------------------------------
include_unittest("CStringUnitTest");
var CStringUnitTest = new Class ({ 
    Extends: CUnitTest,
	
	// test method
	testCString : function() {
		var str = "Hello,World";
		this.assertTrue(str.length === 11);
		this.assertTrue(str.charAt(5) === ',');
		this.assertTrue(str.charCodeAt(5) === 44);
		this.assertTrue(str.indexOf("ld") === 9);
		this.assertTrue(str.lastIndexOf("ld") === 9);
		this.assertTrue(str.valueOf() === "Hello,World");
		this.assertTrue(str.toUpperCase().valueOf() === "HELLO,WORLD");
		this.assertTrue(str.toLowerCase().valueOf() === "hello,world");
		this.assertTrue(str.substring(1, 5).valueOf() === "ello");
		this.assertTrue(str.slice(1, 5).valueOf() === "ello");
		this.assertTrue(str.substr(1, 3).valueOf() === "ell");
		this.assertTrue(str.concat('hello2, world2', 'world3', 'world4').valueOf() === 'Hello,Worldhello2, world2world3world4');
		var _str = str._();
		this.assertTrue(_str[0] === 'H');
		//_str[0] = '3';
		//this.assertTrue(_str[0] !== 'H');
		//this.assertTrue(_str[0] === '3');
		this.assertTrue(str.valueOf() === "Hello,World");
		this.assertTrue(str.length === 11);	
		var str2 = "This is my strong new string to strong manipulate!!!";
		this.assertTrue(str2.match(/strong/).toString() === ['strong'].toString());
		this.assertTrue(str2.match(/manipulate/).toString() === ['manipulate'].toString());
		this.assertTrue(str2.match(/strong/g).toString() === ['strong', 'strong'].toString());
		this.assertTrue(str2.match(/manipulate/g).toString() === ['manipulate'].toString());		
		this.assertTrue(str2.replace(/strong/, 'weak') === "This is my weak new string to strong manipulate!!!");
		this.assertTrue(str2.replace(/strong/g, 'weak') === "This is my weak new string to weak manipulate!!!");
		var matches = str2.match(/strong/);
		this.assertTrue(str2.replaceMatch(matches, "small") === "This is my small new string to small manipulate!!!");	
	}, // end testCString()
}); // end CStringProgram
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
?>