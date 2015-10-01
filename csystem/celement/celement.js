//----------------------------------------------------------------
// file: celement.js
// desc: extendes the mootools element class
//----------------------------------------------------------------

//---------------------------------------------------------
// class: CElement
// desc: defines the base class of an element object
//---------------------------------------------------------
var CElement = new Class({ 
	Extends : CElementAttributesEx,	
	
	// constructing
	initialize : function(){
		this.m_content = new CElementContent(); 
		this.parent(); 
	}, // end CElement()
	
	// creating 
	create : function( param ){ 
		return this.parent( param ) && this.m_content.create(this); 
	}, // create()
	
	// properties
	tag : function(){ 
		if( arguments.length == 0 ) 
			return ( this.m_element ) ? this.m_element.tagName : ""; 
		else {
			if( this.m_element ){
				alert("adding tag name");
				this.m_element.tagName = arguments[0]; 
			}
		} // end else
	}, // end tag(),
	state : function(){ if( arguments.length == 0 ) return this.attr( "state" ); this.attr( "state", arguments[0] ); return this; },
	value : function(){ if(!this.m_jelement) return this; if( arguments.length == 0 ) return this.m_jelement.val(); this.m_jelement.val( arguments[0] ); return this; },
	text : function(){ if(!this.m_jelement) return this; if( arguments.length == 0 ) return this.m_jelement.text(); this.m_jelement.text( arguments[0] ); return this; },
	html : function(){ if(!this.m_jelement) return this; if( arguments.length == 0 ) return this.m_jelement.html(); this.m_jelement.html( arguments[0] ); return this; }, 
	name : function(){ if( arguments.length == 0 ) return this.attr( "name" ); this.attr( "name", arguments[0] ); return this; },
	content : function(){ return this.m_content; },
	filename : function(){ return this.m_filename; },
	urifilename : function(){ return this.m_urifilename; },
	
	// padding, margins, border
	padding:function(prop){if(!this.m_jelement)return this;if(arguments.length==1)return this.m_jelement.padding()[prop];var obj={};obj[prop]=arguments[1];this.m_jelement.padding(obj);return this; },
	margin:function(prop){if(!this.m_jelement)return this;if(arguments.length==1)return this.m_jelement.margin()[prop];var obj={};obj[prop]=arguments[1];this.m_jelement.margin(obj);return this; },
	border:function(prop){if(!this.m_jelement)return this;if(arguments.length==1)return this.m_jelement.border()[prop]; var obj={};obj[prop]=arguments[1];this.m_jelement.border(obj);return this;},
	p:function(prop){if(!this.m_jelement)return this;if(arguments.length==1)return this.m_jelement.padding()[prop];var obj={};obj[prop]=arguments[1];this.m_jelement.padding(obj);return this; },
	m:function(prop){if(!this.m_jelement)return this;if(arguments.length==1)return this.m_jelement.margin()[prop];var obj={};obj[prop]=arguments[1];this.m_jelement.margin(obj);return this; },
	b:function(prop){if(!this.m_jelement)return this;if(arguments.length==1)return this.m_jelement.border()[prop]; var obj={};obj[prop]=arguments[1];this.m_jelement.border(obj);return this;},
	
	// position
	position : function(){ if( arguments.length == 0 ) return this.css( "position" ); this.css( "position", arguments[0] ); return this; },
	x : function(){ var pt = this.cpoint(); return ( arguments.length == 0 ) ? pt.x : this.cpoint( arguments[0], pt.y, pt.z ); },   
	y : function(){ var pt = this.cpoint(); return ( arguments.length == 0 ) ? pt.y : this.cpoint( pt.x, arguments[0], pt.z ); },   
	z : function(){ var pt = this.cpoint(); return ( arguments.length == 0 ) ? pt.z : this.cpoint( pt.x, pt.y, arguments[0] ); },  
	lockx: function(){ if( arguments.length == 0 ) return this.attr( "lockx" ); this.attr( "lockx", arguments[0] ); return this; },
	locky: function(){ if( arguments.length == 0 ) return this.attr( "locky" ); this.attr( "locky", arguments[0] ); return this; },
	lockz: function(){ if( arguments.length == 0 ) return this.attr( "lockz" ); this.attr( "lockz", arguments[0] ); return this; },
	minx: function(){ if( arguments.length == 0 ) return this.attr( "minx" ); this.attr( "minx", arguments[0] ); return this; },
	miny: function(){ if( arguments.length == 0 ) return this.attr( "miny" ); this.attr( "miny", arguments[0] ); return this; },
	minz: function(){ if( arguments.length == 0 ) return this.attr( "minz" ); this.attr( "minz", arguments[0] ); return this; },
	maxx: function(){ if( arguments.length == 0 ) return this.attr( "maxx" ); this.attr( "maxx", arguments[0] ); return this; },
	maxy: function(){ if( arguments.length == 0 ) return this.attr( "maxy" ); this.attr( "maxy", arguments[0] ); return this; },
	maxz: function(){ if( arguments.length == 0 ) return this.attr( "maxz" ); this.attr( "maxz", arguments[0] ); return this; },
	cpoint : function(){
		if(!this.m_jelement) 
			return this;
		var ox = (this.margin('left') + this.border('left') + this.padding('left'));
		var oy = (this.margin('top') + this.border('top') + this.padding('top'));
		var oz = 0;
		if( arguments.length == 0 ){
			var pt = this.m_content.cpoint();
			if(!isNaN(pt.x)) pt.x -= ox;
			if(!isNaN(pt.y)) pt.y -= oy;
			if(!isNaN(pt.z)) pt.z -= oz;
			return pt;
		} // end if
		return this.m_content.cpoint(arguments[0]+ox,arguments[1]+oy,arguments[2]+oz);
	}, // end cpoint()
	
	// dimensions
	w : function(){ var sz = this.csize(); return ( arguments.length == 0 ) ? sz.w : this.csize( arguments[0], sz.h, sz.l ); },
	h : function(){ var sz = this.csize(); return ( arguments.length == 0 ) ? sz.h : this.csize( sz.w, arguments[0], sz.l ); },
 	l : function(){ var sz = this.csize(); return ( arguments.length == 0 ) ? sz.l : this.csize( sz.w, sz.h, arguments[0] ); },
	lockw: function(){ if( arguments.length == 0 ) return this.attr( "lockw" ); this.attr( "lockw", arguments[0] ); return this; },
	lockh: function(){ if( arguments.length == 0 ) return this.attr( "lockh" ); this.attr( "lockh", arguments[0] ); return this; },
	lockl: function(){ if( arguments.length == 0 ) return this.attr( "lockl" ); this.attr( "lockl", arguments[0] ); return this; },
	minw: function(){ if( arguments.length == 0 ) return this.attr( "minw" ); this.attr( "minw", arguments[0] ); return this; },
	minh: function(){ if( arguments.length == 0 ) return this.attr( "minh" ); this.attr( "minh", arguments[0] ); return this; },
	minl: function(){ if( arguments.length == 0 ) return this.attr( "minl" ); this.attr( "minl", arguments[0] ); return this; },
	maxw: function(){ if( arguments.length == 0 ) return this.attr( "maxw" ); this.attr( "maxw", arguments[0] ); return this; },
	maxh: function(){ if( arguments.length == 0 ) return this.attr( "maxh" ); this.attr( "maxh", arguments[0] ); return this; },
	maxl: function(){ if( arguments.length == 0 ) return this.attr( "maxl" ); this.attr( "maxl", arguments[0] ); return this; },
	csize : function(){
		if(!this.m_jelement) 
			return this;
		var ow = (this.margin('left') + this.margin('right') + this.border('left') + this.border('right') + this.padding('left') + this.padding('right'));
		var oh = (this.margin('top') + this.margin('bottom') + this.border('top') + this.border('bottom') + this.padding('top') + this.padding('bottom'));
		var ol = 0;
		if( arguments.length == 0 ) 
		{
			var sz = this.m_content.csize();
			if(!isNaN(sz.w)) sz.w += ow;
			if(!isNaN(sz.h)) sz.h += oh;
			if(!isNaN(sz.l)) sz.l += ol;
			return sz;  
		} // end if
		return this.m_content.csize(arguments[0]-ow,arguments[1]-oh,arguments[2]-ol);
	}, // end csize()
	crectangle : function(){
		var crectangle = new CRectangle();
		var pt = this.cpoint();
		var sz = this.csize();
		crectangle.create( pt.x, pt.y, pt.z, sz.w, sz.h, sz.l );
		return crectangle;
	}, // end rectangle()
		
	// elements
	find : function( params ){
		var jelements = this.jq(params);
		if( !jelements )
			return null;
		var celements = [];
		var celement = null;
		for( var i=0; i<jelements.length; i++ )
			//if( (celement = new CElement()) && celement.create(jelements[i]) )
			  if( celement = CElement.toCElement( jelements[i] ) )
					celements.push( celement );
		return celements;
	}, // end findCElements()

	remove : function(){ 
		this.jq().remove();
	}, // end remove()

	moveSibling : function( i ){ 			// moves a sibling from current location to ith location
		var cparent = this.getParent();
		if( !cparent )
			return false;
		var cchild = cparent.getChildByIndex( i );
		if( !cchild || cchild.m_element == this.m_element )	// moving diferent elements
			return false;
		cchild.prevSibling( this );	
		return true;
	}, // end moveSibling()
		
	// element's parent methods
	getParent : function(){
		var celement = null;
		return ( celement = CElement.toCElement(this.jq().parent().get(0))) ? celement : null
	}, // end getParent()
		
	// element's sibling methods
	nextSibling : function(){
		if( arguments.length == 0 ) // getting the next element
			return CElement.toCElement( this.jq().next().get(0) ); 
		var celement = CElement.toCElement( arguments[0] );
		if( celement )
			celement.jq().insertAfter( this.m_element );	
		return;
	}, // end nextSibling() 
	
	prevSibling : function(){
		if( arguments.length == 0 ) // getting the prev element
			return CElement.toCElement( this.jq().prev().get(0) ); 
		var celement = CElement.toCElement( arguments[0] );
		if( celement )
			celement.jq().insertBefore( this.m_element );	
		return; 
	}, // end prevSibling() 

	// element's children
	getChildren : function(){ 
		var jelements = this.jq().children();
		if( !jelements )
			return null;
		var celements = [];
		var celement = null;
		for( var i=0; i<jelements.length; i++ )
			if( ( celement = CElement.toCElement( jelements[i] ) ) )
				celements.push( celement );
		return celements;
	}, // end getChildren() 
	
	getChildByIndex : function( i ){
		var jelements = this.jq().children();
		return ( !jelements || i>=jelements.length || i<0 ) ? null : CElement.toCElement( jelements[i] );
	}, // end getChildByIndex()

	pushChild : function( element ){
		var celement = CElement.toCElement( element );
		if( !celement )
			return null;
		this.jq().append( celement.m_element );	
		return celement;
	}, // end pushChild()
	
	popChild : function(){
		var jelements = this.jq().children();
		if( jelements && jelements[jelements.length-1] )
			jQuery(jelements[jelements.length-1]).remove();
	}, // end popChild()
	
	shiftChild : function(){
		var jelements = this.jq().children();
		if( jelements && jelements[0] )
			jQuery(jelements[0]).remove();	
	}, // end shiftChild()
	
	unshiftChild : function( element ){
		/*if( !element )
			return false;
		var jelements = this.jq().children();
		if( !jelements || !jelements[0] )
			return false;
		var celement = CElement.toCElement( jelements[0] );
		if( !celement )
			return false;
		celement.prevSibling( element );
		*/
		var celement = CElement.toCElement( element );
		if( !celement )
			return null;
		this.jq().prepend( celement.m_element );	
		return celement;
	
		return true;
	}, // end unshiftChild()
	
	insertChild : function( element, i ){
		if( !element )
			return false;
		var jelements = this.jq().children();
		if( !jelements || i>=jelements.length || i<0 )
			return false;
		var celement = CElement.toCElement( jelements[i] );
		if( !celement )
			return false;
		//alert("inserted a new element");
		celement.prevSibling( element );	
		return true;
	}, // end insertChild()
	
	removeChild : function( i ){
		var jelements = this.jq().children();
		if( jelements && i>-1 && i<jelement.length && jelements[i] )
			jQuery(jelements[i]).remove();	
	}, // end removeChild()
	
	// other
	isCElement : function(){ 
		return true; 
	}, // end isCElement()
	
	ClassMethods : {
		m_celements : null,
		m_type : null,

		getCElement : function( strid ){
			return CElement.m_celements.get( strid );
		}, // end getCElement()
		
		createCElement : function( strtagname, type ){
			if( type ) 
				this.setType( type );
			var celement = CElement.toCElement( document.createElement(strtagname) );
			this.setType( CElement );
			return celement;
		}, // end createCElement()
		
		toCElement : function( element ){ 
			if( !element )
				return null;
			if( element.isCElement )
				return element;
			var celement = new CElement_Type();
			return ( celement.create( element ) ) ? celement : null;
		}, // end toCElement()
		
		setType : function( type ){
			CElement_Type = type;
		}, // end setType()
		
		toCElements : function( elements ){
			var jelements = jQuery(elements);
			if( !jelements )
				return null;
			var celements = [];
			var celement = null;
			for( var i=0; i<jelements.length; i++ )
				if( (celement = new CElement()) && celement.create(jelements[i]) )
					celements.push( celement );
			return celements;
		}, // end toCElements()
			
		loadCElements : function(){
			var elements = (jQuery)?jQuery(".celement"):null;
			if( !elements )
				return false;
			for( var i=0; i<elements.length; i++ )
				if( CElement.loadCElement( elements[i] ) == null )
					return false;
			return true;			
		}, // end loadCElements()
		
		loadCElement : function( element ){
			var jelement=null;
			if( !element || (jelement=jQuery(element)) == null )
				return null;
			if( CElement.m_celements == null )
				CElement.m_celements = new CHash();
			var strtype = jelement.attr("classtype");
			var strid = jelement.attr("id");
			var celement = null;
			if( (celement = CElement.m_celements.get( strid )) != null )
				return celement;
			if( typeof( strtype ) != "string" || 
				window.hasOwnProperty(strtype) == false ||
				(celement = new window[strtype]()) == null ||
				celement.create( element ) == false )
				return null;
			CElement.m_celements.set( strid, celement );	
			if( CPropertyAttributes.loadAttributes( celement ) == false ||
				CEventAttributes.loadAttributes( celement ) == false ){
				CElement.m_celements.remove( strid );		
				return null;
			} // end if()
			celement.load();	// methods defined in php
			celement.onload();	// methods defined in js events
			return celement;
		}, // end loadCElement()
		
		unloadCElements : function(){
			if( CElement.m_celements == null )
				return false;
			var celements = CElement.m_celements._();
			if( !celements )
				return false;
			for( name in celements ){
				celements[name].unload();	// methods defined in php
				celements[name].onunload(); // methods defined in js events
			} // end for
			return true;
		}, // end unloadCElement()
		
		readyCElements : function(){
			if( CElement.m_celements == null )
				return false;
			var celements = CElement.m_celements._();
			if( !celements )
				return false;
			for( name in celements ){
				//alert( name );
				celements[name].ready();	// methods defined in php
				celements[name].onready(); // methods defined in js events
			} // end for
			return true;
		}, // end readyCElement()
		
		resizeCElements : function(){
			if( CElement.m_celements == null )
				return false;
			var celements = CElement.m_celements._();
			if( !celements )
				return false;
			for( name in celements ){
				celements[name].resize();	// methods defined in php
				celements[name].onresize(); // methods defined in js events
			} // end for
			return true;
		} // end resizeCElement()
	} // end ClassMethods
});// end CElement

