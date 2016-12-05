<?php
//---------------------------------------------------------------------------
// name: cstdio.prg.php
// desc: demonstrates how to use cstdio methods 
//---------------------------------------------------------------------------

// includes
include_program( "CStdioProgram" );

//---------------------------------------------------
// name: CStdioProgram
// desc: hello world program
//---------------------------------------------------
class CStdioProgram extends CProgram{
	// constructorobj
	public function CStdioProgram(){ 
		parent :: CProgram();	
	} // end CStdioProgram()
	
	public function c_main(){
return <<<SCRIPT
	_print("<h1>cstdio.js</h1>");
	CStdio._print("CStdio._print(\"Hello, world\") = Hello, world");
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){			
ob_start();
	print("<h1>cstdio.php</h1>");
	CStdio :: _print("CStdio._print(\"Hello, world\") = Hello, world");
return ob_end();
	} // end innerhtml()
} // end CStdioProgram
?>