//-----------------------------------------------------------------------------------------------
// file: cconstructs.js
// desc: defines constructs to use to simulate feature found in multithread programming lang 
//-----------------------------------------------------------------------------------------------

//----------------------------------------------------
// class: CLoop
// desc: loop object for 
//----------------------------------------------------
var CLoop = new Class({	
	Extends: CThread,
	_sleep:function(iintervalms ){ return this.schedule(iintervalms ); },
	_break:function(){ this._return(); },
	_return:function(str){ this.destroy(); },
	_jump:function(funcbody ){ this.jump(); },
	_continue:function(){} // end _continue	
}); // end CLoop

//----------------------------------------------------
// class: CIf
// desc: if statement object 
//----------------------------------------------------
var CIf = new Class({	
	initialize : function(fncond, fnbody ){ this.m_ifs = []; },
	add : function(fncond, fnbody ){	
		if(!fnbody ) 
			return this;		
		if(typeof(fnbody) == "object" && fnbody.constructor == "CReturn") {
			fnbody.callback = fnbody;
			return this;
		} // end if
		this.m_ifs.push({ m_fncond:fncond, m_fnbody:fnbody } );
		return this;
	}, // end add()
	create : function(fncond, fnbody ){ this.add(fncond, fnbody ); return true; },
	_elseif : function(fncond, fnbody ){ return this.add(fncond, fnbody ); },
	_else : function(fnbody ){	return this.add(null, fnbody ); },
	_endif : function(){
		var _ifs = this.m_ifs;
		var _return = _while(function(){
			var _if = null;
			for(var i=0; i<_ifs.length; i++ ){
				_if = _ifs[i];
				if(_if.m_fncond && 
					_if.m_fncond.bind(this)() && // check if the condition
					_if.m_fnbody ){
					_if.m_fnbody.bind(this)(); // run the body
					this._return();
					break;	 
				} // end if()
				else if(!_if.m_fncond && _if.m_fnbody ){ // else
					_if.m_fnbody.bind(this)();
					break;
				} // end else if()
			} // end for()
		} ); // end async while()
		return _return;
	} // end _endif()
}); // end CIf

//----------------------------------------------------
// file: CDoWhile
// desc: defines a do/while statement 
//----------------------------------------------------
var CDoWhile = new Class({	
	initialize : function(){ 
		this.m_fncond=null; 
		this.m_fnbody=null; 
	}, // end initialize()
	create : function(fnbody ){ 
		return (this.m_fnbody = fnbody ) ? true : false; 
	}, // end create()
	_while : function(iintervalms, fncond ){
		if(iintervalms == null )
			iintervalms = 1;	
		else if(typeof(iintervalms ) == "function" ){
			fncond = iintervalms;
			iintervalms = 1;
		} // end if
		_dowhile = this;		
		var _return = _while(iintervalms, function(){
			// do the function 
			if(_dowhile.m_fnbody )
				_dowhile.m_fnbody.bind(this)();
			// check the condition
			if(!fncond || fncond.bind(this)() == false ){
				this._break();
				return;
			} // end if
		}); // end _while()
		return _return;
	} // end _while()
}); // end CDoWhile()

//---------------------------------------------------
// name: CSwitch
// desc: defines a switch construct
//---------------------------------------------------
var CSwitch = new Class({	
	initialize : function(){ 
		this.m_fnValue = null;	// the function to containing the value to compare case values to  
		this.m_if = null;
	}, // end CSwitch()
	
	create : function(fnvalue ) { 
		if(!fnvalue)
			return false;
		var _if = new CIf();
		this.m_if = _if;
		this.m_fnValue = fnvalue;
		return true; 
	}, // end create()
	
	_case : function(value, fnbody ) {	
		if(!fnbody ) 
			return this;
		var _this = this;		
		this.m_if.add(function(){ return _this.m_fnValue() == value }, fnbody);
		return this;
	}, // end _case()
	
	_default : function(fnbody) {
		this.m_if._else(fnbody);
		return this;
	}, // end _default()

	_endswitch : function(){
		this.m_if._endif();
	} // end _endswitch()
}); // end CSwitch

