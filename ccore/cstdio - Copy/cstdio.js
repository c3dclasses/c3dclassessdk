//----------------------------------------------------------------
// file: cstdio.js
// desc: input and output functions
//----------------------------------------------------------------

//---------------------------------------------
// name: print functions
// desc: 
//---------------------------------------------	
function printbr(str, dst) {
	_print(str + "<br />", dst); 
} // end printbr()

function println(str, dst) { 
	_print(str + "\n", dst); 
} // end println()

function _print(str, dst){ 
	CStdio._print(str, dst);
} // end _print();

function print_r(mixed, btostring, dst) { 
	CStdio._print_r(mixed, btostring, dst);
} // end print_r()

function echo(str, dst) {
	_print(str, dst);
} // end echo()

//-----------------------------------------------------------
// name: ob_* functions
// desc:
//-----------------------------------------------------------
function ob_start() {
	CObqueue.ob_start();
} // end ob_start()

function ob_end_queue(strid) {
	CObqueue.ob_end_queue(strid);
} // end ob_end_queue()

function ob_queue_dump(strid) {
	return CObqueue.ob_queue_dump(strid);
} // end ob_queue_dump()

function ob_end() {
	return CObqueue.ob_end();
} // end ob_end()
