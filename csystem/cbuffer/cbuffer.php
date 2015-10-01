<?php
//------------------------------------------------------------------------------------
// file: cbuffer.php
// desc:  
//------------------------------------------------------------------------------------

// includes
include_memory( "cbuffer", dirname(__FILE__)."/cbuffer.json", "CJSONMemory", array("client"=>true) );
include_js( relname(__FILE__) . '/cbuffer.js');

//-----------------------------------------------
// name: CBuffer
// desc: 
//-----------------------------------------------
class CBuffer{	
	protected $m_cvar;	 // stores the variable object
	static protected $m_cbuffer; // stores a buffer object
	static protected $m_cvars;	 // stores the variable object
	
	public function CBuffer(){
		$this->m_cvar=NULL;
	} // end CBuffer()
	
	public function setCVar( $cvar ){
		$this->m_cvar = $cvar;
	} // end setID()
	
	public function append( $str ){
		if( !$str )
			return false;
		if( !$this->m_cvar )
			return false;
		$this->m_cvar->_( $this->m_cvar->_() . $str ); // append the string to the buffer
		return true;
	} // end append()
	
	public function flush(){
		if( !$this->m_cvar )
			return "";
		$str = $this->m_cvar->_(); 
		$this->m_cvar->_("");
		return $str;
	} // end flush()
	
	public static function get( $varid ){
		$buffer=NULL;
		if( !$varid )
			return NULL;
		if( !CBuffer :: $m_cbuffer ){
			CBuffer :: $m_cbuffer = new CBuffer();
		}
		if( !CBuffer :: $m_cvars )
			if( isset( CBuffer :: $m_cvars[$varid] ) == false ) 
				if( !($buffer=_var("cbuffer",$varid)) )
					return NULL;
				else CBuffer :: $m_cvars[$varid] = $buffer;		
		CBuffer :: $m_cbuffer->setCVar( CBuffer :: $m_cvars[$varid] );
		return CBuffer :: $m_cbuffer;
	} // end get()
} // end CBuffer

function cbuffer( $varid ){
	return CBuffer :: get( $varid );
} // end cbuffer()
?>