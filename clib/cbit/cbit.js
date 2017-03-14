//-----------------------------------------------------------------------------------------
// file: cbit.js
// desc: defines bit constants 
//-----------------------------------------------------------------------------------------

//----------------------------------------------------------------
// file: CBit
// desc: defines bit constants 
//----------------------------------------------------------------
var CBit = new Class ({	
ClassMethods: {
	BIT 	: null,
	BITNONE : 0x00000000, 
	BITALL 	: 0xFFFFFFFF, 
	init : function() {
		CBit.BIT = new Array(32);
		CBit.BIT[0] = CBit.BITNONE;
		for(var i=0; i<32; i++)
			CBit.BIT[i+1] = (1<<i);
		return true;
	} // end init()	
}// end ClassMethods
}); // end CBit

// initialize the bits
CBit.init();
