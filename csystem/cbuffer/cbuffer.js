//------------------------------------------------------
// file: cbuffer.js
// desc: 
//------------------------------------------------------

//------------------------------------------------------
// name: CBuffer
// desc: 
//------------------------------------------------------
var CBuffer = new Class({
    
    initialize : function(){
        this.m_cvar=null;
    }, // end initialize()

	setCVar : function( cvar ){
		this.m_cvar = cvar;
	}, // end setID()
	
	append : function( str ){
		if( !str )
			return false;
		if( !this.m_cvar )
			return false;
		
		alert("update the var with: " + str );	
		
		this.m_cvar._( this.m_cvar._() + str ); // append the string to the buffer
		return true;
	}, // end append()
	
	async_print : function( time ){
		var _this = this;
		_print( _this.flush() );
		_while( time, function(){
			_print("hello<br />");
			_print( _this.flush() );
		}); // end _while()
	}, // end async_print()
	
	flush : function(){
		if( !this.m_cvar )
			return "";
		str = this.m_cvar._(); 
		this.m_cvar._("");
		return str;
	}, // end flush()
	
	ClassMethods : {
		m_cvars : null,
		m_cbuffer : null,
		get : function( varid ){
			//alert( varid );
			var cvar=null;
			if( !varid )
				return null;
			if( !CBuffer.m_cbuffer )
				CBuffer.m_cbuffer = new CBuffer();
			if( !CBuffer.m_cvars )
				CBuffer.m_cvars={};
			if( !CBuffer.m_cvars[varid] ) {
				if( !(cvar=_var("cbuffer",varid)) )
					return null;
				else CBuffer.m_cvars[varid] = cvar;
			}
			//alert(CBuffer.m_cvars[varid]._());
			CBuffer.m_cbuffer.setCVar( CBuffer.m_cvars[varid] );
			return CBuffer.m_cbuffer;
		} // end get()
	} // end ClassMethods
});  // end CBuffer

function cbuffer( varid ){
	return CBuffer.get( varid );
} // end cbuffer()