<?php
//---------------------------------------------------------------------------
// name: cmemory2.prg.php
// desc: demos hows to use cmemory object to store data on server / client
//---------------------------------------------------------------------------

// includes
include_program("CMemoryProgram2");

//---------------------------------------------------
// name: CMemoryProgram
// desc: hello world program
//---------------------------------------------------
class CMemoryProgram2 extends CProgram{
	public function CMemoryProgram2(){ 
		parent :: CProgram();	
	} // end CMemoryProgram2()
	
	public function c_main(){
return <<<SCRIPT
		printbr("<b>cmemory.js</b>");
		
		include_remote_memory2("testmemory", dirname(this.__FILE__) + "/cjsonmemory.json", "CJSONMemoryDriver");
		printbr("include_remote_memory2(\"testmemory\", dirname(__FILE__) . \"/cjsonmemory.json\", \"CJSONMemoryDriver\")");
		printbr();
		
		var cmemory = use_memory2("testmemory");
		printbr("cmemory = use_memory2(\"testmemory\") ");
		printbr();
		console.log(cmemory);
		printbr("cmemory.open(): please look at the object in the console");
		printbr();
		
		printbr("cmemory._toString() = " + cmemory._toString());
		printbr();
		
		var _return1 = cmemory.sync();
		_if(function(){ return _return1.isdone(); }, function(){
			printbr();
			printbr("cmemory.sync()"); 
			printbr();
			
			printbr("cmemory._toString() = " + cmemory._toString());
			printbr();
			
			this._return();
		})._endif();
		
		var _return2 = cmemory.create("foo487346", "547865834348", "int");
		_if(function(){ return _return2.isdone(); }, function(){
			printbr("cmemory.create(\"foo487346\", \"547865834348\", \"int\")"); 
			printbr();
		
			printbr("cmemory._toString() = " + cmemory._toString());
			printbr();
	
			this._return();
		})._endif();
		
		_if(function(){ return _return1.isdone() || _return2.isdone(); }, function(){
			var cvar = cmemory.get("foo487346");
			_print("cmemory.get(\"foo487346\") = "); 			
			
			print_r(cvar);
			printbr();
		
			this._return();
		})._endif();
		
		_if(function(){return _return1.isdone() || _return2.isdone();}, function(){
			cmemory.delete("foo487346");
			printbr("cmemory.delete(\"foo487346\")"); 
	
			printbr("cmemory._toString() = " + cmemory._toString());
			printbr();
			
			this._return();
		})._endif();
		
		_if(function(){return _return1.isdone() || _return2.isdone();}, function(){		
			alert("delete");
			$("#delete").click(function(){
				alert("delete");
				// delete
				var _return = cmemory.delete("foo487346");
				_if(function(){return _return.isdone();}, function(){
					printbr("cmemory.delete(\"foo487346\")"); 
					
					printbr("cmemory._toString() = " + cmemory._toString());
					printbr();
					
					printbr();
				})._endif();
			}); // end $().click()
			
			alert("create");
			$("#create").click(function(){
				alert("create");
				// create
				var _return = cmemory.create("foo487346", "This is the new memory created", "string");
				_if(function(){return _return.isdone();}, function(){
					printbr("cmemory.create(\"foo487346\", \"This is the new memory created\", \"int\")"); 
					printbr();
			
					printbr("cmemory._toString() = " + cmemory._toString());
					printbr();
					
					printbr();
				})._endif();
			}); // end $().click()
			
			this._return();
		})._endif(); // end _if()
		
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml() {
		
ob_start();			
		printbr("<b>cmemory.php</b>");
		
		printbr("<a href=\"#\" id=\"delete\">cmemory.delete(\"foo487346\")</a>");
		printbr("<a href=\"#\" id=\"create\">cmemory.create(\"foo487346\")</a>");
			
	
		include_memory2("testmemory", dirname(__FILE__) . "/cjsonmemory.json", "CJSONMemoryDriver");
		printbr("include_memory2(\"testmemory\", dirname(__FILE__) . \"/cjsonmemory.json\", \"CJSONMemoryDriver\");");
		printbr();
		
		$cmemory = use_memory2("testmemory");
		printbr("cmemory = use_memory2(\"testmemory\") ");
		printbr();
		
		print("cmemory = ");
		print_r($cmemory);
		printbr();
		printbr();
		
		printbr("cmemory->_toString() = " . $cmemory->_toString());
		printbr();
		
		$cmemory->sync();
		printbr("cmemory->sync()"); 
		printbr();
		
		printbr("cmemory->_toString() = " . $cmemory->_toString());
		printbr();
		
		$cmemory->create("foo487346", "547865834348", "int");
		printbr("cmemory->create(\"foo487346\", \"547865834348\", \"int\")"); 
		printbr();
		
		printbr("cmemory->_toString() = " . $cmemory->_toString());
		printbr();
		
		$cvar = $cmemory->get("foo487346");
		print("cmemory->get(\"foo487346\") = "); 
		print_r($cvar);
		printbr();
		printbr();
		
		$cmemory->update("foo487346", "this is the updated value", "string");
		printbr("cmemory->update(\"foo487346\", \"this is the updated value\", \"string\")"); 
		printbr();
		
		printbr("cmemory->_toString() = " . $cmemory->_toString());
		printbr();
		
		$cmemory->delete("foo487346");
		printbr("cmemory->delete(\"foo487346\")"); 
		printbr();
		
		printbr("cmemory->_toString() = " . $cmemory->_toString());
		printbr();		
		
return ob_end();
	} // end innerhtml()
} // end CMemoryProgram
?>