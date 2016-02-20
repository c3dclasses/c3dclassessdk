//-----------------------------------------------------------------------------------------
// file: cvar.js
// desc: represents the CVar object 
//-----------------------------------------------------------------------------------------

//----------------------------------------------------------------
// file: CVar
// desc: defines bit constants 
//----------------------------------------------------------------
var CVar = new Class({	
	// constructor
	intialize : function(){ 
		this.clear(); 
	},
	
	// crud methods
	create : function( strmemoryid, strname, value ){	
		var cvar = { m_strtype:getTypeOf(value), m_strname:strname, m_value:value } ;
		var creturn = null;
		if( ( cmemory = use_memory( strmemoryid ) ) == null ||
			( creturn = cmemory.create( cvar.m_strname, cvar.m_strvalue, cvar.m_strtype ) ) == null )
			return creturn;
		this.init( cvar );
		this.m_cmemory = cmemory;
		return creturn;	
	}, // end create()
	
	retrieve : function( strmemoryid, strname ){	
		var cmemory = null;
		var creturn = null;
		if( ( cmemory = use_memory( strmemoryid ) ) == null )
			return null;
		if( ( creturn = cmemory.retrieve( strname ) ) == null )
			return null;
		this.init( cmemory.get(strname) );
		this.m_cmemory = cmemory;
		return creturn;	
	}, // end retrieve()
	
	destroy : function(){
		var creturn = null; 
		if( ( this.m_cmemory ) == null ) 
			return creturn; 
		creturn = this.m_cmemory.delete( this.m_strname ); 
		this.clear(); 
		return creturn; 
	}, // end destroy() 
	
	get : function(){ 
		return ( this.m_cmemory == null || this.m_strname == "" || this.init( this.m_cmemory.get( this.m_strname ) ) == false ) ? undefined : this.m_value;
	}, // end get()
	
	set : function( value ){ 
		return ( this.m_cmemory == null || this.m_strname == "" || this.init( this.m_cmemory.update( this.m_strname, value, getTypeOf(value) ) ) == null ) ? "" : this.m_value; 
	}, // end set()
	
	_ : function(){ 
		return ( arguments.length > 0 ) ? this.set( arguments[0] ) : this.get(); 
	}, // end _()
	
	// other
	init : function( cvar ){ 
		if( cvar == null ) {
			alert("no cvar");
			return false;
		}
		this.m_strtype = cvar['m_strtype']; 
		this.m_strname = cvar['m_strname']; 
		this.m_value = cvar['m_value']; 
		return true;
	}, // end init()
	clear : function(){ 
		this.m_strtype = ""; 
		this.m_strname = ""; 
		this.m_value = ""; 
		this.m_cmemory = null; 
	}, // end clear()
	error : function(){ 
		if( this.m_cmemory ) 
			return this.m_cmemory.error(); 
	}, // end error()
	save : function(){ 
		if( this.m_cmemory ) 
			this.m_cmemory.save(); 
	},	// end save()
	retore : function(){ 
		if( this.m_cmemory ) 
			this.m_cmemory.restore(); 
	},	// end restore()
	ClassMethods : {
	} // end ClassMethods
}); // end CVar

//---------------------------------------------------------------------
// name: CVarManager
// desc: manages cvar objects
//---------------------------------------------------------------------
var CVarManager = new Class({
	
ClassMethods : {
	// methods
	create : function( strmemoryid, strname, value ){ 
		return ( ( cvar = new CVar() ) == null|| cvar.create( strmemoryid, strname, value ) == false ) ? null : cvar; 
	}, // end create() 
	get : function( strmemoryid, strname ){ 
		var cvar=null;
		return ( ( cvar = new CVar() ) == null || cvar.retrieve( strmemoryid, strname ) == false ) ? null : cvar; 
	}, // end get()
	destroy : function( cvar ){ 
		if( cvar == null ) 
			return; 
		cvar.destroy(); 
		return; 
	} // end destroy()
} // end ClassMethods
}); // end CVarManager

// cvar management functions
function newvar( strmemoryid, strname, strvalue ){ 
	return CVarManager.create( strmemoryid, strname, strvalue );  
} // end newvar()
function getvar( strmemoryid, strname ){ 
	return CVarManager.get( strmemoryid, strname );  
} // end getvar()
function delvar( cvar ){ 
	CVarManager.destroy( cvar );  
} // end delvar()

// creates / gets a new cvar
function _var( strmemoryid, strname, strvalue ){
	return ( newvar( strmemoryid, strname, strvalue ) || getvar( strmemoryid, strname ) );
} // end _var()