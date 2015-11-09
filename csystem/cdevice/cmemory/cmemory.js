//----------------------------------------------------------------
// file: cmemory.js
// desc: defines a memory object
//----------------------------------------------------------------
var CMemory = new Class({
	
	////////////////////////
	// constructor
	intialize : function(){ 
		this.close();
	}, // end CMemory() 
	
	////////////////////////
	// opening / closing
	open : function( strmemid, params ){
		if( strmemid == "" || strmemid == null )
			return false;
		if( params ) {
			this.m_strid = strmemid;
			this.m_jsondata = params;
			return true;
		} // end if
		var creturn = CEvent.fire( "oncmemory", { memid:strmemid, memcommand:"open" } );
		if( !creturn )
			return false;
		var _this = this;
		_if( function(){ return creturn.isdone(); }, function(){
			var params = creturn.data();
			if( params == null && params[0] == null )
				_this.m_jsondata = null;
			_this.m_jsondata = jQuery.parseJSON(params[0].m_jsondata);
			//( _this.m_jsondata );
			//alert( print_r( _this.m_jsondata, true ) );
			this._return();
		})._elseif( function(){ return creturn.iserror(); }, function(){
			alert("ERROR: could not open memory");
			_this.m_jsondata = null;
			this._return();
		})._elseif( function(){ return creturn.isbusy(); }, function(){
			//printbr("BUSY");
		})._endif(); 
		this.m_strid = strmemid;
		return true;	
	}, // end open()
	close : function(){
		this.m_strid = "";
		this.m_jsondata = null;
		this.m_bloading = false;
		return true; 
	}, // end close()
	
	////////////////////////////////////////////////
	// create / retrieve / update / delete (CRUD)
	create : function( strname, value, strtype ){ 	
		if( !this.m_strid || !strname || !this.m_jsondata )
			return null;	  
		if( this.m_jsondata[strname] ) // check if data is already created
			return null;
		//value = ( !value ) ? null : value;
		//strtype = ( !strtype ) ? "" : strtype;	
		this.m_jsondata[strname]={m_strname:strname, m_value:value, m_strtype:strtype};	// store it locally
		return CEvent.fire( "oncmemory", { memid:this.m_strid, memcommand:"create", varname:strname, varvalue:value, vartype:strtype } ); // store it remotely
	}, // end create()
	retrieve : function( strname ){ 
		if( !this.m_strid || !strname || !this.m_jsondata || !this.m_jsondata[strname] )
			return null;	  
		var creturn = CEvent.fire("oncmemory", {memid:this.m_strid, memcommand:"retrieve", varname:strname});
		creturn.formatfn(function(data){return jQuery.parseJSON(data[0].m_jsondata);});
		var _this = this;
		_if( function(){ return creturn.isdone(); }, function(){
			//var params = creturn.data();
			//if( params == null && params[0] == null )
			//	_this.m_jsondata = null;
			//var cvar = jQuery.parseJSON(params[0].m_jsondata);
			var cvar=creturn.data();
			_this.m_jsondata[cvar.m_strname]=cvar;
			this._return();
		})._elseif( function(){ return creturn.iserror(); }, function(){
			//alert("ERROR: could not open memory");
			_this.m_jsondata = null;
			this._return();
		})._elseif( function(){ return creturn.isbusy(); }, function(){
			//printbr("BUSY");
		})._endif(); 
		return creturn;
		//return this.m_jsondata[strname]; // retrieve it locally
	}, // end retrieve()
	update : function( strname, value, strtype ){ 
		if( !this.m_strid || !strname || !this.m_jsondata || !this.m_jsondata[strname] )
			return null;	  
		var creturn = CEvent.fire( "oncmemory", { memid:this.m_strid, memcommand:"update", varname:strname, varvalue:value, vartype:strtype }); // update it remotely
		this.m_jsondata[strname].m_strname = strname;
		if( value ) this.m_jsondata[strname].m_value = value;
		if( strtype ) this.m_jsondata[strname].m_strtype = strtype;	
		return creturn;
	}, // end update()
	delete : function( strname ){
		if( !this.m_strid || !strname || !this.m_jsondata || !this.m_jsondata[strname] )
			return null;		  
		var creturn = CEvent.fire( "oncmemory", { memid:this.m_strid, memcommand:"delete", varname:strname }); // update it remotely
		this.m_jsondata[strname] = null;
		delete this.m_jsondata[strname];
		return creturn;
	}, // end delete()
	
	batch : function( crudop, params ){
		if( !this.m_strid || !crudop || !params )
			return null;
		var creturn = CEvent.fire( "oncmemory", { memid:this.m_strid, memcommand:crudop, membatch:true, memparams:params }); // update it remotely
		creturn.formatfn(function(data){return jQuery.parseJSON(data[0].m_jsondata);});
		return creturn;
	}, // end batch()
	
	/*
	save : function(){ 
		return false; 
	}, // end save()
	/*
	error : function(){ 
		return "ERROR";
	}, // end error()
	
	serialize : function( value ){ 
		return serialize(value); 
	}, // end serialize()
	unserialize : function( value, type ){ 
		return unserialize(value); 
	}, // end unserialize()  
	*/
	
	
	/*
	create : function( strname, value, strtype ){ 	
		return CEvent.fire( "oncmemory", { memid:this.m_strid, varcommand:"create", varname:strname, varvalue:value, vartype:strtype } );
	}, // end create()
	retrieve : function( strname ){ 
		return CEvent.fire( "oncmemory", { memid:this.m_strid, varcommand:"retrieve", varname:strname } );
	}, // end retrieve()
	
	delete : function( strname ){ 
		return CEvent.fire( "oncmemory", { memid:this.m_strid, varcommand:"delete", varname:strname } );
	}, // end delete()
	*/
	
	_toString : function(){ 
		return print_r( this.m_jsondata, true ); 
	}, // end toString() 
	
	data : function(){
		return this.m_jsondata; 
	}, // end data()
		
	ClassMethods:{
		m_cmemory : null,
		use : function( strmemid, params ){
			if( strmemid == "" || strmemid == null )
				return null;
			if( !CMemory.m_cmemory )
				CMemory.m_cmemory = [];
			if( CMemory.m_cmemory[strmemid] )
				return CMemory.m_cmemory[strmemid];
			var cmemory=null;
			if( !(cmemory = new CMemory()) || !cmemory.open(strmemid, params) )
				return null;
			CMemory.m_cmemory[strmemid] = cmemory;
			return cmemory;
		} // end use
	} // end classmethods
}); // end CMemory()

/*
function include_memory( $strid, $strpath, $strtype, $params=NULL ){
	$params["cresource_type"] = $strtype;
	return includeresource( $strid, $strpath, $params );
} // end include_memory()
*/
function use_memory( strid, params ){
	return CMemory.use( strid, params );
} // end use_memory()