<?php
//---------------------------------------------------------------------------------
// file: cdatastream.php
// desc: creates data (bus) stream using php to communicate with client browser or
//       a remote web server. Also, it's a server-side object that can be used in 
//       cases when javascript is not around use <noscript></noscript> tag to do 
//       that.    
//---------------------------------------------------------------------------------

// includes
include_once( "cdatastreamclient.php" );
include_once( "cdatastreamserver.php" );
include_once( "cdatastreamproxy.php" );
include_js( relname(__FILE__) . '/cdatastream.js'); 

//-------------------------------------------
// class CDataStream
// desc: defines a datastream object
//-------------------------------------------
class CDataStream{
	protected $m_cdatastreamclient;
	protected $m_cdatastreamserver;

	// constructing a datastream
	function CDataStream(){
		$this->m_cdatastreamclient=NULL;
		$this->m_cdatastreamserver=NULL;
	} // end CDataStream()
	
	// opening and closing a datastream
	public function open( $strurl="", $method="", $strid="" ){
		if( $strurl != "" ){
			$this->m_cdatastreamserver = new CDataStreamServer();
			return $this->m_cdatastreamserver != NULL && $this->m_cdatastreamserver->open( $strurl, $method, $strid );
		}
		$this->m_cdatastreamclient = new CDataStreamClient();
		return $this->m_cdatastreamclient != NULL && $this->m_cdatastreamclient->open( $strid );
	} // end open()
	public function close(){
		if( $this->m_cdatastreamclient )
			$this->m_cdatastreamclient->close();
		if( $this->m_cdatastreamserver )
			$this->m_cdatastreamserver->close();
		$this->m_cdatastreamclient=NULL;
		$this->m_cdatastreamserver=NULL;
	} // end close()
	
	// get/set options / headers / request / response / data / dataparam / headers
	public function option( $strname, $value=NULL ){
		if( $this->m_cdatastreamclient ) 
			return $this->m_cdatastreamclient->option( $strname, $value );
		if( $this->m_cdatastreamserver ) 
			return $this->m_cdatastreamserver->option( $strname, $value );		
	} // end option()
	
	public function headers(){
	} // end headers()
	
	public function request(){
	} // end request()
	
	public function response( $strname, $value ){
	} // end response()
	
	public function response_info( $strname=NULL ){
		if( $this->m_cdatastreamclient ) 
			return $this->m_cdatastreamclient->response_info( $strname );
		if( $this->m_cdatastreamserver ) 
			return $this->m_cdatastreamserver->response_info( $strname );		
		return NULL;
	} // end response_info()
	
	public function cookie( $strname, $value=NULL ){
		if( $this->m_cdatastreamclient ) 
			return $this->m_cdatastreamclient->cookie( $strname, $value );
		if( $this->m_cdatastreamserver ) 
			return $this->m_cdatastreamserver->cookie( $strname, $value );		
		return NULL;
	} // end cookie()	
	
	 public function setData( $value ){
    	if( $this->m_cdatastreamclient ) 
			$this->m_cdatastreamclient->response_content( $value );
		if( $this->m_cdatastreamserver ) 
			$this->m_cdatastreamserver->request_content( $value );		
	} // end setData()
	
	public function getData(){
		if( $this->m_cdatastreamclient ) 
			return $this->m_cdatastreamclient->request_content();
		if( $this->m_cdatastreamserver ) 
			return $this->m_cdatastreamserver->response();	
		return NULL;	
    } // end getData()
	
    public function setDataParam($strname, $value){
		if( $this->m_cdatastreamclient ) 
			$this->m_cdatastreamclient->response( $strname, $value );
		if( $this->m_cdatastreamserver ) 
			$this->m_cdatastreamserver->request( $strname, $value );		
    } // end setDataParam()
	
	public function getDataParam( $strname ){
		if( $this->m_cdatastreamclient ) 
			return $this->m_cdatastreamclient->request( $strname );	
		if( $this->m_cdatastreamserver ) 
			return $this->m_cdatastreamserver->response( $strname );		
    	return NULL;
	} // end getDataParam()

	// sending and recieving
	public function send(){
		if( $this->m_cdatastreamclient ) 
			return $this->m_cdatastreamclient->send();	
		if( $this->m_cdatastreamserver ) 
			return $this->m_cdatastreamserver->send();		
		return FALSE;		
	} // end send()
	public function received(){
		if( $this->m_cdatastreamclient ) 
			return $this->m_cdatastreamclient->received();	
		if( $this->m_cdatastreamserver ) 
			return $this->m_cdatastreamserver->received();		
		return FALSE;
	} // end recieve()
} // end CDataStream
?>