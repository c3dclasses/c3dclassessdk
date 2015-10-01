//---------------------------------------------------------
// file: ccontrols.js
// desc: defines a control used in the theme
//---------------------------------------------------------

//-----------------------------------------------------------------
// name: CControls
// desc: defines controls used inside a widget
//-----------------------------------------------------------------
var CControls = new Class({
	// constructor
	initialize : function(){
		this.m_cform = null;
		this.m_coptions = null;
	}, // end CControls()
	
	create : function( cform ){
		if( !cform )
			return false;
		this.m_cform = cform;
		this.m_coptions = cform.getCOptions();
		return true;
	}, // end create()
	
	// controls
	label : function( value, strfield, params ){
		if( !params ) params = {};
		params["tag"]="label";
		params["name"] = strfield;
		params["value"] = value;
		params["query"]='[name='+params.name+']';
		return this.init(params);  
	}, // end label()
	
	hidden : function( strfield, value, params ){
		if( !params ) params = {};
		params["name"] = strfield;
		params["value"] = value;
		params["tag"]="input";
		params["type"]="hidden";
		params["query"]='[name='+params.name+']';
		return this.init(params);
	}, // end hidden
	
	text : function( strfield, value, params ){ 
		if( !params ) params = {};
		params["name"] = strfield;
		params["value"] = value;
		params["tag"]="input";
		params["type"]="text";
		params["query"]='[name='+params.name+']';
		return this.init(params);
	}, // end text()
	
	textarea : function( strfield, value, params ){ 
		if( !params ) params = {};
		params["name"] = strfield;
		params["value"] = value;
		params["tag"]="textarea";
		params["query"]='[name='+params.name+']';
		return this.init(params);
	}, // end textarea()
	
	select : function( strfield, index, options, params ){
		if( !params ) 
			params = {};
		params["name"] = strfield;
		params["tag"]="select";
		params["query"]='[name='+params.name+']';
		var cselect = new CSelect();
		if( !cselect ) 
			return null;
		if( cselect.create( params.query ) )
			return cselect;
		cselect = CElement.createCElement( params.tag, CSelect );
		if( !cselect )
			return null;
		cselect.id(strfield);
		alert("creating a new select control");
		return cselect;
	}, // end select()
	
	checkbox : function( strfield, value, params ){ 
		if( !params ) params = {};
		params["name"] = strfield;
		params["value"] = value;
		params["tag"]="input";
		params["type"]="checkbox";
		params["query"]='[name='+params.name+']';
		return this.init(params);
	}, // end checkbox()

	radio : function( strfield, value, params ){ 
		if( !params ) params = {};
		params["name"] = strfield;
		params["value"] = value;
		params["tag"]="input";
		params["type"]="radio";
		params["query"]='[name='+params.name+']';
		return this.init(params);
	}, // end radio()
	
	optiongroup : function( strfield, value, params ){ 
		if( !params ) params = {};
		params["name"] = strfield;
		params["value"] = value;
		params["tag"]="input";
		params["type"]="radio";
		params["bgroup"]=true;
		params["query"]='[name='+params.name+'] option';
		return this.init(params);
	}, // end radiogroup()
	
	radiogroup : function( strfield, value, params ){ 
		if( !params ) params = {};
		params["name"] = strfield;
		params["value"] = value;
		params["tag"]="input";
		params["type"]="radio";
		params["bgroup"]=true;
		params["query"]='[name='+params.name+']';
		return this.init(params);
	}, // end radiogroup()

	checkboxgroup : function( strfield, value, params ){ 
		if( !params ) params = {};
		params["name"] = strfield;
		params["value"] = value;
		params["tag"]="input";
		params["type"]="checkbox";
		params["bgroup"]=true;
		params["query"]='[name='+params.name+']';
		return this.init(params);
	}, // end checkboxgroup()	

	button : function( strfield, strlabel, params ){
		if( !params ) params = {};
		params["name"] = strfield;
		params["value"] = strlabel;
		params["tag"]="input";
		params["type"]="button";
		params["query"]='[name='+params.name+']';
		return this.init(params);
	}, // end button()
	
	submit : function( strfield, strlabel, params ){
		if( !params ) params = {};
		params["name"] = strfield;
		params["value"] = strlabel;
		params["tag"]="input";
		params["type"]="submit";
		params["query"]='[name='+params.name+']';
		return this.init(params);
	}, // end submit()
	
	init : function( params ){
		if( !params )
			return null;
		if( params.bgroup ){
			var cgroup = new CControlGroup();
			cgroup.create( this.m_cform, params );
			return cgroup;
		} // end if
		var celements = this.m_cform.find(params.query);		
		if( celements && celements[0] ) // if the element exist then return it
			return celements[0]; // return the first element
		var celement = new CElement();
		if( celement == null || celement.create( jQuery('<' + params.tag + '/>', params )) == false )
			return null;
		return celement;
	}, // end init()
	
	// classmethods
	ClassMethods : {
	} // end ClassMethods
}); // end CControls

