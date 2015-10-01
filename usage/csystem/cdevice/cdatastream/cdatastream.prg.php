<?php
//---------------------------------------------------------------------------
// name: cdatastream.prg.php
// desc: demonstates how to use cdatastream from both the client/server 
//---------------------------------------------------------------------------

// includes
include_program("CDataStreamProgram");

//---------------------------------------------------------------
// name: CDataStreamProgram
// desc: demonstrates how to do client server communication
//---------------------------------------------------------------
class CDataStreamProgram extends CProgram{
	public function CDataStreamProgram(){ 
		parent :: CProgram();	
	} // end CDataStreamProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>cdatastream.js</b>" );
	
	var cds=null; 

	// create the datastream
	if( !( cds = new CDataStream() ) ){
    	printbr("couldn't create the datastream");
	    return;
    } // end if
	
	// open the datastream
    if( cds.open(exename(), "post", "data" ) == false ){
   	 	printbr("couldn't open the datastream");
		return; 
	} // end if
    
  	// set the parameters to send
    cds.setDataParam( "url", "http://www.barnesandnoble.com" );
    cds.setDataParam( "method", "post" );
    cds.setDataParam( "par1", "hello, world!!!" );
	cds.setDataParam( "s_main", "true" );	// call the s_main method of the program defined below
    
	printbr( "Request From Client: ");
   	printbr( "url: " + cds.request("url") );
   	printbr( "method: " + cds.request("method") );
   	printbr( "par1: " + cds.request("par1") );
	
	printbr();
   	
    // set the parameters
    var creturn = cds.send();
	if( !creturn ){
    	printbr( "couldn't send the data" );
        return;
    } // end if
	
	// asynchonously check the response
	_if( function(){ return creturn.isdone(); }, function(){
		printbr( creturn.data() );
		this._return();
	})._elseif( function(){ return creturn.iserror(); }, function(){
		printbr( "ERROR: in returning the reponse" );
		this._return();
	})._endif();
SCRIPT;
	} // end load()
	
	public function s_main(){
		// create and open the datastream
		$cds1 = new CDataStream();
		if( !$cds1 || !$cds1->open( "", "", "data" ) || !$cds1->received() ){
			printbr("ERROR-1: couldn't open datastream-1 or recieve data");	
			return;
		} // end if
		
		// get the parameters that where sent
		$url = $cds1->getDataParam( "url" );
		$method = $cds1->getDataParam( "method" );
		$par1 = $cds1->getDataParam( "par1" );
		if( $url == NULL || $method == NULL ){
			printbr("ERROR-2: couldn't call getDataParam()");	
			return;
		} // end if
			
		// set the data 
		$cds1->setData( "Response From Server:<br/>url: {$url}<br/>method: {$method}<br/>par1: {$par1}" );
		
		// send the data back to the client
		if( $cds1->send() == false ){
			printbr("ERROR-4: couldn't send data");	
			return;
		} // end if
		
		// close the streams
		$cds1->close();
		return;
	} // end s_main()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr( "<b>cdatastream.php</b>" );
return ob_end();
	} // end innerhtml()
} // end CNetworkProgram
?>