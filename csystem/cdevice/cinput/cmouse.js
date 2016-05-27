//------------------------------------------------------
// file: cmouse.js
// desc: defines a generic mouse class
//------------------------------------------------------

//------------------------------------------------------
// name: CMouse
// desc: defines a generic mouse class
//------------------------------------------------------
var CMouse = new Class({
    Extends: CDeviceInput, // inherits the CInput

    //---------------------------------------------
    // name: initialize()
    // desc: contructor
    //---------------------------------------------
    initialize: function(){
        this.parent();
        this.m_bcapture = false;
        this.m_capturepos = null;
        this.m_bshowcontextmenu = true;
    }, // end initialize()
	
	//---------------------------------------------------
	// name: showContextMenu()
	// desc: show/hide the context menu
	//---------------------------------------------------
	showContextMenu : function( bshow ){
		this.m_bshowcontextmenu = bshow;
	}, // end showContextMenu()

    //-------------------------------------------------------
    // name: create()
    // desc: creates the mouse object and return true
    //-------------------------------------------------------
    create: function (celement) {
        if (this.parent(celement) == false) {
            return false;
        } // end if

        // register the keyboard event functions of this element
        this.m_celement.event('mousedown', CMouse.onMouseDown.bind(this));
        this.m_celement.event('mousemove', CMouse.onMouseMove.bind(this));
        this.m_celement.event('mouseout', CMouse.onMouseOut.bind(this));
        this.m_celement.event('mouseover', CMouse.onMouseOver.bind(this));
        this.m_celement.event('mouseup', CMouse.onMouseUp.bind(this));
		this.m_celement.event('contextmenu', CMouse.onContextMenu.bind(this));
		//document.body.oncontextmenu = CMouse.onContextMenu.bind(this);
		//this.m_celement.event('dragend', CMouse.onDragEnd.bind(this));
	
        return true;
    }, // end create()

    //---------------------------------------------------------
    // name: getPos()
    // desc: returns the coordinates {x,y} of the mouse
    //---------------------------------------------------------
    getPos: function(){
        return (this.m_event==null)?{x:0,y:0}:{x:this.m_event.x,y:this.m_event.y};
    }, // end getPos()

	//---------------------------------------------------------
    // name: getPos()
    // desc: returns the coordinates {x,y} of the mouse
    //---------------------------------------------------------
    getViewPortPos : function(){
		var pos = this.getPos();
		pos.x = pos.x + (document.body.scrollLeft);
		pos.y = pos.y + (document.body.scrollTop);
		return pos;
    }, // end getViewPortPos()

    //---------------------------------------------------------------------------------
    // name: getCapturePos()
    // desc: returns the mouse coordinates relative to where the mouse was captured
    //---------------------------------------------------------------------------------
    getCapturePos: function(){
        return this.m_capturepos;
    }, // end getCapturePos()

    //---------------------------------------------------------------------------------------
    // name: getCapturePos()
    // desc: returns the change between the current mouse position and the capture position
    //---------------------------------------------------------------------------------------
    getDeltaPos: function(){
        return (this.m_capturepos == null) ? null : { x: (this.m_event.x - this.m_capturepos.x), y: (this.m_event.y - this.m_capturepos.y) };
    }, // end getDeltaPos()
	
	//-----------------------------------------------------------------------------------------------------
	// name: getOffsetPos()
	// desc: returns the offset or difference between the capture position and the passed in position 
	//-----------------------------------------------------------------------------------------------------
	getOffsetPos: function( pos ){
        return (this.m_capturepos == null || pos == null) ? null : { x: (pos.x - this.m_capturepos.x), y: (pos.y - this.m_capturepos.y) };
        //return (this.m_capturepos == null || pos == null) ? null : { x: 0, y: 0 };
    }, // end getOffsetPos()
	
    //---------------------------------------------------------
    // name: getButton()
    // desc: returns the button that was pressed
    //---------------------------------------------------------
    getButton: function(){
		return ( this.m_event ) ? this.m_event.which : -1;	
	}, // end getButton()	

    //---------------------------------------------------------
    // name: isMouseDown()
    // desc: returns true if the mouse is down false otherwise
    //---------------------------------------------------------
    isButtonDown : function(ibutton){
		if( !this.m_event )
			return false;
		if( ibutton != undefined && ibutton != this.m_event.which )
			return false; 		
		return this.getInputState(4);
    }, // end onMouseDown()

    //----------------------------------------------------------
    // name: isMouseUp()
    // desc: returns true if the mouse is up, false otherwise
    //----------------------------------------------------------
    isButtonUp: function(ibutton){	
		if( !this.m_event )
			return false;
		if( ibutton != undefined && ibutton != this.m_event.which )
			return false; 
        return this.getInputState(5);
    }, // end isMouseUp()

    //------------------------------------------------------------
    // name: isMouseMove()
    // desc: returns true if the mouse is moving, false otherwise
    //------------------------------------------------------------
    isMoving: function(){
        return this.getInputState(6);
    }, // end isMouseMove()

    //----------------------------------------------------------
    // name: isMouseOut()
    // desc: returns true if the mouse is out, false otherwise
    //----------------------------------------------------------
    isOut: function(){
        return this.getInputState(7);
    }, // end isMouseOut()

    //------------------------------------------------------
    // name: isMouseOver()
    // desc: handler to call if a mouse is used
    //------------------------------------------------------
    isOver: function(){
        return this.getInputState(8);
    }, // end isMouseOver()

    //--------------------------------------------------------
    // name: isCapture()
    // desc: checks for a capture event
    //--------------------------------------------------------
    isCapture: function(){
        return this.m_bcapture;
    }, // end isCapture()

    //------------------------------------------------------
    // name: clear()
    // desc: clears the current input state
    //------------------------------------------------------
    clear: function(){
        this.parent();
    }, // end clear()

    //-----------------------------------------------------
    // name: update()
    // desc: updates the event properties
    //-----------------------------------------------------
    update: function(event, ibit){
        // update the parent element
        if (this.parent(event, ibit) == false){
            return false;
        } // end if

        // get the event object
        var evt = this.m_event;

        // get and normalize the position of the event
        if (evt.pageX || evt.pageY){
            evt.x = evt.pageX;
			evt.y = evt.pageY;
	    } // end if
        else if (evt.clientX || evt.clientY){
            evt.x = evt.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
            evt.y = evt.clientY + document.body.scrollTop + document.documentElement.scrollTop;
        } // end else if

        return true;
    }, // end update()

    ///////////////////////////////////////
    // static methods
    ClassMethods:{
		//---------------------------------------------
		// name: onGragEnd()
		// desc: 
		//---------------------------------------------
		onDragEnd : function(evt){
			this.update(evt, 3);
	        this.m_bcapture = false;
	 	}, // end onDrag
		
	    //------------------------------------------------------
	    // name: onMouseDown()
	    // desc: handler to call if a mouse is used
	    //------------------------------------------------------
	    onMouseDown : function(evt){
	        this.update(evt, 4);
	        this.m_bcapture = true;
	        this.m_capturepos = this.getPos();
			// prevent draging images for now
			evt.target.ondragstart = function() { return false; };
		}, // end onMouseDown()

	    //------------------------------------------------------
	    // name: onMouseUp()
	    // desc: handler to call if a mouse is used
	    //------------------------------------------------------
	    onMouseUp : function(evt){
	        this.update(evt, 5);
	        this.m_bcapture = false;
		}, // end onMouseUp()

	    //------------------------------------------------------
	    // name: onMouseMove()
	    // desc: handler to call if a mouse is used
	    //------------------------------------------------------
	    onMouseMove : function(evt){
	        this.update(evt, 6);
	    }, // end onMouseMove()

	    //------------------------------------------------------
	    // name: onMouseOut()
	    // desc: handler to call if a mouse is used
	    //------------------------------------------------------
	    onMouseOut : function(evt){
	        this.update(evt, 7);
			this.m_bcapture = false;
	    }, // end onMouseOut()

	    //------------------------------------------------------
	    // name: onMouseOver()
	    // desc: handler to call if a mouse is used
	    //------------------------------------------------------
	    onMouseOver : function(evt){
	        this.update(evt, 8);
	    }, // end onMouseOver()
		
		//-------------------------------------------------------
		// name: onContextMenu()
		// desc: handler to call if a mouse is used
		//-------------------------------------------------------
		onContextMenu : function( evt ){
			return this.m_bshowcontextmenu;
		} // end onContextyMwenu()
	} // end ClassMethods
});   // end CMouse