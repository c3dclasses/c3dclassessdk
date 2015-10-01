//------------------------------------------------------
// file: cdeviceinput.js
// desc: defines a generic input class
//------------------------------------------------------

//------------------------------------------------------
// name: CDeviceInput
// desc: defines a generic device input class
//------------------------------------------------------
var CDeviceInput = new Class({
	 Extends: CInput, // inherits the CInput

    //--------------------------------
    // name: initialize()
    // desc: contructor
    //--------------------------------
    initialize : function(){
        this.m_cbitarray = null;
    	this.m_cbitarray_prevent_default = null;
    	this.m_cbitarray_stop_propagation = null;
		this.m_event = null;
		this.m_celement = null;
		this.m_bmaintainstate = false;
    }, // end initialize()

    //--------------------------------------------------------------------
    // name: create()
    // desc: creates the input object from an element on the webpage
    //--------------------------------------------------------------------
    create : function(celement){
        // check if the element is a string 
        if( typeof(celement) == "string" &&
		   ( celement = CElement.toCElement(celement) ) == null ){
			return false;
		} // end if
        
        // declare and create the bitarray stucture
        var cbitarray = new CBitArray();
        if (!cbitarray || cbitarray.create(32) == false){
			return false;
		} // end if
		
		 // declare and create the bitarray stucture
        var cbitarray_prevent_default = new CBitArray();
        if (!cbitarray_prevent_default || cbitarray_prevent_default.create(32) == false){
			return false;
		} // end if
		
		// declare and create the bitarray stucture
        var cbitarray_stop_propagation = new CBitArray();
        if (!cbitarray_stop_propagation || cbitarray_stop_propagation.create(32) == false){
			return false;
		} // end if
		
        // save the element and bitarray structure
        this.m_celement = celement;
		this.m_cbitarray = cbitarray;
        this.m_cbitarray_prevent_default = cbitarray_prevent_default;
    	this.m_cbitarray_stop_propagation = cbitarray_stop_propagation;
		return true;
    }, // end create()
	
	/////////////////////////////////
	// get cinput event attributes
	
	//-------------------------------------------------------------------------
    // name: getEvent()
    // desc: returns the event of the object
	//-------------------------------------------------------------------------
    getEvent : function(){
     	return this.m_event;
	}, // end getEvent()
	
    //-------------------------------------------------------------------------
    // name: getTime()
    // desc: returns the time in which the input was captured in milliseconds
    //-------------------------------------------------------------------------
    getTime : function(){
     	return ( this.m_event == null ) ? -1 : this.m_event.timeStamp;
	}, // end getTime()
	
	//-------------------------------------------------------------------------
    // name: getType()
    // desc: returns the type of the event
    //-------------------------------------------------------------------------
    getType : function(){
     	return ( this.m_event == null ) ? "" : this.m_event.type;
	}, // end getType()

    //-------------------------------------------------------------------------
    // name: getTarget()
    // desc: returns the target element
    //-------------------------------------------------------------------------
    getTarget : function() {
     	return ( this.m_event == null ) ? "" : this.m_event.target;
	}, // end getTarget()

    //-------------------------------------------------------------------------
    // name: getCElementTarget()
    // desc: returns the target as a celement
    //-------------------------------------------------------------------------
    getCElementTarget : function (){
        return ce(this.getTarget());
    }, // end getCElementTarget()

    //-------------------------------------------------------------------------
    // name: getCurrentTarget()
    // desc: returns the current target element
    //-------------------------------------------------------------------------
    getCurrentTarget : function(){
     	return ( this.m_event == null ) ? "" : this.m_event.currentTarget;
	}, // end getCurrentTarget()

    //-------------------------------------------------------------------------
    // name: getCurrentCElementTarget()
    // desc: returns the target as a celement
    //-------------------------------------------------------------------------
    getCurrentCElementTarget : function(){
        return ce(this.getCurrentTarget());
    }, // end getCElementTarget()

	//-------------------------------------------------------------------------
    // name: getRelatedTarget()
    // desc: returns the related target element
    //-------------------------------------------------------------------------
    getRelatedTarget : function(){
     	return ( this.m_event == null ) ? "" : this.m_event.relatedTarget;
	}, // end getRelatedTarget()

    //-------------------------------------------------------------------------
    // name: getRelatedCElementTarget()
    // desc: returns the target as a celement
    //-------------------------------------------------------------------------
    getRelatedCElementTarget : function(){
        return ce(this.getRelatedTarget());
    }, // end getCElementTarget()

	//-------------------------------------------------------------------------
	// name: isTrigger()
	// desc: returns
	//-------------------------------------------------------------------------
	isTrigger : function(){
	 	return ( this.m_event == null ) ? "" : this.m_event.isTrigger;		
	}, // end isTrigger()

	//-------------------------------------------------------------------------
	// name: getView()
	// desc: returns the view
	//-------------------------------------------------------------------------
	getView : function(){
	 	return ( this.m_event == null ) ? "" : this.m_event.view;		
	}, // end getView()
		
	//-------------------------------------------------------------------------
	// name: getPhase()
	// desc: returns the phase of the event
	//-------------------------------------------------------------------------
	getPhase : function(){
	 	return ( this.m_event == null ) ? "" : this.m_event.eventPhase;		
	}, // end getView()

	//-------------------------------------------------------------------------
	// name: get()
	// desc: returns the view
	//-------------------------------------------------------------------------
	getCancelable : function(){
	 	return ( this.m_event == null ) ? "" : this.m_event.cancelable;		
	}, // end getView()

	//------------------------------------------------------------------------
	// name: getBubbles()
	// desc: returns the bubble state
	//-------------------------------------------------------------------------
	getBubbles : function(){
	 	return ( this.m_event == null ) ? "" : this.m_event.bubbles;		
	}, // end getBubbles()

	//-------------------------------------------------------------------------
	// name: getSrcElement()
	// desc: returns the src element
	//-------------------------------------------------------------------------
	getSrcElement : function(){
	 	return ( this.m_event == null ) ? "" : this.m_event.srcElement;		
	}, // end getSrcElement()

	//-------------------------------------------------------------------------
	// name: getRelatedNode()
	// desc: returns the related node
	//-------------------------------------------------------------------------
	getRelatedNode : function(){
	 	return ( this.m_event == null ) ? "" : this.m_event.relatedNode;		
	}, // end getRelatedNode()

	//-------------------------------------------------------------------------
	// name: getAttrName()
	// desc: returns the attribute name
	//-------------------------------------------------------------------------
	getAttrName : function(){
	 	return ( this.m_event == null ) ? "" : this.m_event.attrName;		
	}, // end getAttrName()
	
	//-------------------------------------------------------------------------
	// name: get()
	// desc: returns the view
	//-------------------------------------------------------------------------
	getAttrChange : function(){
	 	return ( this.m_event == null ) ? "" : this.m_event.attrChange;		
	}, // end getAttrChange()

	//-------------------------------------------------------------------------
	// name: getEventPhase()
	// desc: returns the view
	//-------------------------------------------------------------------------
	getDelegateTarget : function(){
	 	return ( this.m_event == null ) ? "" : this.m_event.delegateTarget;		
	}, // end getDelegateTarget()

	//-------------------------------------------------------------------------
	// name: getData()
	// desc: returns the view
	//-------------------------------------------------------------------------
	getData : function(){
	 	return ( this.m_event == null ) ? "" : this.m_event.data;		
	}, // end getData()

	//-------------------------------------------------------------------------
	// name: getHandleObj()
	// desc: returns the view
	//-------------------------------------------------------------------------
	getHandleObj : function(){
	 	return ( this.m_event == null ) ? "" : this.m_event.handleObj;		
	}, // end getHandleObj()
    
	//----------------------------------------------------------------------    
	// name: maintainState()    
	// desc: determines if the state of input events should be maintained    
	//----------------------------------------------------------------------
    maintainState : function( bmaintainstate ){
        this.m_bmaintainstate = bmaintainstate;
    }, // end maintainState()

    //------------------------------------------------------
    // name: clear()
    // desc: clears the current input state
    //------------------------------------------------------
    clear : function(){
        if(this.m_cbitarray)
            this.m_cbitarray.clearAllBits();
    }, // end clear()

    //-----------------------------------------------------
    // name: getInputState()
    // desc: returns the current input state
    //-----------------------------------------------------
    getInputState : function (ibit){
        if(this.m_cbitarray == null){
			return false;
		} // end if()
		
        var bstate = this.m_cbitarray.isBitSet(ibit);
        if(bstate && this.m_bmaintainstate == false ){
			this.m_cbitarray.clearBit(ibit);
		} // end if
		return bstate;
    }, // end getInputState()

	//-------------------------------------------------------
    // name: update()
    // desc: updates the cinput object
	//-------------------------------------------------------
    update : function( event, ibit ){
		if( !event ){
			return false;
		} // end if
		
		this.m_event = event;
        this.m_cbitarray.setBit(ibit);
		
		// prevent default and stop propation
		if( this.m_cbitarray_prevent_default && this.m_cbitarray_prevent_default.isBitSet(ibit) )
			this.m_event.preventDefault();
		if( this.m_cbitarray_stop_propagation && this.m_cbitarray_stop_propagation.isBitSet(ibit) )	
			this.m_event.stopPropagation();	
		return true;
    }, // end update()
	
	//---------------------------------------------------------------------
	// name: preventDefault()
	// desc: prevents the default handler for execute for a given event  
	//---------------------------------------------------------------------
	preventDefault : function( ibitevent, bprevent, strfilter ){
		if( this.m_cbitarray_prevent_default )
			this.m_cbitarray_prevent_default.enableBit(ibitevent, bprevent);
		 // use strfilter the element to filter for later
	}, // end preventDefault();

	//---------------------------------------------------------------------
	// name: preventDefault()
	// desc: prevents the default handler for execute for a given event  
	//---------------------------------------------------------------------
	stopPropagation : function( ibitevent, bstop, strfilter ){
		if( this.m_cbitarray_stop_propagation )
			this.m_cbitarray_stop_propagation.enableBit(ibitevent, bstop);
		 // use strfilter the element to filter for later
	}, // end stopPropagation(); 	
});  // end CDeviceInput