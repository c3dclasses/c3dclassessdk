<?php
//----------------------------------------------------------------
// file: cmemory.drv.php
// desc: driver object for cmemory
//----------------------------------------------------------------

//------------------------------------------------------
// name: oncmemory_handler
// desc: sets up a memory controller and event
//------------------------------------------------------
include_event( "oncmemory", "oncmemory_handler" );
function oncmemory_handler( $params ){
	// use 
	$strid = $params["memid"];
	$strcommand = $params["memcommand"];
	$bbatch = isset($params["membatch"])?true:false;
	if( !$cmemory = use_memory( $strid ) )
		return NULL;
		
	// open / close
	if( $strcommand == "open" )
		return array( "m_bjson" => true, "m_jsondata" => $cmemory->toJSON() );
	else if( $strcommand == "close" )
		return NULL;
		
	// crud - batch crud or create, retrieve, update, delete
	if($bbatch){
		$data = $cmemory->batch($strcommand, $params["memparams"]);
		return ($data!=NULL) ? array("m_bjson"=>true, "m_jsondata" => json_encode($data)) : NULL;
	} // end if
	else if( $strcommand == "create" ){
		$strname = $params["varname"];
		$strtype = $params["vartype"];
		$value = $params["varvalue"];
		$cmemory->create( $strname, $value, $strtype );
		return NULL;
	} // end if
	else if( $strcommand == "retrieve" ){
		$strname = $params["varname"];
		$cvar = $cmemory->retrieve( $strname );
		return array( "m_bjson" => true, "m_jsondata" => json_encode( $cvar ) );
	} // end if
	else if( $strcommand == "update" ){
		$strname = $params["varname"];
		$strtype = $params["vartype"];
		$value = $params["varvalue"];
		$cvar = $cmemory->update( $strname, $value, $strtype  );
		return array( "m_bjson" => true, "m_jsondata" => json_encode( $cvar ) );
	} // end if
	else if( $strcommand == "delete" ){
		$strname = $params["varname"];
		$cmemory->delete( $strname );
		return NULL;//array( "m_bjson" => true, "m_jsondata" => json_encode( $cvar ) );
	} // end if
	
	return NULL;
} // end oncmemory()

//------------------------------------------------------
// name: CMemory_preLoad_toString()
// desc: 
//------------------------------------------------------
function CMemory_preLoad_toString( $id, $cresource ){ 
	$p = $cresource->getParams();
	if( !$p || !$p->get("cmemory") || !$p->get("client") ) // check if the resource is a memory object
		return "";
	$str = "CMemory.use(\"{$id}\",".$cresource->toJSON().")";
	$str .= "\n";
	return $str;		
} // end CMemory_preLoad()

// add a hook to preload memory 
function cmemory_preload(){ return CResource :: toStringVisit( "CMemory_preLoad_toString" ); }  
CHook :: add( "script", "cmemory_preload" ); 
?>