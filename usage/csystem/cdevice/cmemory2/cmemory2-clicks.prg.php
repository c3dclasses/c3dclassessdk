<?php
//---------------------------------------------------------------------------
// name: cmemory2_clicks.prg.php
// desc: demos hows to use cmemory object to store data on server / client
//---------------------------------------------------------------------------
// Start the session
// session_start();

// includes
include_program("CMemoryProgram2_Clicks");
include_memory2("testjson", dirname(__FILE__) . "/cjsonmemory.json", "CJSONMemoryDriver");
include_memory2("testarray", "\$_SESSION", "CArrayMemoryDriver");
include_memory2("testdatabase", "localhost/kevlewis_public/_cmemorytable", "CDatabaseMemoryDriver",
array("username"=>"kevlewis_public", "password"=>"kevlewis_public"));
	
//---------------------------------------------------
// name: CMemoryProgram2_Clicks
// desc: hello world program
//---------------------------------------------------
class CMemoryProgram2_Clicks extends CProgram{
	public function CMemoryProgram2_Clicks(){ 
		parent :: CProgram();	
	} // end CMemoryProgram2_Clicks()
	
	public function c_main(){
return <<<SCRIPT
		printbr("<b>cmemory.js</b>");
		
		// memory type 
		var cmemory = use_memory2(document.querySelector('input[name="memorytype"]:checked').value);
		$("input[name=\"memorytype\"]").click(function(){
			var memid = document.querySelector('input[name="memorytype"]:checked').value;
			cmemory = use_memory2(memid);
			alert("using cmemory: " + memid);
		}); // end .click()
		
		// create 
		$(".create").click(function(){
			var name = window.prompt("Please enter memory location name", "default_name");
			var value = window.prompt("Please enter memory location value", "This is the default value");
			var type = window.prompt("Please enter memory location type", "string");
			if(!name)
				return;				
			var _return = cmemory.create(name, value, type);
			_if(function(){return _return.isdone();}, function(){
				printbr("cmemory.create(\""+name+"\", \""+value+"\", \""+type+"\")"); 
				printbr("cmemory._toString() = " + cmemory._toString());	
				printbr();
			})._endif();
		}); // end .click()
		
		// retreive
		$(".retrieve").click(function(){
			var name = window.prompt("Please enter memory location name", "default_name");
			if(!name)
				return;
			var _return = cmemory.retrieve(name);
			_if(function(){return _return.isdone();}, function(){
				printbr("cmemory.retrieve(\""+name+"\")"); 
				_print("cmemory.get() = ");
				print_r(cmemory.get(name))	
				printbr()
				printbr();
			})._endif();
		}); // end .click()
		
		// update
		$(".update").click(function(){
			var name = window.prompt("Please enter memory location name", "default_name");
			var value = window.prompt("Please enter memory location value", "This is the default value");
			var type = window.prompt("Please enter memory location type", "string");
			if(!name)
				return;	
			var _return = cmemory.update(name, value, type);
			_if(function(){return _return.isdone();}, function(){
				printbr("cmemory.update(\""+name+"\", \""+value+"\", \""+type+"\")"); 
				printbr("cmemory._toString() = " + cmemory._toString());	
				printbr();
			})._endif();
		}); // end .click()
		
		// delete
		$(".delete").click(function(){
			var name = window.prompt("Please enter memory location name", "default_name");
			if(!name)
				return;
			var _return = cmemory.delete(name);
			_if(function(){return _return.isdone();}, function(){
				printbr("cmemory.delete(\""+name+"\")"); 
				printbr("cmemory._toString() = " + cmemory._toString());		
				printbr();
			})._endif()
		}); // end .click()		
		
		// sync
		$(".sync").click(function(){
			var _return = cmemory.sync();
			var _r1 = _if(function(){return _return.isdone();}, function(){
				printbr("cmemory.sync()"); 
				printbr("cmemory._toString() = " + cmemory._toString());		
				printbr();
			})._endif();
			
			_if(function(){return _r1.isdone();}, function(){
				alert("done with the sync command now run this");
				this._return();
			})._endif();
		}); // end .click()
		
		// get
		$(".get").click(function(){
			var name = window.prompt("Please enter memory location name", "default_name");
			_print("cmemory.get() = ");
			print_r(cmemory.get(name))	
			printbr();
		}); // end .click()
		
		// toString
		$(".print").click(function(){
			printbr("cmemory._toString() = " + cmemory._toString());		
			printbr();
		}); // end .click()
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml() {	
ob_start();			
		printbr("<b>cmemory.php</b>");
		printbr("<input type=\"radio\" name=\"memorytype\" value=\"testjson\" checked> CJSONMemoryDriver<br/>");
  		printbr("<input type=\"radio\" name=\"memorytype\" value=\"testdatabase\"> CDatabaseMemoryDriver<br/>");
  		printbr("<input type=\"radio\" name=\"memorytype\" value=\"testarray\"> CArrayMemoryDriver<br/>");
		printbr("<button class=\"sync\">cmemory.sync()</button>");
		printbr("<button class=\"create\">cmemory.create()</button>");
		printbr("<button class=\"retrieve\">cmemory.retreive()</button>");
		printbr("<button class=\"update\">cmemory.update()</button>");
		printbr("<button class=\"delete\">cmemory.delete()</button>");
		printbr("<button class=\"get\">cmemory.get()</button>");
		printbr("<button class=\"print\">cmemory._toString()</button>");
return ob_end();
	} // end innerhtml()
} // end CMemoryProgram
?>