<?php
//---------------------------------------------------------------------------
// name: cevent.prg.php
// desc: demonstrates how to use the CEvent class to define and fire events
//---------------------------------------------------------------------------

// includes
include_program( "CEventProgram" );

// include events
include_event( "onevent1", "cevent_handler" );	// function
include_event( "onevent1", "CEventProgram::cevent_handler" ); // static class method 
//includefunction( "cevent_handler" );

//-----------------------------------------------------------------------------
// name: CEventProgram
// desc: demonstrates how to use the CEvent class to define and fire events
//-----------------------------------------------------------------------------
class CEventProgram extends CProgram{
	public function CEventProgram(){  
		parent :: CProgram();	
	} // end CEventProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr("<b>cevent.js</b>"); 
	printbr("CEvent :: fire( \"onevent1\" )");
	var params = {"param1":"firing from javascript1","param2":"firing from javascript2"};
	printbr("Input: " + print_r( params, true ) );
	var creturn = CEvent.fire("onevent1", params );
	_if( function(){ return creturn.isdone(); }, function(){
		printbr( "Output: " + print_r( creturn.data(), true ) );
		this._return();
	})._elseif( function(){ return creturn.iserror(); }, function(){
		printbr("ERROR: "  + print_r( creturn.data(), true ) );
		this._return();
	})._elseif( function(){ return creturn.isbusy(); }, function(){
	})._endif(); 
SCRIPT;
	} // end load()
	
	public function innerhtml(){
ob_start();
	printbr("<b>cevent.php</b>");
	printbr( "CEvent :: fire( \"onevent1\" )" );
	$params = array("param1"=>"value1","param2"=>"value2");
	printbr("Input: " . print_r( $params, true ) );
	$params = CEvent :: fire( "onevent1", $params );
	printbr( "Output: " . print_r( $params, true ) );
	printbr();
	
	printbr( "CEvent :: fire_async( \"onevent1\" )" );
	$params = array("param1"=>"value1","param2"=>"value2");
	printbr("Input: " . print_r( $params, true ) );
	$params = CEvent :: fire_async( "onevent1", array("param1"=>"value1","param2"=>"value2") );
	printbr( "Output: " . print_r( $params, true ) );
	printbr();
return ob_end();
	} // end innerhtml()
	// cevent_handler()
	public static function cevent_handler( $params ){
		sleep(2);
		$params["param1"] .= " Modified from Server";
		return $params; 
	} // end cevent_handler()
} // end CEventProgram

// cevent_handler()
function cevent_handler( $params ){
	$params["param1"] .= " Modified from Server";
	sleep(2);
	return $params;
} // end cevent_handler()
?>