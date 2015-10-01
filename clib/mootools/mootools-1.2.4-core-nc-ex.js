//-----------------------------------------------------------
// name: Class.Mutators.ClassMethods()
// desc: mutators belong to a class and not thier instances
//       and they are called only when we define a new Class
//-----------------------------------------------------------
Class.Mutators.ClassMethods = function( methods ){
	this.__classMethods = $extend(this.__classMethods || {}, methods);
	this.extend(methods);
}; // end Class.Mutators.ClassMethods

//-------------------------------------------------------------------
// name: String.implement
// desc: implements and extends a string object
//-------------------------------------------------------------------
String.implement
({ 
	// members
	m_strbuffer : [],
	
	//-----------------------------------------------------------------------------
	// name: append()
	// desc: creates an append method to make string manipulation more efficient
	//-----------------------------------------------------------------------------
	append : function( str ){ 
		if( this.m_strbuffer ) 
			this.m_strbuffer.push( str );
		return this; 
	}, // end append()

/*	
	//-----------------------------------------------------------------------------
	// name: begin()
	// desc: empties the buffer and makes it ready for appending
	//-----------------------------------------------------------------------------
	begin : function(){ 
		this.m_strbuffer = []; 
	}, // end begin()
*/	
	//-----------------------------------------------------------------------------
	// name: end()
	// desc: appends the contents in the array to the string
	//-----------------------------------------------------------------------------
	end : function(){ 
		var out = this.m_strbuffer;
		this.m_strbuffer = [];
		if( out ) 
			return this + out.join();
	} // end end()
}); // end String.implement