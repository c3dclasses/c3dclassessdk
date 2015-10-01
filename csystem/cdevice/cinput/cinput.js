//------------------------------------------------------
// file: cinput.js
// desc: defines a generic input class
//------------------------------------------------------

//------------------------------------------------------
// name: CInput
// desc: defines a generic input class
//------------------------------------------------------
var CInput = new Class({
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
    create : function(celement){
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
});  // end CInputs