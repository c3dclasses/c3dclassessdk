<?php
//---------------------------------------------------------------------------
// name: cmemory2_clicks.prg.php
// desc: demos hows to use cmemory object to store data on server / client
//---------------------------------------------------------------------------

// includes
include_program("CMemoryProgram2_Clicks");
include_memory2("testmemory", dirname(__FILE__) . "/cjsonmemory.json", "CJSONMemoryDriver");
				

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
		
		//include_remote_memory2("testmemory", dirname(this.__FILE__) + "/cjsonmemory.json", "CJSONMemoryDriver");
		var cmemory = use_memory2("testmemory");
		
		// create 
		$("#create").click(function(){
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
		$("#retrieve").click(function(){
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
		
		// create 
		$("#update").click(function(){
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
		$("#delete").click(function(){
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
		$("#sync").click(function(){
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
		$("#get").click(function(){
			var name = window.prompt("Please enter memory location name", "default_name");
			_print("cmemory.get() = ");
			print_r(cmemory.get(name))	
			printbr();
		}); // end .click()
		
		// print
		$("#print").click(function(){
			printbr("cmemory._toString() = " + cmemory._toString());		
			printbr();
		}); // end .click()
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml() {
		
ob_start();			
		printbr("<b>cmemory.php</b>");
		printbr("<button id=\"sync\">cmemory.sync()</button>");
		printbr("<button id=\"create\">cmemory.create()</button>");
		printbr("<button id=\"retrieve\">cmemory.retreive()</button>");
		printbr("<button id=\"update\">cmemory.update()</button>");
		printbr("<button id=\"delete\">cmemory.delete()</button>");
		printbr("<button id=\"get\">cmemory.get()</button>");
		printbr("<button id=\"print\">cmemory._toString()</button>");
return ob_end();
	} // end innerhtml()
} // end CMemoryProgram
?>