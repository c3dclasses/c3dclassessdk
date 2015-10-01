<?php
//--------------------------------------------------------------
// file: cobqueue.php
// desc: queues string/object contents to be dumped later
//--------------------------------------------------------------

// header
include_js( relname(__FILE__) . "/cobqueue.js" );

//--------------------------------------------------------------
// file: CObqueue
// desc: queues string/object contents to be dumped later
//--------------------------------------------------------------
class CObqueue{
	// members
	static protected $m_cobqueues=NULL;
	protected $m_content;
	
	// methods
	public function CObqueue(){
		$this->m_content="";
	} // end CObqueue()	
	public function create( $params=NULL ){
		return true;
	} // end create()
	public function getContent(){ 
		return $this->m_content;
	} // end getContent();
	public function setContent( $content ){ 
		$this->m_content = $content;
	} // end setContent();
	
	// static methods
	public static function createCObqueue( $strid, $params=NULL ){
		if( $strid == NULL || $strid == "" )
			return NULL;
		if( !CObqueue :: $m_cobqueues )
			CObqueue :: $m_cobqueues = array();	
		if( !isset( CObqueue :: $m_cobqueues[$strid] ) &&
			($cobqueue = new CObqueue()) &&
			$cobqueue->create( $params ) ){
			CObqueue :: $m_cobqueues[$strid] = $cobqueue;
		} // end if
		else $cobqueue = CObqueue :: $m_cobqueues[$strid];
		return $cobqueue;
	} // createCObqueue()
	public static function  dumpCObqueue( $strid ){
		return ( CObqueue :: $m_cobqueues && isset( CObqueue :: $m_cobqueues[$strid] ) ) 
			? CObqueue :: $m_cobqueues[$strid]->getContent() : NULL;
	} // end dumpCObqueue()
} // end CObqueues

//--------------------------------------------------------------------------------------
// name: ob_queue_end()
// desc: puts the string of information onto the queue so it can be dumped later
// note: params indicates how to control the content being queued and additional info to
//       perhaps make queueing conditional
//--------------------------------------------------------------------------------------
function ob_end_queue( $strid, $params=NULL ){
	if( $strid == NULL || $strid == "" ||  ($cobqueue=CObqueue :: createCObqueue( $strid, $params )) == NULL )
		return false; 
	$cobqueue->setContent( $cobqueue->getContent() . ob_end() );
	//$cobqueue->setContent( 1 );
	return true;
} // end ob_queue_end()

//--------------------------------------------------------------
// name: ob_queue_dump()
// desc: dumps the contents of the queue
//--------------------------------------------------------------
function ob_queue_dump( $strid ){
	return CObqueue :: dumpCObqueue( $strid );
} // end ob_queue_dump()

//---------------------------------------------------------------
// name: ob_end()
// desc: ends the ob_start operation
//---------------------------------------------------------------
function ob_end(){
	$str = ob_get_contents();
	ob_end_clean();
	//ob_end_flush();
	return $str;
} // end ob_end()
?>