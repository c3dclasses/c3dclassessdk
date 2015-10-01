//-----------------------------------------------------------------------------------------
// file: cpath.php
// desc: defines a class that store path information used globally throughout the sdk
//-----------------------------------------------------------------------------------------

//-----------------------------------------------------------
// name: CPath
// desc: singleton object used to store handler functions
//-----------------------------------------------------------
var CPath = new Class ({
	ClassMethods : {		
		m_chashpath : new CHash(),
		add : function( strpathname, strpathvalue, params ){
			if( strpathname == "" || strpathname == null || strpathvalue == null || strpathvalue == "" )
				return false;
			if( CPath.m_chashpath == null )
				CPath.m_chashpath = new CHash();		
			if( !params ) 
				params = {};
			params["path"]=strpathvalue; 
			CPath.m_chashpath.set( strpathname, params );
			return true;
		}, // end add()
		remove : function( strpathname ){
			if( strpathname == "" || strpathname == null || CPath.m_chashpath == null )
				return false;
			CPath.m_chashpath.remove( strpathname );
			return true;
		}, // end remove()
		get : function( strpathname ){	 
			return ( CPath.m_chashpath != null ) ? CPath.m_chashpath.get( strpathname ) : null;	
		}, // end get()
		_ : function( strpathname ){	 
			var path = CPath.get( strpathname );
			return ( path ) ? path["path"] : ""; 
		} // end _()
	} // end ClassMethods
}); // end CPath

// includes 
function include_path( strpathname, strpathvalue ){
	return CPath.add( strpathname, strpathvalue );
} // end include_path