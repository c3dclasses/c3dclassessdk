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
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml() {	
	ob_start();			
		printbr("<b>cmemory2.php</b>");	
		
		printbr();
		printbr();
		
		// local memory
		printbr("<b>include_memory2()</b>");	
		printbr("include_memory2(\"local-memory\", dirname(__FILE__) . \"/cjsonmemory.json\", \"CJSONMemoryDriver\");");
		//include_memory2("local-memory", dirname(__FILE__) . "/cjsonmemory.json", "CJSONMemoryDriver");
		include_memory2("local-memory", "_SESSION", "CArrayMemoryDriver");
		
		$this->doMemory("local-memory");
		/*		
		// remote memory
		printbr("<b>include_remote_memory2()</b>");	
		printbr("include_remote_memory2(\"remote-memory\", dirname(__FILE__) . \"/cjsonmemory.json\", \"CJSONMemoryDriver\");");
		include_remote_memory2("remote-memory", dirname(__FILE__) . "/cjsonmemory.json", "CJSONMemoryDriver", CRemoteMemoryDriver :: getLocalURI());
		$this->doMemory("remote-memory");
		*/
	return ob_end();
	} // end innerhtml()
	
	public function doMemory($strid) {
		printbr();	
		printbr("cmemory = use_memory2(\"$strid\") ");
		$cmemory = use_memory2($strid);
		
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
		
		printbr();
		$cmemory->sync();
		printbr("cmemory->sync()"); 
		printbr();
		
		printbr("cmemory->_toString() = " . $cmemory->_toString());
		printbr();
		
		$cmemory->delete("foo487346");
		printbr("cmemory->delete(\"foo487346\")"); 
		printbr();
		
		printbr("cmemory->_toString() = " . $cmemory->_toString());
		printbr();			
	} // end doMemory()
	
} // end CMemoryProgram
?>