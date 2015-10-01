<?php
//---------------------------------------------------------------------------
// name: jquery.prg.php
// desc: demonstates how to use jquery
//---------------------------------------------------------------------------

// includes
include_program("jquery");

//---------------------------------------------------
// name: jquery
// desc: demonstatrates how to use jquery
//---------------------------------------------------
class jquery extends CProgram{
	public function jquery(){ 
		parent :: CProgram();	
	} // end jquery()
	
	// main app area 
	public function c_main(){
return <<<SCRIPT
	jQuery(".cprogram").css("background","red");
	printbr("painting the background of the program (above) to red using jquery. $(\".cprogram\").css(\"background\",\"red\");");
	
	var program = jQuery(".cprogram");
	
	var dom = program.get(0);
	dom.style.visibility='hidden';
	
	var dom2 = program[0];
	dom2.style.visibility='visible';
	
	/*var dom3 = program.end();
	console.log( dom3 );
	dom3.style.visibility='hidden';
	*/
	$( "div" ).eq( 1 ).css( "background-color", "pink" );
	$( "div" ).after("<p>Another paragraph</p>");
	
	window.style = {};
	window.style.color = "green";
	
	function foo(){
		alert( this.style.color );
		this.style.color = "blue";
		alert( this.style.color );
	} // end foo()
	
	foo();
	
	function foo2(){
		alert("turning the background yellow");
		$(this).css("background","yellow");		
	}
	
	program.click( function(){ 
		alert("turning the background green");
		$(this).css("background","green");
		foo2.apply( this );
		//foo2(); 
	} );
	
SCRIPT;
	} // end c_main()
		
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>jquery</b>");
	printbr("JQuery Hello, World Demo!!");
return ob_end();
	} // end innerhtml()
} // end jquery
?>