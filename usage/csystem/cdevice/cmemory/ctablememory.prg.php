<?php
//---------------------------------------------------------------------------
// name: ctablememory.prg.php
// desc: demonstrates ctablememory object
//---------------------------------------------------------------------------

// includes
include_program( "CTableMemoryProgram" );

// include __ctable object using this path and credentials. 
// open and create the database (__cdatabase) if it does not exist
// open and create the table (__ctable) if it doesn't exist
include_table_memory("__ctablememory", "localhost/__ctablememory_db/__ctablememory_tbl", 
				array("username"=>"root", "password"=>"", "primarykey"=>100));

//---------------------------------------------------
// name: CTableMemoryProgram
// desc: hello world program
//---------------------------------------------------
class CTableMemoryProgram extends CProgram{
	public function CTableMemoryProgram(){ 
		parent :: CProgram();	
	} // end CTableMemoryProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>ctablememory.js</b>" );
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>ctablememory.php</b>");
	
	/////////////////
	// opening 
	printbr('include_table_memory("__ctablememory", "localhost/__ctablememory_db/__ctablememory_tbl", 
				array("username"=>"root", "password"=>"", "primarykey"=>100))');
				
	// use the table object
	$ctablememory = use_table_memory("__ctablememory");
	if(!$ctablememory) {
		printbr("ERROR: CTableMemory object does not exist!");
		return;
	} // end if
	else printbr('ctablememory = use_table_memory("__ctablememory")');
	
	printbr();
	
	//////////////////////
	// creating
	
	// create CHAR(200) memory["first_name"]="Kevin"
	if($ctablememory->create("first_name", "Joe", "CHAR(200)")) 
		printbr('ctablememory->create("first_name", "Joe", "CHAR(200)")');
	else printbr('ERROR: ctablememory->create("first_name", "Joe", "CHAR(200)")');		
	
	if($ctablememory->create("last_name", "Mack", "CHAR(200)")) 
		printbr('ctablememory->create("last_name", "Mack", "CHAR(200)")');
	else printbr('ERROR: ctablememory->create("last_name", "Mack", "CHAR(200)")');		
	
	if($ctablememory->create("age", 22, "INT")) 
		printbr('ctablememory->create("age", 22, "INT")');
	else printbr('ERROR: ctablememory->create("age", "22", "INT")');		
		
	// print the memory structure and data
	print("ctablememory->toString() = ");
	printbr($ctablememory->toString());

	print("ctablememory->toStringStructure() = ");
	printbr($ctablememory->toStringStructure());
	printbr();
	
	////////////////////
	// updating
	
	if($ctablememory->update("first_name", "Joe", "CHAR(200)")) 
		printbr('ctablememory->update("first_name", "Joe", "CHAR(200)")');
	else printbr('ERROR: ctablememory->update("first_name", "Bob", "CHAR(200)")');		
	
	if($ctablememory->update("last_name", "Mack", "CHAR(200)")) 
		printbr('ctablememory->update("last_name", "Mack", "CHAR(200)")');
	else printbr('ERROR: ctablememory->update("last_name", "Marley", "CHAR(200)")');		
	
	if($ctablememory->update("age", 22, "FLOAT")) 
		printbr('ctablememory->update("age", 22, "FLOAT")');
	else printbr('ERROR: ctablememory->update("age", "22", "FLOAT")');		
	
	// print the memory structure and data
	print("ctablememory->toString() = ");
	printbr($ctablememory->toString());

	print("ctablememory->toStringStructure() = ");
	printbr($ctablememory->toStringStructure());
	printbr();
	
	///////////////////////
	// retrieving
	print('ctablememory->retrieve("first_name") = ');
	print_r($ctablememory->retrieve("first_name"));
	printbr();

	print('ctablememory->retrieve("last_name") = ');
	print_r($ctablememory->retrieve("last_name"));
	printbr();
	
	print('ctablememory->retrieve("age") = ');
	print_r($ctablememory->retrieve("age"));
	printbr();

	// print the memory structure and data
	print("ctablememory->toString() = ");
	printbr($ctablememory->toString());

	print("ctablememory->toStringStructure() = ");
	printbr($ctablememory->toStringStructure());
	printbr();
	 
	 
	///////////////////////////
	// deleting
	
	print('ctablememory->delete("first_name") - delete memory location ');
	print_r($ctablememory->delete("first_name"));
	printbr();
	
	print('ctablememory->delete("age") - delete memory location ');
	print_r($ctablememory->delete("age"));
	printbr();

	// print the memory structure and data
	print("ctablememory->toString() = ");
	printbr($ctablememory->toString());

	print("ctablememory->toStringStructure() = ");
	printbr($ctablememory->toStringStructure());
	
	$ctablememory->delete();
	printbr("ctablememory->delete() - delete all of the memory in the table");
	
	// delete the database
	if($ctablememory->getCTable()->getCDatabase()->delete())
		printbr("ctable->getDatabase()->delete() - deleted the database");
	else printbr("ERROR: ctable->getDatabase()->delete() - deleted the database");
	
return ob_end();
	} // end innerhtml()
} // end CTableMemoryProgram
?>