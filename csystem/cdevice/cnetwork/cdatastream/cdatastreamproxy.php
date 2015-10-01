<?php
//---------------------------------------------------------------------------------
// file: cdatastreamproxy.php
// desc: creates a datastream to connect to a Proxy and send data to it
//---------------------------------------------------------------------------------

//-------------------------------------------
// class CDataStreamProxy
// desc: creates a datastream object
//-------------------------------------------
class CDataStreamProxy extends CDataStreamServer{
	// members
	protected $m_cdatastreamserver;	// the outgoing server
	
	///////////////////////////////////////	
	// constructing opening / closing
	
	public function CDataStreamProxy(){
		$this->m_cdatastreamserver = NULL;
	} // end CDataStream_Proxy()
	
	public function open( $strurl, $strmethod, $strid="" ){
		//if( parent::open( "", "", $strid ) == FALSE || $this->recieved() == FALSE )
		//	return FALSE;
		parent::open( "", "", $strid );
		$cds = new CDataStreamServer();		// the outgoing server	
		if( !$cds || $cds->open( $strurl, $strmethod, $strid ) == FALSE )
			return FALSE;
		$this->m_cdatastreamserver = $cds; 
		return TRUE;
	} // end open()

	public function close(){
		if( $this->m_cdatastreamserver )
			$this->m_cdatastreamserver->close();
		$this->m_cdatastreamserver = NULL;
		parent::close();
	} // close()
	
	//////////////////////////////
	// sending / recieving	       
	
	public function send( $options=NULL ){
		$cds = $this->m_cdatastreamserver;
		if( !$cds )
			return FALSE;
		$cds->setRequest( $_REQUEST );
		if( !$cds->send( $options ) )
			return FALSE;	
		if( !$cds->received() )
			return FALSE;
		$this->setRequest( $cds->request() );
		if( parent::send( $options ) == false )
			return FALSE;
		return TRUE;
	} // end send()	
} // end CDataStream_Proxy
?>