////////////////////////////////////////////

//--------------------------------------------------------
// name: CControl
// desc: defines a control object
//--------------------------------------------------------
var CControl = new Class({
	Extends: CElement,  
	
	initialize:function(){ 
		this.parent(); 
		alert("constructing a CControl Object");
	}, // end initialize()
	
	print : function(){
		alert("In CControl Object");
	}
}); // end CControl

//--------------------------------------------------------
// name: CSelect
// desc: defines a select object
//--------------------------------------------------------
var CSelect = new Class({
	Extends: CElement,  
	
	initialize:function(){ 
		this.parent(); 
	}, // end initialize()
		
	option : function( i ){
		var coptions = null;
		return ( (coptions=this.find('option')) && coptions.length > 0 && coptions[i] ) ? coptions[i] : null;
	}, // end option()
	
	addoption : function(){
		var coption = CElement.createCElement("option");
		if( !coption )
			return null;
		if( arguments.length <= 0 || arguments[0] == arguments.length )
			return this.pushChild( coption );
		else if( arguments[0] == 0 )
			return this.unshiftChild( coption );
		return this.insertChild( arguments[0], coption );	 
	} // end addoption()
}); // end CSelect

//-----------------------------------------------------------
// name: CControlGroup
// desc: defines a control group
//------------------------------------------------------------
var CControlGroup = new Class({
	initialize : function(){ 
		this.m_cform=null;
		this.m_ccontrols=null;
		this.m_query="";
		this.m_iselected=-1;	// the selected 
	}, // end initialize()
	
	create : function(cform, params){
		if( !cform || !params )
			return false;
		this.m_cform = cform;
		this.m_query = params.query;
		if( !this.update() )
			return false;
		return true;
	}, // end create()
	
	length : function(){
		return (this.m_ccontrols) ? this.m_ccontrols.length : 0;
	}, // end getGroup()
	
	get : function(i){
		return ( this.m_ccontrols && this.m_ccontrols[i] ) ? this.m_ccontrols[i] : null;
	}, // end get()
	
	selected : function(){
		if( arguments.length == 0 )
			return this.get( this.m_iselected );
		var selected = this.get( arguments[0] );
		if( selected ){
			this.m_iselected = arguments[0];
			selected.attr("checked","");
		} // end if
	}, // end selected()
	
	selectedIndex : function(){ 
		return this.m_iselected; 
	}, // end selectedIndex
	
	update : function(){
		var ccontrols = this.m_cform.find(this.m_query);		
		if( !ccontrols )
			return false
		this.m_ccontrols = ccontrols;
		for( var i=0; i<this.m_ccontrols.length; i++ )
			if( this.m_ccontrols[i].attr("checked") ){
				alert("got selected");
				this.m_iselected = i;
			} // end if
		return true;
	} // end update()
}); // end CControlGroup