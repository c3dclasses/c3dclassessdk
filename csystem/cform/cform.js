//---------------------------------------------------------
// file: cform.js
// desc: defines the form used in the application
//---------------------------------------------------------

//---------------------------------------------------------
// class: CForm
// desc: defines the form used in the application
//---------------------------------------------------------
var CForm = new Class({ 
	// constructing
	initialize : function(COptionsType, CControlsType){
		COptionsType = COptionsType || "COptions";
		CControlsType = CControlsType || "CControls";
		// members
		this.m_coptions = new window[COptionsType]();
		this.m_ccontrols = new window[CControlsType]();	
		this.m_params = null;
		this.m_strname = "";
		this.m_cmemoryid = "";
	}, // end initialize()
	
	create : function(strname, params) {
		this.m_ccontrols.create(this);
		this.m_coptions.create(this);
		this.m_params = params;
		this.m_strname = strname;
		return true;
	}, // end create()
	
	use_memory : function (strcmemoryid){
		this.m_cmemoryid = strcmemoryid;
	}, // end use_memory()
	
	getCMemoryID : function () {
		return this.m_cmemoryid;
	}, // end getCMemoryID()
	
	setName : function(strname) {
		this.m_strname = strname;
	}, // end setName()
	
	getName : function() { 
		return this.m_strname;
	}, // end getName()
	
	getParams : function() { 
		return this.m_params; 
	}, // end getParams()

	getNameWithSuffix : function(strsuffix, strdelimiter) {
		var fieldname = strsuffix;
		strdelimiter = strdelimiter || "_";
		if(this.m_strname && CForm_isFieldNameBounded())
			fieldname = this.m_strname + strdelimiter + strsuffix;
		return fieldname;
	}, // end getNameWithSuffix()
	
	getCOptions : function() { 
		return this.m_coptions; 
	}, // end getCOtions()
	
	getCControls : function() { 
		return this.m_ccontrols; 
	}, // end getCControls()
	
	getCForm : function(strname, params, CFormType, COptionsType, CControlsType) {	
		if (!strname || strname=="")
			return NULL;		
		CFormType = CFormType | "COptions";
		COptionsType = COptionsType | "COptions";
		CControlsType = CControlsType | "CControls";
		var cform = new CFormType(COptionsType,CControlsType);
		strname = this.getNameWithSuffix(strname);		
		cform.create(strname, params);
		return cform;
	}, // end getCForm()	
}); // end CForm