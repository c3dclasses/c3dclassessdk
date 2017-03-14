//------------------------------------------------------------------------------------
// file: cattributes.js
// desc: defines base class attributes class
//------------------------------------------------------------------------------------

//-------------------------------------------------------------
// class: CAttributes
// desc:  a class that stores name/value attributes in a hash
//-------------------------------------------------------------
var CAttributes = new Class({
}); // end CAttributes

//-----------------------------------------------------------------------
// class: CCSSAttributes
// desc: defines the attributes defined in the elements style attributes
//-----------------------------------------------------------------------
var CCSSAttributes = new Class({
}); // end CCSSAttributes

//--------------------------------------------------------------
// class: CEventAttributes
// desc: defines event attribute of the element
//--------------------------------------------------------------
var CEventAttributes = new Class({
	ClassMethods : {
		loadAttributes : function( celement ){
			if( !celement )
				return false;
			var id = celement.id();			
			var cattributes=null;
			if( (cattributes=CEventAttributes[id]) == null )
				return true;
			for( name in cattributes )
				for( var i=0; i<cattributes[name].length; i++ ){
					var evtname=name.replace("on","").toLowerCase();
					if( evtname == "celementload" ) celement.load = cattributes[name][i].bind(celement);
					else if( evtname == "celementresize" ) celement.resize = cattributes[name][i].bind(celement);
					else if( evtname == "celementready" ) celement.ready = cattributes[name][i].bind(celement);
					else if( evtname == "celementunload" ) celement.unload = cattributes[name][i].bind(celement);
					else if( evtname == "cprogramc_main" ) celement.main = cattributes[name][i].bind(celement);
					else celement.event( evtname, null, null, cattributes[name][i].bind(celement) );	
				} // end for
			delete CEventAttributes[id];
			return true;	
		}, // end createAttributes()
	} // end ClassMethods
}); // end CEventAttributes

//---------------------------------------------------------------------
// class: CPropertyAttributes
// desc: defines the property attributes 
//---------------------------------------------------------------------
var CPropertyAttributes = new Class({
	ClassMethods : {
		loadAttributes : function( celement ){
			if( !celement )
				return false;
			var id = celement.id();		
			var cattributes = null;	
			if( (cattributes=CPropertyAttributes[id]) == null )
				return true;
			for( name in cattributes )
				celement[name] = this.loadAttribute( cattributes[name] );
			delete CPropertyAttributes[id];
			return true;	
		}, // end loadAttributes()
		loadAttribute : function( attr ){
			if( !attr || !attr.type || !attr.value )
				return null;
			if( attr.type == "celement" )
				return CElement.loadCElement( "#"+attr.value );
			else if( attr.type == "array" )
				return CPropertyAttributes.loadAttributeArray( attr.value );
			return attr.value;
		}, // end loadAttribute()
		loadAttributeArray : function( arrattr ){
			if( !arrattr )
				return null;
			var arrvalues = []
			for( var i=0; i<arrattr.length; i++ )
				arrvalues.push( CPropertyAttributes.loadAttribute(arrattr[i]) );
			return arrvalues;
		} // end loadAttributeArray()
	} // end ClassMethods
}); // end CPropertyAttributes

//---------------------------------------------------------------------
// class: CUnModifiedPropertyAttributes
// desc: defines the property attributes 
//---------------------------------------------------------------------
var CUnModifiedPropertyAttributes = new Class({
	ClassMethods : {
		loadAttributes : function( celement ){
			if( !celement )
				return false;
			var id = celement.id();	
			var cattributes = null;		
			if( (cattributes=CUnModifiedPropertyAttributes[id]) == null )
				return true;
			for( name in cattributes )
				celement[name] = cattributes[name];
			delete CUnModifiedPropertyAttributes[id];
			return true;	
		} // end loadAttributes()
	} // end ClassMethods
}); // end CUnModifiedPropertyAttributes