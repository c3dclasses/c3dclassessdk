<?php
//---------------------------------------------------------------------------------
// file: cprogram.drv.php
// desc: defines a framework to create and run php program object 
//---------------------------------------------------------------------------------

function CProgram_doInit() {
	if ($cprograms = CProgram :: getCPrograms())
		foreach($cprograms as $strname => $cprogram) 
			$cprogram->init();
} // end CProgram_doInit()

function CProgram_doSMain() {
	if ($_REQUEST == NULL || isset($_REQUEST["s_main"]) == false)
		return false;
	if ($cprograms = CProgram :: getCPrograms())
		foreach($cprograms as $strname => $cprogram) 
			$cprogram->s_main(); 
	return true;
} // end CProgram_doSMain()

function CProgram_doBody() {
	$str = "";
	if ($cprograms = CProgram :: getCPrograms())
		foreach($cprograms as $strname => $cprogram) 
			$str .= $cprogram->body();
	return $str;
} // end CProgram_doBody()
	
// hook handlers
CHook :: add("init", "CProgram_doInit");
CHook :: add("s_main", "CProgram_doSMain");
CHook :: add("body", "CProgram_doBody");
?>