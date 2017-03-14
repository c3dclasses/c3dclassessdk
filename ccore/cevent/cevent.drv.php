<?php
//-------------------------------------------------------------------------------------------------------
// file: cevent.drv.php
// desc: provides a way to store php handler function that will be executed later by the ckernal object
//-------------------------------------------------------------------------------------------------------

/*
function CEvent_doCallback( $key, $fnhandler, $params ){
	return (is_callable($fnhandler))?call_user_func( $fnhandler, $params ):"";
} // end CEvent_doCallback()
*/

// driver for the REQUEST parameter
function CEvent_isEmpty(){
	return ( $_REQUEST == NULL || isset( $_REQUEST["cevent"] ) == false );
} // end CEvent_isEmpty()
	
function CEvent_dispatch($streventnametocheck=""){
	if( CEvent_isEmpty() )
		return NULL;
	$streventname = $_REQUEST["cevent_name"];
	if($streventnametocheck != "" && $streventnametocheck != $streventname)
		return NULL;
	$iscdatastream = isset( $_REQUEST["m_bcdatastream"] );
	$params = $_REQUEST;
	$params = fire_event( $streventname, $params );
	return ( $iscdatastream ) ? json_encode( $params ) : $params;
} // end CEvent_dispatch()

function CEvent_doSMain(){ 
	$bevents = (CEvent_isEmpty()==false);
	if($bevents) 
		print_r(CEvent_dispatch());
	return ($bevents);
} // end CEvent_doSMain()

function CEvent_doInit(){ 
} // end CEvent_doSMain()

// add this methods to the kernal when it initializes and runs s_main
CHook :: add("init", "CEvent_doInit");
CHook :: add("s_main", "CEvent_doSMain");
?>