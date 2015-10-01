//------------------------------------------------------
// file: ckeyboard.js
// desc: defines a generic keyboard class
//------------------------------------------------------

//------------------------------------------------------
// name: CKeyboard
// desc: defines a generic keyboard class
//------------------------------------------------------
var CKeyboard = new Class({
	// members
	Extends : CDeviceInput,	// inherits the CInput
	
 	//--------------------------------
	// name: initialize()
 	// desc: contructor
	//--------------------------------
	initialize : function(){
		this.parent();
	}, // end initialize()
	
	//-------------------------------------------------------
	// name: create()
	// desc: create the keyboard object
	//-------------------------------------------------------
	create : function( celement, strselector ){ 
		if( this.parent( celement ) == false ){
			//CLog.error("CKeyboard.create() - this.parent( celement ) == false");
			return false;
		} // end if
		
		this.m_celement.event( 'keydown', strselector, CKeyboard.onKeyPress.bind(this) );
		this.m_celement.event( 'keypress', strselector, CKeyboard.onKeyDown.bind(this) );
		this.m_celement.event( 'keyup', strselector, CKeyboard.onKeyUp.bind(this) );
		
		//CLog.error("CKeyboard.create() - this.parent( celement ) == false");
		return true; 
	}, // end create()
	
	/////////////////////////////////
	// mouse input state

	//-------------------------------------------------------------------------------
	// name: getVKCode()
	// desc: returns the virtual key code that was registerd from the current event
	//--------------------------------------------------------------------------------
	getVKCode : function(){ 
		return ( this.m_event ) ? this.m_event.m_vkcode : -1; 
	}, // end getVKCode()
	
	//-------------------------------------------------------------------------------
	// name: getchar()
	// desc: returns the character that was pressed
	//--------------------------------------------------------------------------------
	getChar : function(){ 
		return ( this.m_event ) ? String.fromCharCode(this.m_event.m_vkcode) : "";
	}, // end getVKCode()
	
	//------------------------------------------------------
	// name: isKeyPressed()
	// desc: checks if a given key is down
	//------------------------------------------------------
	isKeyPressed : function( vkcode ){ 
		if( !this.m_event )
			return false;
		if( vkcode != undefined && vkcode != this.m_event.vkcode )
			return false; 	
		return this.getInputState( 0 );
	}, // isKeyPressed()
	
	//------------------------------------------------------
	// name: isKeyUp()
	// desc: checks if a given key is up
	//------------------------------------------------------
	isKeyUp : function( vkcode ){ 
		if( !this.m_event )
			return false;
		if( vkcode != undefined && vkcode != this.m_event.vkcode )
			return false; 	
		return this.getInputState( 1 );
	}, // isKeyDown()
	
	//------------------------------------------------------
	// name: isKeyDown()
	// desc: checks if a given key is down
	//------------------------------------------------------
	isKeyDown : function( vkcode ){ 
		if( !this.m_event )
			return false;
		if( vkcode != undefined && vkcode != this.m_event.vkcode )
			return false; 	
		return this.getInputState( 2 );
	}, // isKeyDown()
	
	//------------------------------------------------------
	// name: isShiftKeyDown()
	// desc: returns true if the shift key is down
	//------------------------------------------------------
	isShiftKeyDown : function(){
		return ( !this.m_event ) ? false : this.m_event.shiftKey;
	}, // end isShiftKeyDown()
	
	//------------------------------------------------------
	// name: isShiftKeyDown()
	// desc: returns true if the shift key is down
	//------------------------------------------------------
	isCtrlKeyDown : function(){
		return ( !this.m_event ) ? false : this.m_event.ctrlKey;
	}, // end isShiftKeyDown()
	
	///////////////////////////////////////
	// helper methods
	
	//-----------------------------------------------------
	// name: getEventProperties()
	// desc: retrieves the event properties for a object
	//-----------------------------------------------------
	update : function( event, ibit ){
		// check if the parent updated
		if( this.parent( event, ibit ) == false ){
			//CLog.error("CKeyboard.update() - this.parent( event, ibit ) == false" );
			return false;
		} // end if
		
		// update event object
		var evt = this.m_event;
		if(evt.keyCode) 
			evt.vkcode = evt.keyCode;
		else if( evt.charCode ) 
			evt.vkcode = evt.charCode;
		else if(evt.which) 
			evt.vkcode = evt.which;	
		
		//CLog.success("CKeyboard.update()" );
		return this;
	}, // end getEventProperties()
	
	///////////////////////////////////////
	// static methods
	ClassMethods:{
	//-------------------------------------------------------
	// name: onKeyPress
	// desc: handlers and listeners for keyboard events 
	//-------------------------------------------------------
	onKeyPress: function( event ){
		this.update( event, 0 );
	}, // end onKeyPress()
	
	//-------------------------------------------------------
	// name: onKeyUp
	// desc: handlers and listeners for keyboard events 
	//-------------------------------------------------------
	onKeyUp: function( event ){
		this.update( event, 1 );
	}, // end onKeyUp()
	
	//-------------------------------------------------------
	// name: onKeyDown
	// desc: handlers and listeners for keyboard events 
	//-------------------------------------------------------
	onKeyDown: function( event ){
		 this.update( event, 2 );
	} // end onKeyDown()	
	} // end ClassMethods
}); // end CKeyboard
