<?php
//---------------------------------------------------------------------------
// name: cbase.prg.php
// desc: demonstrates how to construct a basic hello, world!!! program
//---------------------------------------------------------------------------

// includes
include_program( "CDatabaseProgram" );
//include_database( "foodb", "localhost/hybridevaluation", array("username"=>"root", "password"=>"") );
//include_table_memory("footable", "foodb", "SELECT * FROM wp_options");
//include_database( "foodb", "localhost/prac", array("username"=>"root", "password"=>"") );
//include_table_memory("footable", "foodb", "SELECT * FROM table1");
//include_table_memory("footable", "foodb", "SELECT * FROM table1, table2 LIMIT 0 , 30");
include_table("footable", "localhost/prac/cdatabasememory_ex55", 
//array("username"=>"root", "password"=>"", "pk_field"=>"id", "pk_type"=>"int"));
array("username"=>"root", "password"=>""));

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
	$ctable = use_table("footable");
	$ctable->update(2, "address","253 cumberland street update");//, "int");
	print_r($ctable->retrieve(2, "id"));
	
	//$ctable->delete(2);
	//$ctable->delete(2);
	//$ctable->delete(4);
	//$ctable->delete(5);
	//$ctable->delete(6);
	//$ctable->delete(8);
	//$ctable->delete(20);
	//$ctable->delete(28);
	//$ctable->update(2, "address","253 cumberland street update");//, "int");
	//$ctable->create(5, "address", "253 cumberland st.", "CHAR(100)");//, "int");
	//$ctable->update(3, "address","253 cumberland street");//, "int");
	//$ctable->update(4, "address","253 cumberland street");//, "int");
	//$ctable->update(5, "address","253 cumberland street");//, "int");
	//$ctable->update(6, "address","253 cumberland street");//, "int");
	//$ctable->update(8, "address","253 cumberland street");//, "int");
	//$ctable->update(20, "address","253 cumberland street");//, "int");
	//$ctable->update(28, "address","253 cumberland street");//, "int");
	//$cdatabase = use_database("foob");	
	//$result = use_sql("foosql")->_(array('code'=>'COCACOLA'));
	//while($row = mysql_fetch_assoc($result))
	//print_r( $row );
	//$ctable->delete(2,"col2");
	
return ob_end();
	} // end innerhtml()
} // end CDatabaseProgram
?>