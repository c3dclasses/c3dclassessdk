<?php
//-------------------------------------------------------------------------------
// name: cdatastreamproxy.prg.php
// desc: demonstrates how to use cdatastream_proxy services
//-------------------------------------------------------------------------------

// includes
include_program("CDataStreamProxyProgram");

class CDataStreamProxyProgram extends CProgram{
	public function CDataStreamProxyProgram(){
		parent::CProgram();
	} // end CDataProgram
	public function s_main(){
			
	} // end s_main()
	public function c_main(){
return <<<SCRIPT
	printbr("<b>cdatastreamproxy.js</b>"); 
SCRIPT;
	} // end main()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>cdatastreamproxy.php</b>"); 
	$cdsp = new CDataStreamProxy();
	
	if( $cdsp == NULL ){
		alert('ERROR: CDataStreamServer()');
		return;
	} // end if	
		
	if( $cdsp->open( "localhost", "get", "CDataStreamProxy" ) == FALSE ){
		alert('ERROR: CDataStreamServer::open()');
		return;
	} // end if
	
	// send data to url
	if( $cdsp->send() == FALSE ){
		alert('ERROR: CDataStreamServer::send()');
		return;
	} // end if
	
	// check if the data was recieved and print the data
	if( !$cdsp->received() ){	
		alert('ERROR: CDataStreamServer::send()');
		return;
	} // end if
		
	// show the output
ob_start();	
	printbr("<br>cdatastreamproxy.php</br>");
	printbr( "Request from the client:" );
	print_r( $cdsp->request() );
	printbr();
	printbr();
	printbr( "Response from the server:" );
	print_r( $cdsp->response() );
	
	// close the stream
	$cdss->close(); 
	alert('SUCCESS: CDataStreamServer....');	
return ob_end();
	} // end innerhtml()
} // end CDataStreamProxyProgram
?>