<?php
//---------------------------------------------------------------------------
// name: cbase.prg.php
// desc: demonstrates how to construct a basic hello, world!!! program
//---------------------------------------------------------------------------

// includes
include_program( "CDatabaseProgram" );
//include_database( "foodb", "localhost/hybridevaluation", array("username"=>"root", "password"=>"") );
//include_table_memory("footable", "foodb", "SELECT * FROM wp_options");
include_database( "foodb", "localhost/prac", array("username"=>"root", "password"=>"") );
//include_table_memory("footable", "foodb", "SELECT * FROM table1");
//include_table_memory("footable", "foodb", "SELECT * FROM table1, table2 LIMIT 0 , 30");
include_table_memory("footable", "foodb", "SELECT * FROM cdatabasememory");

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
	//$cdatabase = use_database("foob");
	
	//$result = use_sql("foosql")->_(array('code'=>'COCACOLA'));
	//while($row = mysql_fetch_assoc($result))
	//	print_r( $row );
	
return ob_end();
	} // end innerhtml()
} // end CDatabaseProgram
?>