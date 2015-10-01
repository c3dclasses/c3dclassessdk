<?php
//-------------------------------------------------------------------------------------------------------
// file: cevent.php
// desc: provides a way to store php handler function that will be executed later by the ckernal object
//-------------------------------------------------------------------------------------------------------

// includes
include_js( relname(__FILE__) . "/cevent.js" );

//-----------------------------------------------------------
// name: CEvent
// desc: singleton object used to store handler functions
//-----------------------------------------------------------
class CEvent{
	// members	
	public static $m_chashevent = NULL;
	
	// methods
	public static function add( $streventname, $fnhandler, $params=NULL ){	
		if( $streventname == "" || $fnhandler == "" )
			return false;
		if( CEvent :: $m_chashevent == NULL )
			CEvent :: $m_chashevent = new CHash();				
		if( CEvent :: $m_chashevent->containsKey( $streventname ) == FALSE )
			CEvent :: $m_chashevent->set( $streventname, new CArray() );
		$cevent = CEvent :: $m_chashevent->get( $streventname );
		if( $cevent ) 
			$cevent->push( array( "callback"=>$fnhandler, "params"=>$params ) );
		return true;
	} // end add()
	
	public static function remove( $streventname ){
		if( CEvent :: $m_chashevent == NULL )
			return false;	
		if( $fnhandler == NULL ) 
			CEvent :: $m_chashevent->remove( $streventname );
		return true;
	} // end remove()
	
	public static function fire( $streventname, $params=NULL ){
		$outparams=NULL;
		$inparams=NULL;
		$str="";
		$callid=0;
		$inparams = $params;
		if( CEvent :: $m_chashevent != NULL && ( $cevent = CEvent :: $m_chashevent->get( $streventname ) ) != NULL )
			foreach( $cevent->valueOf() as $handler ){ 		
				$callback = $handler["callback"];
				$params = $handler["params"];
				if( is_callable( $callback ) )
					$outparams[$callid] = call_user_func( $callback, $inparams );
				$callid++;
			} // end foreach()
		return $outparams;
	} // end fire()
	
	public static function fire_async( $streventname, $params, $strurl="", $timeout=0, $connecttimeout=0 ){
		$strurl = ( $strurl ) ? $strurl : exename(); 	
		if( !($cdss = new CDataStreamServer()) )
			return NULL;		
		if( $cdss->open( $strurl, "post" ) == FALSE )
			return NULL;		
		$params["cevent"]=true;
		$params["cevent_name"]=$streventname;
		$cdss->timeout( $timeout );
		$cdss->connecttimeout( $connecttimeout );
		$cdss->setRequest( $params );	
		if( $cdss->send() == FALSE || $cdss->received() == FALSE )
			return NULL;	
		$params = $cdss->response();	
		$cdss->close(); 
		return $params;
	} // end fire_aync()
} // end CEvent

function include_event( $streventname, $strcallback, $params=NULL ){
	return CEvent :: add( $streventname, $strcallback, $params );
} // end include_event()

function fire_event( $streventname, $inparams=NULL ){
	return CEvent :: fire( $streventname, $inparams );
} // end fire_event()
?>