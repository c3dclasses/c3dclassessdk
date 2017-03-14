//---------------------------------------------------------------------------------
// file: cstring.js
// desc: defines string object similar to javascripts string object     
//---------------------------------------------------------------------------------
String.prototype._ = function(){ return this; }
String.prototype.replaceMatch = function( matches, strreplace ){ return _replaceMatch( matches, strreplace, this ); }
function _replaceMatch( matches, strreplace, strcontents ){
	if( matches == null || strcontents == "" || strcontents == null )
		return "";
	if( getTypeOf(matches) == "string" ){
		strcontents = strcontents.replace(matches, strreplace);
	} // end if
	else if( getTypeOf(matches) == "object" ){
		for( var i=0; i<matches.length; i++ ){
			var patt=new RegExp(matches[i],"g");
			strcontents = strcontents.replace(patt, strreplace);	
		} // end for
	} // end else
	return strcontents;
} // end replaceMatch()