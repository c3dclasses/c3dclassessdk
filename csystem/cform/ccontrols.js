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
		doCRUD:function(cmemory){
			if(!cmemory)
				return;
			jQuery(".ccontrol-crud").click(function(){ 
				var btn = jQuery(this);
				var name = btn.attr("data-name");
				var action = btn.attr("data-action");		
				var ctrl = jQuery("#"+name); 	
				if (!ctrl || !action)
					return null;
				var type = ctrl.attr("type");
				var tag = ctrl.prop("tagName").toLowerCase();
				if(tag == "form")
					return CControls.doFormCRUD(ctrl, cmemory, action);
				if(type == "checkbox")
					return CControls.doCheckboxCRUD(ctrl, cmemory, action);
				else if(type == "radio")
					return CControls.doRadioCRUD(ctrl, cmemory, action);
				else if(type == "text" || tag == "textarea")
					return CControls.doTextCRUD(ctrl, cmemory, action);
				else if(tag == "select")
					return CControls.doSelectCRUD(ctrl, cmemory, action);
				return null;
			}); // end jQuery(".ccontrol-crud").click()
		}, // end doCRUD()
		
		doTextCRUD:function(ctrl, cmemory, action){
			var data = ctrl.val();
			var name = ctrl.attr("id");
			alert("do text crud: " + data);
			var creturn = cmemory[action](name, data, "string");
			if(!creturn)
				return null;
			_if(function(){ return creturn.isdone(); }, function(){ 
				var data = creturn.data();
				if(action == "retrieve"){
					//data = jQuery.parseJSON(data[0].m_jsondata);
					ctrl.val(data.m_value);
				} // end if
				else if(action=="delete"){
					ctrl.val("");
				} // end else if	
				printbr(cmemory._toString());			
			})._endif();
			return creturn;
		}, // end doTextCRUD()
		
		doCheckboxCRUD:function(ctrl, cmemory, action){
			var data = ctrl.prop('checked') ? ctrl.val() : "";	
			var name = ctrl.attr("id");
			var creturn = cmemory[action](name, data, "string");
			if(!creturn)
				return null;
			_if(function(){ return creturn.isdone(); }, function(){ 
				if(action == "retrieve"){
					var data = creturn.data();
				//	data = jQuery.parseJSON(data[0].m_jsondata);
					ctrl.prop("checked", data.m_value!=null);
				} // end if
				else if(action=="delete"){
					ctrl.prop("checked",false);
				} // end elseif
			})._endif();
			return creturn;
		}, // end doCheckboxCRUD()
		
		doRadioCRUD:function(ctrl, cmemory, action){
			var data = "";
			var name = ctrl.attr("id");
			var chkctrl = jQuery('input[name="'+name+'"]');
			chkctrl.each(function(){
				if( $(this).prop("checked") ){
					data = $(this).val();
					ctrl = chkctrl;
				} // end if
			}); // end chkctrl
			var creturn = cmemory[action](name, data, "string");
			if(!creturn)
				return null;
			_if(function(){ return creturn.isdone(); }, function(){ 
				if(action == "retrieve"){
					var data = creturn.data();
					//data = jQuery.parseJSON(data[0].m_jsondata);
					chkctrl.each(function(){
						if($(this).attr("value") == data.m_value)
						   $(this).prop("checked", data.m_value!=null);
					}); // end chkctrl.each()
				} // end if
				else if(action=="delete"){
					ctrl.prop("checked",false);
				} // end elseif
				printbr(cmemory._toString());			
			})._endif();
			return creturn;
		}, // end doCheckboxCRUD()
		
		doSelectCRUD:function(ctrl, cmemory, action){
			var name = ctrl.attr("id");
			var data = ctrl.val();
			var creturn = cmemory[action](name, data, "string");
			if(!creturn)
				return null;
			_if(function(){ return creturn.isdone(); }, function(){ 
				if(action == "retrieve"){
					var data = creturn.data();
					//data = jQuery.parseJSON(data[0].m_jsondata);
					if( data.m_value != "")
						ctrl.find('option[value="' + data.m_value + '"]').prop("selected", "selected");
				} // end if
				else if(action=="delete"){
				} // end elseif
				printbr(cmemory._toString());			
			})._endif();
		}, // end doSelectCRUD()
		
		doFormCRUD:function(ctrl,cmemory,action){
			var name = ctrl.attr("id");
			var ctrls = $("#"+name+" :input");	
			var vars = [];
			ctrls.each(function() {
				var ctrl = $(this);
				var name = ctrl.attr("name");
				var type = ctrl.attr("type");
				var value = "";
				var tag = ctrl.prop("tagName").toLowerCase();
				
				if(type == "button" || type == "submit" || tag == "button") 
					return true;
				
				if(type == "checkbox")	
					value = ctrl.prop('checked') ? ctrl.val() : "";	
				else if(type == "radio"){
					value = ctrl.prop('checked') ? ctrl.val() : "";	
					if( value == "" )
						return true;
				} // end else if
				else value = ctrl.val();
				/*
				if( type == "hidden" ||
					type == "text" ||
					type == "checkbox" ||
					type == "radio" ||
					tag == "textarea" ||
					tag == "select" ) {	
					params.push({ name: name, value: value, type: "string"});
					alert("name: " + name + " value: " + value);
				} // end if
				*/
				alert("name: " + name + " value: " + value);
				vars.push({ name: name, value: value, type: "string"});
				return true;
			}); // end ctrls.each()
			//alert(params.length);
			//return;
			//var params = [{ name:"kevin", value:"hello", type:"string" }];
			var creturn = cmemory.batch(action, vars);
			if(!creturn){
				alert("no creturn");
				return null;
			}
			_if(function(){ return creturn.isdone(); }, function(){ 
				if(action == "retrieve"){
					vars = creturn.data();
					if(!vars)
						return;
					for( var i in vars ){
						if(!vars[i])
							continue;
						var name = vars[i].m_strname;
						var value = vars[i].m_value;
						//var type = vars[i].m_strtype;	
						var _ctrl = ctrl.find("#"+name);
						if(!_ctrl || _ctrl.length == 0)
							continue;
						alert( name );
						var type = _ctrl.attr("type");
						var tag = _ctrl.prop("tagName").toLowerCase();
						if(type == "checkbox")
							_ctrl.prop("checked", value!=null);
						else if(type == "radio")
							if(value != "")
								_ctrl.prop("checked", true);
							else _ctrl.prop("checked", false);
						else _ctrl.val(value);
					} // end for
				} // end if
				else if(action == "delete"){
					alert(action);
					ctrls.each(function(){
						var ctrl = $(this);
						var name = ctrl.attr("name");
						var type = ctrl.attr("type");
						var value = "";
						var tag = ctrl.prop("tagName").toLowerCase();
						if(type == "button" || type == "submit" || tag == "button") 
							return true;
						if(type == "checkbox" || type=="radio")
							ctrl.prop("checked", false);
						else ctrl.val("");
					});
				} // end if
			})._endif(); // end _if()
			
		} // end doFormCRUD()
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