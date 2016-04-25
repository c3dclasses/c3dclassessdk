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
		getMicroseconds : function() { return microtime(true); },
		getMilliseconds : function() { var d = new Date(); return d.getTime(); },
		getSeconds : function() { return (CTimer.getMilliseconds() / 1000); }
	} // end ClassMethods
}); // end CTime