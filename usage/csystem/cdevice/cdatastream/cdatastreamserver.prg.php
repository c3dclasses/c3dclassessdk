<?php
//-----------------------------------------------------------------------------------
// name: cdatastreamserver.prg.php
// desc: demonstrates ho to send/recieve data from a server with a CDataStream object
//-----------------------------------------------------------------------------------

// echo the output back to the client
if( isset( $_REQUEST["program"] ) ){ 
	echo json_encode( $_REQUEST );
	//echo "hello";
	return;
} // end if

// include the program below in the system
include_program("CDataStreamServerProgram");

class CDataStreamServerProgram extends CProgram{		
	public function CDataStream_ServerProgram(){
		parent::CProgram();
	} // end CDataProgram
	
	public function innerhtml(){
		$cdss = new CDataStreamServer();
		if( $cdss == NULL ){
			alert('ERROR: CDataStreamServer()');
			return;
		} // end if	
		
		// open the steeam
		//if( $cdss->open( "http://www.google.com", "get" ) == FALSE ){
		//if( $cdss->open( "http://www.yahoo.com", "get" ) == FALSE ){
		if( $cdss->open( "http://blog.jimdo.com/wp-content/uploads/2014/01/tree-247122.jpg", "get" ) == FALSE ){
		//if( $cdss->open( absname( __FILE__ ) . "/cdatastreamserver.prg.php", "post" ) == FALSE ){
			alert('ERROR: CDataStreamServer::open()');
			return;
		} // end if
		
		// set params to send to the url 
	 	$cdss->request( "program", "CDataStreamServerProgram" );
		$cdss->request( "par1", "foo1" );
		$cdss->request( "par2", "foo2" );
		$cdss->request( "par3", "foo3" );
		
		$cdss->option( "m_curl_connecttimeout", 1000 );
		$cdss->option( "m_curl_timeout", 10000 );
		
		// send data to url
		if( $cdss->send() == FALSE ){
			alert('ERROR: CDataStreamServer::send()');
			return;
		} // end if
		
		// check if the data was recieved and print the data
		if( !$cdss->received() ){	
			alert('ERROR: CDataStreamServer::send()');
			return;
		} // end if
		
		// show the output
		ob_start();	
		printbr("<br>cdatastreamserver.php</br>");
		printbr( "Request from the client:" );
		print_r( $cdss->request() );
		printbr();
		printbr();
		printbr( "Response from the server:" );
		print_r( $cdss->response() );
		
		// close the stream
		$cdss->close(); 
		alert('SUCCESS: CDataStreamServer....');
		return ob_end();
	} // end innerhtml()
} // end CDataStream_ServerProgram
?>