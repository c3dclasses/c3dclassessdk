//---------------------------------------------------------
// file: cform.js
// desc: defines a control used in the theme
//---------------------------------------------------------

//---------------------------------------------------------
// class: CForm
// desc: defines the form object
//---------------------------------------------------------
if( typeof(CForm) !== "undefined" )
CForm.implement({
	initialize : function(){
		this.parent();
		this.m_coptions = null;
		this.m_ccontrols = null;	
		this.m_strbody = "";
		this.m_tag = "form";
		//alert("CForm()");
	}, // end initialize()
	create: function( params ){
		if( this.parent( params ) == false || this.tag().toLowerCase() != "form" )
			return false;	
		this.m_coptions = new COptions();
		this.m_coptions.create( this );
		this.m_ccontrols = new CControls();
		this.m_ccontrols.create( this );
		return true;
	}, // end create()
	getCOptions: function(){
    	return this.m_coptions; 
	}, // end getCOptions()
	getCControls: function(){
	 	return this.m_ccontrols; 	
    }, // end getCControls()
	begin: function(){
		this.m_strbody=""; // get the current body 
		return this.getCControls();
	}, // end begin()
	end: function(){
		this.m_strbody;
	}, // end end()
	body: function(){
	}, // end body()
	load: function(){
		alert( "CForm.load()" );
	}, // end load()
	unload: function(){
		//alert( "CForm.unload()" );
	} // end load()
}); // end CForm.implement()