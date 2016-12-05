<?php
//-------------------------------------------------------------------
// file: cstdio.php
// desc: input and output functions
//-------------------------------------------------------------------

// header
include_js( relname(__FILE__) . "/cstdio.js" );

//---------------------------------------------
// name: print functions
// desc: 
//---------------------------------------------	
function printbr($str="") { 
	_print($str . "<br />"); 
} // end printbr()
	
function println($str="") {
	_print($str . "\n"); 
} // end println()
	
function printScript($strscript) { 
	CStdio :: _printScript($strscript); 
} // end printjs();
	
function _print($str="") {
	CStdio :: _print($str);
} // end print()
	
function console($str) { 
	printScript("console.log('{$str}');");		
} // end console()
	
function alert($str) { 
	printScript("alert('{$str}');");		
} // end alert()
	
function confirm($str, $strjsyesbody, $strjsnobody) { 
	printScript("if(confirm('".$str."')==true){".$strjsyesbody.";}else{".$strjsnobody.";}");
} // end confirm()
	
function precode($str) {
	return "<pre><code>$str</code></pre>";
} // end precode()

//-----------------------------------------------------------
// name: ob_* functions
// desc:
//-----------------------------------------------------------
function ob_end_queue($strid, $params=NULL) {
	if($strid == NULL || $strid == "" ||  ($cobqueue=CObqueue :: createCObqueue($strid, $params)) == NULL)
		return false; 
	$cobqueue->setContent($cobqueue->getContent() . ob_end());
	return true;
} // end ob_queue_end()

function ob_queue_dump($strid) {
	return CObqueue :: dumpCObqueue($strid);
} // end ob_queue_dump()

function ob_end() {
	$str = ob_get_contents();
	ob_end_clean();
	//ob_end_flush();
	return $str;
} // end ob_end()