//------------------------------------------------------------------
// name: CElementContent
// desc: defines the element content area
//------------------------------------------------------------------
var CElementContent = new Class({
	initialize : function(){ this.m_celement = null; this.m_jelement = null; },
	create : function( celement ){ this.m_celement = celement; this.m_jelement = celement.m_jelement; return true }, 
	
	// standard 
	left : function(){ if( arguments.length == 0 ) return this.m_celement.css( "left" ); this.m_celement.css( "left", arguments[0] ); return this.m_celement; },
	right : function(){ if( arguments.length == 0 ) return this.m_celement.css( "right" ); this.m_celement.css( "right", arguments[0] ); return this.m_celement; },
	bottom : function(){ if( arguments.length == 0 ) return this.m_celement.css( "bottom" ); this.m_celement.css( "bottom", arguments[0] ); return this.m_celement; },
	top : function(){ if( arguments.length == 0 ) return this.m_celement.css( "top" ); this.m_celement.css( "top", arguments[0] ); return this.m_celement; },
	zindex : function(){ if( arguments.length == 0 ) return this.m_celement.css( "z-index" ); this.m_celement.css( "z-index", arguments[0] ); return this.m_celement; },
	width : function(){ if( arguments.length == 0 ) return this.m_celement.css( "width" ); this.m_celement.css( "width", arguments[0] ); return this.m_celement; },
	height : function(){ if( arguments.length == 0 ) return this.m_celement.css( "height" ); this.m_celement.css( "height", arguments[0] ); return this.m_celement; },
	length : function(){ if( arguments.length == 0 ) return this.m_celement.attr( "length" ); this.m_celement.attr( "length", arguments[0] ); return this.m_celement; },
	
	// positioning
	x : function(){ var pt = this.cpoint(); return ( arguments.length == 0 ) ? pt.x : this.cpoint( arguments[0], pt.y, pt.z ); },   
	y : function(){ var pt = this.cpoint(); return ( arguments.length == 0 ) ? pt.y : this.cpoint( pt.x, arguments[0], pt.z ); },   
	z : function(){ var pt = this.cpoint(); return ( arguments.length == 0 ) ? pt.z : this.cpoint( pt.x, pt.y, arguments[0] ); },   
	cpoint : function(x, y, z){		
		if(!this.m_jelement) 
			return this;
		if( arguments.length == 0 ){
			var pt = this.m_jelement.position();	
			return { x : pt.left, y : pt.top, z : this.zindex() };
		} // end if
		var bx = this.m_celement.attr("blockx");
		var by = this.m_celement.attr("blocky");
		var bz = this.m_celement.attr("blockz");	
		this.m_jelement.offset({top:arguments[1], left:arguments[0]});
		this.zindex("z-index", arguments[2]);
		return this;
	}, // end cpoint()
	
	// dimensions
	w : function(){ var sz = this.csize(); return ( arguments.length == 0 ) ? sz.w : this.csize( arguments[0], sz.h, sz.l ); },
	h : function(){ var sz = this.csize(); return ( arguments.length == 0 ) ? sz.h : this.csize( sz.w, arguments[0], sz.l ); },
	l : function(){ var sz = this.csize(); return ( arguments.length == 0 ) ? sz.l : this.csize( sz.w, sz.h, arguments[0] ); },
	csize : function(){
		if(!this.m_jelement) 
			return this;
		if( arguments.length == 0  ) 
			return { w : this.m_jelement.width(), h : this.m_jelement.height(), l : parseInt(this.length()) };
		var bw = this.m_celement.attr("blockw");
		var bh = this.m_celement.attr("blockh");
		var bl = this.m_celement.attr("blockl");	
		this.m_jelement.width( arguments[0] ); 
		this.m_jelement.height( arguments[1] );
		this.length( arguments[2]+"px"); 
		return this;
	}, // end csize()
	crectangle : function(){
		var crectangle = new CRectangle();
		var pt = this.cpoint();
		var sz = this.csize();
		crectangle.create( pt.x, pt.y, pt.z, sz.w, sz.h, sz.l );
		return crectangle;
	}, // end crectangle()
}); // end CElementContent
var CElement_Type = CElement;

//---------------------------------------------------------------------------------------
// name: hooks()
// desc: sets up callback methods to be hooked in with the kernal
//---------------------------------------------------------------------------------------
CHook.add("load", CElement.loadCElements );
CHook.add("unload", CElement.unloadCElements );
CHook.add("resize", CElement.resizeCElements );
CHook.add("ready", CElement.readyCElements );
