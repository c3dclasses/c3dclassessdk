<?php
//---------------------------------------------------------------------------
// name: mootools.prg.php
// desc: demonstates how to use mootools
//---------------------------------------------------------------------------

// includes
include_program("mootools");

//---------------------------------------------------
// name: mootools
// desc: demonstatrates how to use mootools
//---------------------------------------------------
class mootools extends CProgram{
	public function mootools(){ 
		parent :: CProgram();	
	} // end mootools()
	
	public function c_main(){
return <<<SCRIPT
	"use strict";
	$$(".cprogram").setStyle("background","red");
	printbr("painting the background of the program (above) to red using jquery. $$(\".cprogram\").setStyle(\"background\",\"red\");");  
	
	function CObject(){
		this.m_name = "default name";
		this.m_age = "default age";	
		this._print = function(){
			alert( this.m_name + ": " + this.m_age );
		} // end 
		
		// private 
		var m_age = 90;
		this.setAge = function( age ){
			m_age = age;
		} // end 
		
		this.getAge = function(){
			return m_age;
		}
	} // end CObject
	
	var cobject = new CObject();
	cobject._print();
	CObject.prototype._print2 = function(){
		this._print();
		alert("The age is: " + this.getAge() );
	}; // end print2()
	
	cobject._print2();
	function CSubObject(){
		this.m_member = "SubClass"; 
		//CObject.apply( this );
	} // CSubObject
	
	CSubObject.prototype = new CObject();
	var csubobject = new CSubObject();
	alert( csubobject.m_name );	
	
	alert( this.__FILE__ );
	include_js( relname( this.__FILE__ + "/jsonp.js" ) );
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>mootools</b>");
	printbr("Mootools Hello, World Demo!!");
return ob_end();
	} // end innerhtml()
} // end mootools
?>