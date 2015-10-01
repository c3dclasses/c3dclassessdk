<?php
//---------------------------------------------------------------------------------
// file: cdatastreamclient.php
// desc: recieves data from and sends data back to a client 
//---------------------------------------------------------------------------------

//-------------------------------------------------------------------------
// class CDataStreamClient
// desc: defines an object that interacts with a requesting client
//-------------------------------------------------------------------------
class CDataStreamClient {
    protected   $m_request;		// stores the request params 
	protected   $m_response;	// stores the response params
    protected   $m_headers; 		// stores the header params
   	protected 	$m_options;		// stores the options params	
	
	// constructor, opening, closing
	public function CDataStreamClient(){
		$this->m_request = NULL;
		$this->m_response = NULL;
        $this->m_headers = NULL;
   		$this->m_options = NULL;
   	} // end CDataStream_Client()
	
    public function open( $strid = "" ){
		if(!($options = new CHash()) || !($request = new CHash()))
			return FALSE;
		$request->create( $_REQUEST );				
		if( $strid != "" && ($id = $request->get( "m_strid" )) != NULL && $id != $strid )
			return FALSE;
		// set the internal members	
		$this->m_request = $request;
		$this->m_response = "";
   		$this->m_options = $options;
		return TRUE;
	} // end open()
    
	public function close(){   
		$this->m_request = NULL;
		$this->m_response = NULL;
   		$this->m_options = NULL;
   	} // end close()
	
	// sending and recieving
	public function send(){	
		if( $this->m_response == NULL )	
			return TRUE;
		$response = ( is_object( $this->m_response ) ) ? $this->m_response->valueOf() : $this->m_response;
		if( is_array( $response ) ) 
			echo json_encode( $response ); 
		else echo $response;
		return TRUE;
	} // end send()
	
    public function received(){
    	return ( $this->m_request && $this->m_request->get("m_bcdatastream") );
    } // end recieve()	
    
	// options / request / response / headers
	public function option( $strname, $value=NULL ){
		return ( $this->m_options ) ? $this->m_options->get( $strname, $value ) : NULL;
	} // end option()

	public function headers( $strname, $value=NULL ){
		if( !$this->m_headers )
			$this->m_headers = new CHash();
		return call_user_func_array(array($this->m_headers, "hash" ), func_get_args());
	} // end headers()

	public function request( $strname, $value=NULL ){
		if( !$this->m_request )
			$this->m_request = new CHash();
		return call_user_func_array(array($this->m_request, "hash" ), func_get_args());	
	} // end request
	
	public function response( $strname ){
		if( !$this->m_response ){
			$this->m_response = new CHash();
			$this->m_response->set( "m_bjson", true );
		} // end if
		return call_user_func_array(array($this->m_response,"hash"), func_get_args());
	} // end response()
   
	public function response_content( $value ){
		$this->m_response = $value;
	} // response_content()
			
	public function cookies( $strname, $value=NULL, $options=NULL ){
		if( $strname == NULL )
			return $_COOKIE;
		else if( $value == NULL )
			return $_COOKIE[$value];
		setcookie( $strname, $value, isset( $options['expire'] ) ? $options['expire'] : "",
				   isset( $options['path'] ) ? $options['path'] : "", isset( $options['domain'] ) ? $options['domain'] : "" );		
	} // end cookies()	
	
	// checking 
	public function isAjax(){
        return $this->request( "m_bajax" );
	} // end isAjax()
} // end CDataStream_Client
?>