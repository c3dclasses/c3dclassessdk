<?php
//---------------------------------------------------------------------------------
// file: cdatastream_server.php
// desc: creates a datastream to connect to a server and send data to it
//---------------------------------------------------------------------------------

//-------------------------------------------
// class CDataStreamServer
// desc: creates a datastream object
//-------------------------------------------
class CDataStreamServer{
	protected $m_options;	
	protected $m_request;
	protected $m_response;
	protected $m_response_info;
	protected $m_cookies;
	protected $m_curl;	
	protected $m_status;
	
	// constructing, opening, and closing	
	public function CDataStreamServer(){
		$this->m_options	= NULL;
		$this->m_request 	= NULL;
		$this->m_response 	= NULL;
		$this->m_cookie		= NULL;
		$this->m_curl		= NULL;
	} // end CDataStreamServer()
	
	public function open( $strurl, $strmethod ){	
		$valid_url_regex = '/.*/';
		if ( !$strurl || !preg_match( $valid_url_regex, $strurl ) )
			return FALSE;
		if( $strmethod == "post" ) 
			$strmethod = CURLOPT_POST;
		else if( $strmethod == "get" ) 
			$strmethod = CURLOPT_HTTPGET;
		else return FALSE;
		$curl = curl_init();
		if( $this->m_curl === FALSE )
			return FALSE;
		$this->m_curl 	= $curl;
		$this->option( "m_curl_url", $strurl );
		$this->option( "m_curl_method", $strmethod );
		return TRUE;
	} // end open()

	public function close(){
		if( $this->m_curl != NULL )
			curl_close( $this->m_curl );
		$this->m_options = NULL;
		$this->m_request = NULL;
		$this->m_response = NULL;		
		$this->m_response_info = NULL;
		$this->m_cookie = NULL;
		$this->m_curl = NULL;
		$this->m_status = NULL;
  	} // close()
	
	// configuration 
	public function timeout( $value ){
		return $this->option( "m_curl_timeout", $value );
	} // timeout()
	
	public function connecttimeout( $value ){
		return $this->option( "m_curl_connecttimeout", $value );
	} // connecttimeout()

	public function authenticate( $strusername, $strpassword ){
		return $this->option( "m_curl_userpwd", $strusername . ":" . $strpassword );
	} // authenticate()
	
	public function useragent( $struseragent ){
		return $this->option( "m_curl_useragent", $struseragent );	
	} // end useragent()
	
	// get/set options, cookies, request for setting/getting pars to send to a server	
	public function option( $strname=NULL ){
		if( !$this->m_options )
			$this->m_options = new CHash();
		if( $strname == NULL )
			return $this->m_option->valueOf();	
		return call_user_func_array(array($this->m_options,"hash"), func_get_args());	
	} // end option()
	
	public function request( $strname=NULL ){
		if( !$this->m_request )
			$this->m_request = new CHash();
		if( $strname == NULL )
			return $this->m_request->valueOf();	
		return call_user_func_array(array($this->m_request,"hash"), func_get_args());	
	} // end params()
	
	public function setRequest( $params ){
		if( !$this->m_request )
			$this->m_request = new CHash();
		$this->m_request->create( $params );
	} // end setRequest()
	
	public function response( $strname=NULL ){
		if( gettype( $this->m_response ) == "string" )
			return $this->m_response;
		if( !$this->m_response )
			$this->m_response = new CHash();
		if( $strname == NULL )
			return $this->m_response->valueOf();	
		return call_user_func_array(array($this->m_response,"hash"), func_get_args());	
	} // end response()
	
	public function response_info( $strname=NULL ){
		$info = $this->m_response_info;
		if( func_num_args() < 1 )
			return $info;	
		return ($info && isset($info[ $strname ])) ? $info[ $strname ] : NULL;
	} // end response_info()
	
	public function cookie( $strname, $value=NULL ){
		if( !$this->m_cookie )
			$this->m_cookie = new CHash();
		return call_user_func_array(array($this->m_cookie,"hash"), func_get_args());	
	} // end cookie()	
	
	// sending / recieving  
	public function send(){
		if( $this->m_curl == NULL )	// curl object
			return FALSE;
		if( $this->m_options == NULL || $this->m_options->size() < 1 ) // options
			return FALSE;	
		if( $this->m_request )
			$this->m_request->urlencode();	// encode the request par
		$strrequest = "";
		if( $this->m_request != NULL && $this->m_request->size() > 0 ) // request
			$strrequest = http_build_query( $this->m_request->valueOf() );	
		$strcookie = "";
		if( $this->m_cookie != NULL && $this->m_cookie->length() > 0 ) // cookies
			$strcookie = $this->m_cookie->combine("; ");
		$strurl = $this->option( "m_curl_url" );	// options
		$method = $this->option( "m_curl_method" );
		$timeout = $this->option( "m_curl_timeout" );
		$connecttimeout = $this->option( "m_curl_connecttimeout" );
		$useragent = $this->option( "m_curl_useragent" );
		if( curl_setopt($this->m_curl, $method, TRUE) === FALSE  ) // set method
			return FALSE;
		if( $method == CURLOPT_POST && $strrequest != "" && curl_setopt($this->m_curl, CURLOPT_POSTFIELDS, $strrequest ) === FALSE ) // set post fields
			return FALSE;
		else $strrequest = '?' . $strrequest; // set get fields
		if( curl_setopt( $this->m_curl, CURLOPT_URL, $strurl . $strrequest ) == FALSE ) // set url
			return FALSE; 
		if( $useragent != NULL && curl_setopt( $this->m_curl, CURLOPT_USERAGENT, $useragent ) == FALSE ) // set useragent
			return FALSE;
		if( curl_setopt($this->m_curl, CURLOPT_FOLLOWLOCATION, false) == FALSE ) // other
			return FALSE;
		//if( $timeout && curl_setopt($this->m_curl, CURLOPT_TIMEOUT, $timeout) == FALSE ) // other
		//	return FALSE;
		if( $timeout && curl_setopt($this->m_curl, CURLOPT_TIMEOUT_MS, $timeout) == FALSE ) // other
			return FALSE;
		//if( curl_setopt($this->m_curl, CURLOPT_CONNECTTIMEOUT, 1) == FALSE ) // other
		//	return FALSE;
		if( $connecttimeout && curl_setopt($this->m_curl, CURLOPT_CONNECTTIMEOUT_MS, $connecttimeout ) == FALSE ) // other
			return FALSE;
			
		if( curl_setopt( $this->m_curl, CURLOPT_RETURNTRANSFER, true ) == FALSE ) // return transfer
			return FALSE;
		$response = curl_exec( $this->m_curl ); // execute the request
		// setup the response
		$this->m_response = $response;
		if( $response && ($array = json_decode( $response, true )) != NULL ){
			$this->m_response = new CHash();
			$this->m_response->create( $array );	
		} // end if
		$this->m_response_info = curl_getinfo( $this->m_curl ); // response info
		return curl_error( $this->m_curl ) == '';
	} // end send()
	
	public function received(){
		return ( curl_errno( $this->m_curl ) == 0 );
	} // end received()	
	
	public function error(){
		return ( $this->m_curl ) ? curl_error( $this->m_curl ) : "";
	} // end error()
	
	public function errornum(){
		return ( $this->m_curl ) ? curl_errno( $this->m_curl ) : -1;
	} // end error()
} // end CDataStreamServer
?>