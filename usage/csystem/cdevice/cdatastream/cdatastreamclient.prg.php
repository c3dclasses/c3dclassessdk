<?php
//-------------------------------------------------------------------------------
// name: cdatastreamclient.prg.php
// desc: demonstrates ho to send/recieve data from a server with a CData object
//-------------------------------------------------------------------------------

// includes
include_program("CDataStreamClientProgram");

//---------------------------------------------------
// name: CDataStreamClientProgram
// desc: test the cdatastream client program
//---------------------------------------------------
class CDataStreamClientProgram extends CProgram{
	public function CDataStreamClientProgram(){
		parent::CProgram();
	} // end CDataProgram
	
	public function s_main(){	
		$cds = new CDataStreamClient();
		if( !$cds || !$cds->open( "id" ) || !$cds->received() ){
			return;
		} // end if
		$method = $cds->request("method");
		$par1 = $cds->request("par1");
		$url = $cds->request("url");
		
		$cds->response( "method", $method );
		$cds->response( "par1", $par1 );
		$cds->response( "url", $url );
		$cds->send();	
		return; 
	} // end s_main()
	
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>cdatastreamclient.js</b>" );
	var cds=null; 
	
	if( !( cds = new CDataStream() ) ){
    	printbr("couldn't create the datastream");
	   	return;
    } // end if
	
	if( cds.open(exename(), "post", "id" ) == false ){
   		printbr("couldn't open the datastream");
		return; 
	} // end if
    
  	cds.request( "url", "http://www.thedefendersonline.com" );
    cds.request( "method", "post" );
    cds.request( "par1", "hello, world!!!" );
	cds.request( "s_main", "true" );	// call the s_main method of the program defined below    
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
		printbr("Response From Server: ");
		printbr( "url: " + cds.response("url") );
   		printbr( "method: " + cds.response("method") );
   		printbr( "par1: " + cds.response("par1") );
		this._return();
	})._elseif( function(){ return creturn.iserror(); }, function(){
		printbr( "ERROR: in returning the reponse" );
		this._return();
	})._endif();
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){
		ob_start();
		printbr("<b>cdatastreamclient.php</b>");
		return ob_end();
	} // end innerhtml()
} // end CDataStreamClient_Program
?>