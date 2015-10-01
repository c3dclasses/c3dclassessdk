//-------------------------------------------------------------------------------------------------------
// file: cevent.js
// desc: provides a way for the client to execute handlers defined on the server
//-------------------------------------------------------------------------------------------------------

//-----------------------------------------------------------
// name: CEvent
// desc: singleton object used to store handler functions
//-----------------------------------------------------------
var CEvent = new Class ({
	ClassMethods : { 		
	fire : function( streventname, params, uri ){	
		//alert( CPath._("CKernal_instance"));
		var uri = ( !uri ) ? CPath._("main") : uri;
		var cds = new CDataStream();	// create
    	if( !cds || cds.open( uri, "post", "cevent" ) == false ) // open
     		return null;
		cds.setDataParam("cevent",true);
		cds.setDataParam("cevent_name", streventname);
		if( params ){
			/*if( typeof params == 'array') )*/
			for( var name in params )  {
				//alert( name );
				cds.setDataParam( name, params[name] );
			} // end for
			//else cds.setDataParam( name, params );
		} // end if
		cds.options("m_basync",false);
		return cds.send();
	} // end fire()
	} // end ClassMethods
}); // end CEvent