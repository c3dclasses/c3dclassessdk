//-----------------------------------------------------------------------------------------
// file: cbitarray.js
// desc: defines an object that access a interger bits as an array and sets them on/off
//-----------------------------------------------------------------------------------------

//----------------------------------------------------------------
// fclass CBitArray
// desc: defines an object that defines bit flag 
//----------------------------------------------------------------
var CBitArray = new Class ({	
	ClassMethods : {	
		SIZEOFINT: 32,	
		BITTOINT: 0.03125,
		ALLBITS: 0xFFFFFF
	}, // end ClassMethods
	initialize : function() { 
		this.m_arribits = null;
		this.m_inumofbits = 0;
		this.m_inumofbitsset = 0;
	}, // end CBitArray
	create : function(inumofbits) {
		var ibitarrays  = null;
		var inumbitarrays = 0;
		if (inumofbits < 1) 
			return false;
		try{
			inumbitarrays = Math.ceil(Number(inumofbits) / Number(CBitArray.SIZEOFINT)); 
			ibitarrays = new Array(inumbitarrays); 
			for (var i=0; i<ibitarrays.length; i++)
				ibitarrays[i]=0;
		} // end try
		catch(e) {
			ibitarrays = null;
			return false;
		} // end catch
		this.m_arribits = ibitarrays;
		this.m_inumofbits = inumofbits;	
		this.m_inumofbitsset = 0;	
		return true;	
	}, // end create()
	createFromString : function(strcbitarray, bhex) {
		if (strcbitarray==null || strcbitarray == "") 
			return false;
		var inumtokens 		= 0;
		var inumbits 		= 0;
		var inumbitsset 	= 0;
		var inumbitarrays	= 0;
		var arribitarrays  	= null;
		var i 				= 0;
		var arrtokens 		= strcbitarray.split(" ");
		if (arrtokens.length < 3) 
			return false;
		inumbits = parseInt(arrtokens[i++]);
		if (inumbits < 1) 
			return false;
		inumbitarrays = Math.ceil(Number(inumbits) / Number(CBitArray.SIZEOFINT)); 
		if (arrtokens.length < inumbitarrays) 
			return false;
		inumbitsset = parseInt(arrtokens[i++]);
		arribitarrays = new Array (inumbitarrays);
		for (var j=0; j<inumbitarrays; j++) {
			if (bhex == undefined || bhex == false) arribitarrays[j] = parseInt(arrtokens[i++]);
			else arribitarrays[j] = parseInt(arrtokens[i++], 16);
		} // end for
		this.m_arribits = arribitarrays;
		this.m_inumofbits = inumbits;
		this.m_inumofbitsset = inumbitsset;	
		return true;
	}, // end create()	
	isEmpty : function() { return this.m_inumofbitsset <= 0; },
	isFull : function() { return this.m_inumofbitsset >= this.m_inumofbits; },
	getBitArrays : function() { return this.m_arribits; }, 
	getNumOfBits : function() { return this.m_inumofbits; },
	getNumOfBitsSet : function() { return this.m_inumofbitsset; },
	getAllSetBitIndices : function() {
		if (this.m_inumofbits == 0 || this.m_arribits == null) 
			return null;		
		var inumsetbits = 0;
		for (var i=0; i<this.m_inumofbits; i++)
			if (this.isBitSet(i)) 
				inumsetbits++;		
		if (inumsetbits == 0)
			return null;		
		var indices = new Array(inumsetbits);
		i = 0;
		for (var j=0; i<this.m_inumofbits; i++)
			if (this.isBitSet(i)) 
				indices[j++] = i;				
		return indices;
	}, // end getAllSetBitIndices()
	setBit : function(ibit) {
		// compute the bitflag
		var ibitflag = this.computeBitArray(ibit);
		if (ibitflag == -1) 
			return false;
		ibit = ibit % CBitArray.SIZEOFINT;		
        this.m_arribits[ ibitflag ] = (this.m_arribits[ ibitflag ]|(1<<ibit)); 		
		this.m_inumofbitsset++;
		return true; 						 
	}, // end setBit()
	setAllBits : function() {
		if (this.m_arribits == null) 
			return false;
		for (var i=0; i<this.m_arribits.length; i++)
			this.m_arribits[i] = CBitArray.ALLBITS;
		this.m_inumofbitsset = this.m_inumofbits;
		return true;
	}, // end setAllBits()	
	clearBit : function(ibit) {
		var ibitflag = this.computeBitArray(ibit);
		if (ibitflag == -1) 
			return false;
		ibit = ibit % CBitArray.SIZEOFINT;		
		this.m_arribits[ ibitflag ] &= (~(1<<ibit)); 
		this.m_inumofbitsset--;
		return true;		
	}, // end clearBit()
	clearAllBits : function() {
		if (this.m_arribits == null) 
			return false;		
		for (var i=0; i<this.m_arribits.length; i++)
			this.m_arribits[i] = 0;
		this.m_inumofbitsset=0;
		return true;
	}, // end clearAllBits();
	enableBit : function(ibit, benable) { return (benable) ? this.setBit(ibit) : this.clearBit(ibit); },
	isBitSet : function(ibit) {		
		var ibitflag = this.computeBitArray(ibit);	
		if (ibitflag == -1)
			return false;
		ibit = ibit % CBitArray.SIZEOFINT;		
		if ((this.m_arribits[ibitflag] & (1<<ibit)) > 0)
			return true;
		return false;
	}, // end isBitSet()
	toBinaryString : function() {
		var str="";
		for (var ibit=this.m_inumofbits; ibit>-1; ibit--) 	
			str += ((this.isBitSet(ibit)) ? "1" : "0");		
		return str;
	}, // toBinaryString()
	toHexString : function() { return this._toString(true); },
	toDecimalString : function() { return this._toString(false); },
	_toString : function(bhex) {
		var str = "" + this.m_inumofbits + " " + this.m_inumofbitsset + " ";
		if (this.m_arribits) 
			for (var i=0; i<this.m_arribits.length; i++) 
			{
				if (bhex == undefined || bhex == false) str += this.m_arribits[i];
				else str += this.m_arribits[i].toString(16);
				str += " ";
			} // end for
		return str;
	}, // toString()
	computeBitArray : function(ibit) { 
		return (this.m_arribits == null || ibit < 0 || ibit >= this.m_inumofbits) ? -1 : Math.floor(ibit * CBitArray.BITTOINT); 
	} // end computeBitArray()
}); // end CBitArray