//---------------------------------------------------------
// file: coptions.js
// desc: defines the options of a form
//---------------------------------------------------------

//-----------------------------------------------------------------
// name: COptions
// desc: defines the options of a form
//-----------------------------------------------------------------
var COptions = new Class({
 	initialize : function(){
		this.m_cform = null;
		this.m_instance = null;
		this.m_strmemid = "";
	}, // end CControls()
	
	create : function( cform ){
		if( !cform )
			return false;
		this.m_cform = cform;
		this.m_instance = {};
		return true;
	}, // end create()
	
	// option() / optionExists() / removeOption() 
	option : function( strfield ){
		var celements = this.m_cform.find('[name='+strfield+']');		
		if( !celements || celements.length < 1 )
			return "";
		if( celements[0].attr('type') !== undefined && 
			( celements[0].attr('type').toLowerCase() == "radio" ||
			celements[0].attr('type').toLowerCase() == "checkbox" ) ){	
			for( var i=0; i<celements.length; i++ ){
				if( arguments.length == 2 ) // setting the button
					if( arguments[1] == celements[i].attr('value') ){
						celements[i].attr("checked", "checked");
						return;
					} // end if		
				if( arguments.length == 1 ){ // getting the value of the button
					alert( celements[i].attr('value') );
					if( celements[i].jq().attr("checked") !== undefined ){
						alert("checked: " + celements[i].attr('value'));
						return celements[i].attr('value');
					} // end if
				} // end if
			} // end for
		} // end if
		else {
			if( arguments.length == 2 ){ // setting the button
				celements[0].attr('value',arguments[1]);
				return;
			} // end if
			else return celements[0].attr('value');
		} // end else
	}, // end option()
	
	optionExists : function( strfield ){
		return this.option( strfield ) != "";  
	}, // end optionExists()
	
	removeOption : function( strfield ){
		this.option(strfield,"");
	}, // removeOption()
}); // end COption