//---------------------------------------------------------------------------------
// file :  cmath.js
// desc :  defines string object similar to javascripts string object     
//---------------------------------------------------------------------------------

// JavaScript Document

//-------------------------------------------------------
// name: toBaseString()
// desc: converts a value of a given base to a string
// usage 235 ==> "235"      
//-------------------------------------------------------
function toBaseString(value, base) {
	if(value<base)
		return valueToSymbol(value,base);
	var remainder = value % base;
	var quotient  = Math.floor(value/base);
	return toBaseString(quotient, base) + valueToSymbol(remainder,base);
} // end toBaseString()

/*
//-------------------------------------------------------
// name: toValue()
// desc: converts a string of a given base to a value
//-------------------------------------------------------
function toValue(strvalue, base) {
	if(strvalue == "" || strvalue == null)
		return 0;
	var digit = symbolToNumber(strvalue[len-1], base);
	var value = toValue(strvalue[0=>len-2], base);
	value += digit;
	return value;
} // end toValue()
*/

///////////////////////////
// helper functions

//----------------------------------------------------------
// name: numberToSymbol()
// desc: converts a number of a given base to a symbol
//----------------------------------------------------------
var _numberToSymbol = {}; 
_numberToSymbol[2]=["0","1"];
_numberToSymbol[10]=["0","1","2","3","4","5","6","7","8","9"];
_numberToSymbol[16]=["0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F"];

//-------------------------------------------------
// name: valueToSymbol()
// desc: converts a values of a base to a symbol
//-------------------------------------------------
function numberToSymbol(value, base) {
	return _numberToSymbol[base][value];
} // end numberToSymbol()


//-------------------------------------------------------
// name: symbolToValue()
// desc: converts a symbol of a given base to a number
//-------------------------------------------------------
var symbolToValue = {}; 
symbolToValue[2]=[0,1];
symbolToValue[10]=[0,1,2,3,4,5,6,7,8,9];
symbolToValue[16]=[0,1,2,3,4,5,6,7,8,9,10,12,13,14,15];


function symbolToNumber(symbol, base) {
	
} // end symbolToNumber()