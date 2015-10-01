<?php
//---------------------------------------------------------------------------
// name: cglobal.prg.php
// desc: demonstates how to use cglobal functions
//---------------------------------------------------------------------------

// includes
include_program( "CGlobalProgram", array( "p1"=>10, "p2"=>10, "p3"=>10, "p4"=>10 ) );

//---------------------------------------------------
// name: CGlobalProgram
// desc: demonstatrates how to use cglobal functions
//---------------------------------------------------
class CGlobalProgram extends CProgram{
	public function CBaseProgram(){ 
		parent :: CProgram();	
	} // end CGlobalProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr("<b>cglobal.js</b>");
	if( confirm( "testing confirm from the client side" ) ) 
		alert('clientside(RE) - YES');
	else alert('clientside(RE) - NO')
	alert("testing alert from clientside(RE)");				
	alert("testing alert from serverside(RE)");				
	//printbr("__FILE__: " + __FILE__ );				
	printbr("docroot: " + docroot());
    printbr("sdkroot: " + sdkroot());
    printbr("webroot: " + webroot());
	printbr("webroot(full): " + webroot(true));
	printbr("relname of : " + relname(""));
	printbr("absname of : " + absname(""));
	printbr("dirname of : " + dirname(""));
	printbr("exename of : " + exename( false ));
	printbr("exename(full) of : " + exename( true ) );
	printbr();
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>cglobal.php</b>");
	confirm( "testing confirm from serverside(RE)", 
			"alert('serverside(RE) - YES')", 
			"alert('serverside(RE) - NO')" ); 
	alert("testing alert from serverside(RE)");
	printbr("__FILE__: " . __FILE__ );				
	printbr("docroot: " . docroot());
    printbr("sdkroot: " . sdkroot());
    printbr("webroot: " . webroot());
	printbr("webroot(full): " . webroot(true));
	printbr("relname of (" . __FILE__ . "): " . relname(__FILE__));
	printbr("absname of (" . __FILE__ . "): " . absname(__FILE__));
	printbr("dirname of (" . __FILE__ . "): " . dirname(__FILE__));
	printbr("exename of (" . __FILE__ . "): " . exename( false ));
	printbr("exename(full) of (" . __FILE__ . "): " . exename( true ) );
	$strfunc = functionToString( "cglobalfunction1" );
	printbr($strfunc);
	$func56 = stringToFunction( $strfunc );
	printbr($func56());
	
	
	// new methods
	printbr();
	printbr();
	printbr();
	printbr( __FILE__ );
	printbr( "abs_path: " . abs_path( __FILE__ ) );
	printbr( "uri_path: " . uri_path( __FILE__ ) );
	printbr( "rel_path: " . rel_path( __FILE__ ) );
	printbr( "abs_name: " . abs_name( __FILE__ ) );
	printbr( "uri_name: " . uri_name( __FILE__ ) );
	printbr( "rel_name: " . rel_name( __FILE__ ) );
	
	
return ob_end();
	} // end innerhtml()
} // end CGlobalProgram

////////////////////////

function cglobalfunction1(){
	echo("in the foo function");
} // end foo()
function cglobalfunction2(){
	echo("in the foo function");
} // end foo()
?>