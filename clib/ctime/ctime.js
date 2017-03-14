//----------------------------------------------
// name: ctime.js
// desc: time object
//----------------------------------------------

//----------------------------------------------
// name: CTime
// desc: time object
//----------------------------------------------
var CTime = new Class({
	ClassMethods : { 
		us : function() { return CTime.ms() * 1000; },
		ms : function() { return (new Date().getTime()) },
		s : function() { return (CTime.ms() * 0.001); }
	} // end ClassMethods
}); // end CTime