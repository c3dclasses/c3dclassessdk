//-------------------------------------------------------------------
// file: cparse.js
// desc: contains parsing methods
//-------------------------------------------------------------------

//-------------------------------------------------------------------
// file: CParse
// desc: contains parsing methods
//-------------------------------------------------------------------
var CParse = new Class({	
	ClassMethods : {
	toInt : function(value) { 
		return parseInt(value); 
	}, // end toInt()

	toFloat : function(value) { 
		return parseFloat(value);
	}, // end toFloat()

	toString : function(value) {
		var type = typeof(value)
		if(type == "boolean") 
			return (value) ? "true" : "false";
		return "" + value;
	}, // end toString()
	
	toJSONString : function(value) {
		return  JSON.stringify(value);
	}, // end toJSON()
	
	toJSONObject : function(value) {
		return JSON.parse(value);
	} // end toJSONObject()
	} // end ClassMethods
}); // end CParse