//--------------------------------------------------------------------------------
// name: CReturn
// desc: defines a return contruct or statement for asynchonous methods
// 		 its used in cdatastream objects that use ajax operations
//--------------------------------------------------------------------------------
var CReturn = new Class({
	initialize : function(){ 
		this.m_data = null;
		this.m_fnformat = null;
		this.m_strerror = "";
		this.m_icode = CReturn.NULL;
		this.m_strstatus = "";
		this.listener("_done");
		this.listener("_error");
		this.listener("_busy");
	}, // end CReturn()

	error : function(){
		if(arguments.length == 1  )
			this.m_strerror = arguments[0];
 		return this.m_strerror; 
	}, // end error()

	code : function(){ 
		if(arguments.length == 1  )
			this.m_icode = arguments[0];
 		return this.m_icode; 
	}, // end status();

	status : function(){ 
		if(arguments.length == 1  )
			this.m_strstatus = arguments[0];
 		return this.m_strstatus; 
	}, // end status();

	data : function(data ){
		if(arguments.length == 1  )
			this.m_data = arguments[0];	
		return (this.m_fnformat) ? this.m_fnformat(this.m_data) : this.m_data; 
	}, // end data()
	
	results : function(index ) {
		return jQuery.parseJSON(this.data());
	}, // end results

	formatfn : function(fn){
		this.m_fnformat=fn;
	}, // end format() 

	isdone : function(){ 
		return this.m_icode==CReturn.DONE;
	}, // end isdone()

	isbusy : function(){
		return this.m_icode==CReturn.BUSY;
	}, // end isbusy()

	isnull : function(){
		return this.m_icode==CReturn.NULL;
	}, // end isnull()

	iserror : function(){
		return this.m_icode==CReturn.ERROR;
	}, // end isnull()

	_return : function(code, data) {
		this.code(code);
		this.data(data);
		return this;
	}, // end _return()

	done : function(data) {
		return this._return(CReturn.DONE, data);
	}, // end _done()

	busy : function() {
		return this._return(CReturn.BUSY, null);
	}, // end _busy()
	
	listener : function(strevent){
		if(!strevent)
			return;
		this[strevent]=[];
		this[strevent]=function(fncallback){
			if(!fncallback)
				return;
			this[strevent].push(fncallback);
		} // end function()
	}, // end listener()

	doListener : function(strevent, params){
		if(!strevent || !this[strevent])
			return;
		for(var i=0; i<this[strevent].length; i++) {
			var fncallback = this[strevent];
			fncallback(params);
		} // end for()
		return;
	}, // doListener()	

	ClassMethods:{
		NULL: 0,	// the function/method is not called yet
		BUSY: 1,	// the function/method has been called and it's busy
		DONE: 2, 	// the function/method has been called and it's done	
		ERROR: 3	// the function/method has been called and it has an error
	} // end ClassMethods
}); // end CReturn()

//----------------------------------------------
// name: _return_done()
// desc: returns a completed asynchronous task
//----------------------------------------------
function _return(code, data) {
	var _return = new CReturn();
	if(!_return)
		return null;
	_return.code(code);
	_return.data(data);
	return _return;
} // end _return()

function _return_done(data) {
	return _return(CReturn.DONE, data);
} // end _return_done()

function _return_busy() {
	return _return(CReturn.BUSY, null);
} // end _return_busy()

//////////////////////////////
// other constructs

//----------------------------------------------------------------
// name: _while()
// desc: implements a asynchronous while loop control structure
//----------------------------------------------------------------
function _while(iintervalms, funcbody ){
	if(iintervalms == null ) 
		iintervalms = 1;
	else if(typeof(iintervalms) == "function" ){
		funcbody = iintervalms;
		iintervalms = 1;
	} // end else if
	var cloop = new CLoop();
	if(!cloop )
		return null;
	funcbody = funcbody.bind(cloop);
	var fnbody = function() {
		try {
			funcbody();
		} // end try
		catch(e) {
			this._return();
			throw e; 	
		} // end catch(e)
	}; // end fnbody()
	if(cloop.create(iintervalms, fnbody ) == false ) 
		return null;
	return cloop.start();
	//return cloop; 	 
} // end _while()

//----------------------------------------------------------------
// name: _for()
// desc: implements a asynchronous for loop control structure
//----------------------------------------------------------------
function _for(iintervalms, funcbody ){ 
	return _while(iintervalms, funcbody ); 
} // end _for

//---------------------------------------------------------------
// name: _if()
// desc: sets up an async if structure
//---------------------------------------------------------------
function _if(fncond, fnbody ){
	var __if = new CIf();
	if(!__if )
		return null;
	if(__if.create(fncond, fnbody ) == false )
		return null;	
	return __if;
} // end _if()

//---------------------------------------------------------------
// name: _do()
// desc: sets up an async do/while structure
//---------------------------------------------------------------
function _do(fnbody ){
	var __dowhile = new CDoWhile();	
	if(!__dowhile )
		return null;
	if(__dowhile.create(fnbody ) == false )
		return null;
	return __dowhile;	
} // end _do()

//--------------------------------------------------
// name: _switch()
// desc: sets up an asynchronous switch construct
//--------------------------------------------------
function _switch(fnValue){
	var __switch = new CSwitch();
	if(!__switch)
		return null;
	if(__switch.create(fnValue)==false)
		return null;
	return __switch;
} // end _switch()