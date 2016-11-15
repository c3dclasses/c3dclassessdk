<?php
//---------------------------------------------------------------------------
// name: cbase.prg.php
// desc: demonstrates how to use cdatabase and ctable object
//---------------------------------------------------------------------------

// includes
include_program( "CDatabaseProgram" );

// include __ctable object using this path and credentials. 
// open and create the database (__cdatabase) if it does not exist
// open and create the table (__ctable) if it doesn't exist
include_table("__ctable", "localhost/kevlewis_public/__ctable", array("username"=>"kevlewis_public", "password"=>"kevlewis_public"));

//---------------------------------------------------
// name: CDatabaseProgram
// desc: hello world program
//---------------------------------------------------
class CDatabaseProgram extends CProgram{
	public function CDatabaseProgram(){ 
		parent :: CProgram();	
	} // end CDatabaseProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>cdatabase.js</b>" );
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>cbatabase.php</b>");
	
	// use the table object
	$ctable = use_table("__ctable");
	
	if(!$ctable) {
		alert("ERROR: CTable object does not exist!");
		return;
	} // end if
		
	////////////////////////////////////////////////////////
	// manipulating rows and columns data and structure
	
	// create row[100]
	if($ctable->create(100)) 
		printbr("ctable->create(100)");
	else printbr("ERROR: ctable->create(100) - column may already exist");
	
	// retrieve row[100] name/value pairs  
	if($row=$ctable->retrieve(100))
		printbr("ctable->retrieve(100) = " . print_r($row, true));
	else printbr("ERROR: ctable->retrieve(100) - row[100] may not exist");

	// update int row[100][col1] = 300 - add new column
	if($ctable->update(100, "col1", "300", "INT"))
		printbr('ctable->update(100, "col1", "300", "INT")');
	else printbr('ERROR: ctable->update(100, "col1", "300", "INT")');
	
	// update CHAR(100) row[100][col2] = "253 Cumberland Street, Apt 401, Brooklyn, NY, 11205" - add new column
	if($ctable->update(100, "col2", "253 Cumberland Street, Apt 401, Brooklyn, NY, 11205", "CHAR(100)"))
		printbr('ctable->update(100, "col2", "253 Cumberland Street, Apt 401, Brooklyn, NY, 11205", "CHAR(100)")');
	else printbr('ERROR: ctable->update(100, "col2", "253 Cumberland Street, Apt 401, Brooklyn, NY, 11205", "CHAR (100)")');
	
	// retrieve row[100]
	if($row=$ctable->retrieve(100))
		printbr("ctable->retrieve(100) = " . print_r($row, true));
	else printbr("ERROR: ctable->retrieve(100) = undefined");
	
	// delete a column row[col1]
	if($ctable->delete(NULL, "col1", true))
		printbr('ctable->delete(100, "col1", true) - delete col1');
	else printbr('ERROR: ctable->delete(100, "col1", true) - delete col1');
		
	// retrieve row[100]
	if($row=$ctable->retrieve(100))
		printbr("ctable->retrieve(100) = " . print_r($row, true));
	else printbr("ERROR: ctable->retrieve(100) = undefined");
	
	// nullify a column row[100][col1]=NULL
	if($ctable->delete(100, "col2"))
		printbr('ctable->delete(100, "col2") - nullify col2');
	else printbr('ERROR: ctable->delete(100, "col2") - nullify col2');
	
	// retrieve row[100]
	if($row=$ctable->retrieve(100))
		printbr("ctable->retrieve(100) = " . print_r($row, true));
	else printbr("ERROR: ctable->retrieve(100) = undefined");
	
	
	// delete row[100]
	//if($ctable->delete(100))
	//	printbr("ctable->delete(100) - delete row[100]");
	//else printbr("ERROR: ctable->delete(100) - delete row[100]");
	  
	// delete the table
	//if($ctable->delete())
	//	printbr("ctable->delete() - deleted the whole table");
	//else printbr("ERROR: ctable->delete() - deleted the whole table");
	
	// delete the database
	//if($ctable->getCDatabase()->delete())
	//	printbr("ctable->getDatabase()->delete() - deleted the database");
	//else printbr("ERROR: ctable->getDatabase()->delete() - deleted the database");
	
return ob_end();
	} // end innerhtml()
} // end CDatabaseProgram
?>