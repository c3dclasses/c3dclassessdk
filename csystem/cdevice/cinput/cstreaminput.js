//------------------------------------------------------
// file: cstreaminput.js
// desc: defines a generic input class
//------------------------------------------------------

//------------------------------------------------------
// name: CStreamInput
// desc: defines a generic stream input class
//------------------------------------------------------
var CStreamInput = new Class({
	Extends: CInput, // inherits the CInput

	//--------------------------------
    // name: initialize()
    // desc: contructor
    //--------------------------------
    initialize : function(){
    }, // end initialize()

    //--------------------------------------------------------------------
    // name: create()
    // desc: creates the input object from an element on the webpage
    //--------------------------------------------------------------------
    create : function(){
    	return true;
	}, // end create()
	
	//---------------------------------------------------
	// name: 
	// desc:
	//---------------------------------------------------
	isUp : function(){},
	isDown : function(){},
	isLeft : function(){},
	isRight : function(){},
	isButton : function(){} 	
});  // end CStreamInputs