<?php
//---------------------------------------------------------------------------
// name: cbase.prg.php
// desc: demonstrates how to construct a basic hello, world!!! program
//---------------------------------------------------------------------------

// includes
include_program( "CDatabaseProgram" );
include_database( "foodb", "localhost/prac", array("username"=>"root", "password"=>"") );
include_sql( "foodb", "foosql", "SELECT * from table2 where code = '[[code]]'" ); 

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
	//$cdatabase = use_database("foo");
		
	$result = use_sql("foosql")->_(array('code'=>'COCACOLA'));
	while($row = mysql_fetch_assoc($result))
		print_r( $row );
	
return ob_end();
	} // end innerhtml()
} // end CDatabaseProgram
?>