<?php
//---------------------------------------------------------------------------
// name: qunit_prg.prg.php
// desc: demonstates how to use qunit_prg
//---------------------------------------------------------------------------

// includes
include_program("qunit_prg");
include_js( "http://code.jquery.com/qunit/qunit-1.17.1.js" );
include_css( "http://code.jquery.com/qunit/qunit-1.17.1.css" );

//---------------------------------------------------
// name: minify_prg
// desc: demonstatrates how to use minify_prg
//---------------------------------------------------
class qunit_prg extends CProgram{
	public function qunit_prg(){ 
		parent :: CProgram();	
	} // end minify_prg()
	
	public function c_main(){
return <<<SCRIPT
	QUnit.test( "hello test", function( assert ) {
		assert.ok( 1 == "1", "Passed!" );
		assert.ok( 1 == "2", "Passed!" );
	}); // end test()
SCRIPT;
	} // end c_main()
		
	// rendering methods
	public function innerhtml(){
ob_start();
?>
 	<div id="qunit"></div>
	<div id="qunit-fixture"></div>
<?php
return ob_end();
	} // end innerhtml()
} // end qunit_prg
?>