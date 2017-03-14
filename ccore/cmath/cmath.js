//---------------------------------------------------------------------------------
// file :  cmath.js
// desc :  defines string object similar to javascripts string object     
//---------------------------------------------------------------------------------
//-------------------------------------------
// class CMath
// desc: the math class object
//-------------------------------------------
var CMath = new Class({
ClassMethods:{
	E : 2.718281828459045,
	LN2 : 0.6931471805599453,
	LN10 : 2.302585092994046,
	LOG2E : 1.4426950408889634,
	LOG10E : 0.4342944819032518,
	PI : 3.141592653589793,		
	SQRT1_2 : 0.7071067811865476, 	
	SQRT2 : 1.4142135623730951,
	abs : function(x){ return Math.abs(x); },
	acos : function(x){ return Math.acos(x); },
	asin : function(x){ return Math.asin(x); },
	atan : function(x){ return Math.atan(x); },
	atan2 : function(x){ return Math.atan2(x); },
	ceil : function(x){ return Math.ceil(x); },
	cos : function(x){ return Math.cos(x); },
	exp : function(x){ return Math.exp(x); },
	floor : function(x){ return Math.floor(x); },
	log : function(x){ return Math.log(x); },
	sin : function(x){ return Math.sin(x); },
	sqrt : function(x){ return Math.sqrt(x); },
	tan : function(x){ return Math.tan(x); },
	max : function(){ return Math.max.apply(null, arguments); },
	min : function(){ return Math.min.apply(null, arguments); },
	pow : function(x,y){ return Math.pow(x,y); },
	rand: function(){ return Math.random(); },
	round : function(x){ return Math.round(x); },
	in : function(inum, imin, imax){ return (imin<=inum) && (inum<=imax); }, 
	bound : function(inum, imin, imax){ if(inum<imin) inum=imin; else if(inum>imax) inum=imax; return inum; } 
} // end ClassMethods
}); // end CMath