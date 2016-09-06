//----------------------------------------------------------------------------
// file: celementattributes.js
// desc: defines an object contains the javascript, css, and tag attributes
//----------------------------------------------------------------------------

//--------------------------------------------------------------------------------
// name: CElementAttributes
// desc: defines an object contains the javascript, css, and tag attributes
//--------------------------------------------------------------------------------
var CElementAttributes = new Class({
	//-------------------------------------------------
	// name: CElementAttributes()
	// desc: constructor
	//-------------------------------------------------
	initialize : function(){ 
		this.m_element = null; 
		this.m_jelement = null; 
		this.m_tag = 'div';
	}, // end CElementAttributes()
	
	//-------------------------------------------------------
	// name: create()
	// desc: creates the element attribute object
	//-------------------------------------------------------
	create : function(params) {
		if( !jQuery )
			return false;
		var jelement = null;
		if( params === undefined ){
			var element = document.createElement(this.m_tag);
			jelement = jQuery( element );
		} // end if
		else jelement = jQuery(params);
		if( !jelement )
			return false;
		var element = jelement.get(0);
		if( !element )
			return false;
		this.m_element = element;
		this.m_jelement = jelement;
		return true;
    }, // end create()
    
	//---------------------------------------------------------
	// name: getElement()
	// desc: returns the element
	//---------------------------------------------------------
	getElement : function (){ 
		return this.m_element; 
	}, // end getElement() 
	
	//---------------------------------------------------------------------
	// name: attr(), css(), event(), on(), fire(), clearevent(), prop() 
	// desc: sets related properites and behaviors of this element
	//---------------------------------------------------------------------
	attr : function(){ if(!this.m_jelement) return this; var ret = this.m_jelement.attr.apply( this.m_jelement, arguments ); return ( arguments.length == 1 ) ? ret : this; },
	css: function(){ if(!this.m_jelement) return this; var ret = this.m_jelement.css.apply( this.m_jelement, arguments ); return ( arguments.length == 1 ) ? ret : this; },
	event : function(){ return this.on.apply( this, arguments ); },
	on : function(){ if(this.m_jelement) this.m_jelement.on.apply( this.m_jelement, arguments ); return this; },
	off : function(){},
	fire : function(){},
	clearevent : function(){},
	prop : function(){},
	
	printbr : function(str){ this._echo(str + "</br>"); },
	_echo : function(str){ this.m_jelement.append(str); },
	
	//---------------------------------------------------------------------
	// name: other 
	// desc: sets related properites and behaviors of this element
	//---------------------------------------------------------------------
	propref : function( strname, refvalue ){},
	uprop : function( strname, value ){},
	info : function(){}, 
	icss : function(){},
	ievent : function( strname, value ){},
	sevent : function(){ 
		if( arguments.length < 2 )
			return this;
		var cserverevent_obj = { strhandler:arguments[1] };
		var cserverevent_handler = function(){
		} // end cserverevent_handler()
		cserverevent_handler = cserverevent_handler.bind( cserverevent_obj );
		arguments[1]=cserverevent_handler;
		return this.event( arguments[0], cserverevent_handler );
	}, // end sevent()
	tween : function(){},
	
	//--------------------------------------------------------------
	// name: id(), classes(), addClass(), hasClass(), removeClass() 
	// desc: other
	//-------------------------------------------------------------
	id : function(){ return ( arguments.length == 0 ) ? this.attr("id") : this.attr("id",arguments[0]); },	
	classType : function(){ return this.attr("classtype"); },	
	classes : function(){ return ( arguments.length == 0 ) ? this.attr("class") : this.attr("class",arguments); },
	addClass : function( value ){ if( this.m_jelement ) this.m_jelement.addClass( value ); return this; }, 
	hasClass : function( value ){ return ( this.m_jelement ) ? this.m_jelement.hasClass( value ) : false; },
	removeClass : function( value ){ if( this.m_jelement ) this.m_jelement.removeClass( value ); return this; },
	toggleClass : function( value ){ if( this.m_jelement ) this.m_jelement.toggleClass( value ); return this; },
	replaceClass : function( value ){},
	
	//-------------------------------------------------------------
	// name: onload(), onunload(), onresize(), onready()
	// desc: event handlers that can be overridden
	//-------------------------------------------------------------
	onload : function(){ /*alert("running onload() from jscript");*/ },
	onunload : function(){ /* alert("running onunload() from jscript");*/ },
	onresize : function(){ /*alert("running onresize() from jscript");*/ },
	onready : function(){ alert("running onready() from jscript"); },
	
	//------------------------------------------------------------
	// name: other 
	// desc: helpers that return jquery, mootools, yui objects
	//------------------------------------------------------------
	getEventHandlers : function( strevent ){ return ( this.m_element==null || (data = jQuery.data( this.m_element, 'events' )) == null || data[strevent]==null ) ? null : data[strevent]; },
	jq : function(param){ return this.jquery(param); },
	jquery : function(param){ return (!this.m_jelement) ? null : ( (!param) ? this.m_jelement : this.m_jelement.find(param) ); },
	mt : function(param){ return this.mootools(param); },
	mootools : function(param){ return (!this.m_element || !Element) ? null : new Element(this.m_element); },
	yui : function(param){},
	_toString : function(){}
}); // CElementAttributes