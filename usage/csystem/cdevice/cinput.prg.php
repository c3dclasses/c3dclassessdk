<?php
//---------------------------------------------------------------------------
// name: cbase.prg.php
// desc: demonstrates how to construct a basic hello, world!!! program
//---------------------------------------------------------------------------

// includes
include_program( "CInputProgram" );

//---------------------------------------------------
// name: CInputProgram
// desc: hello world program
//---------------------------------------------------
class CInputProgram extends CProgram{
	public function CInputProgram(){ 
		parent :: CProgram();	
	} // end CInputProgram()
	
	public function c_main(){
return <<<SCRIPT

	printbr( "<b>cinput.js</b>" );
	//------------------------------------------------
	// name: random_input()
	// desc:
	//------------------------------------------------
	var random_input = function(){
		// 1.) setup the keyboard
        var kb = new CKeyboard();
    	kb.create("#combo-area");
  		_while( function(){			
		}); // end _while()
		
	} // end random_input()
	
	//---------------------------------------------------------
    // name: up_down_left_right_ba_ba_enter()
    // desc: creating complex custom events using CInput object
    //----------------------------------------------------------
  	var up_down_left_right_ba_ba_enter = function()
    {
        var starttime = 0;
        var steps = [38,40,37,39,98,97,98,97,13];
        var i=0;
        var time=-1;

    	// 1.) setup the keyboard
        var kb = new CKeyboard();
    	kb.create("#combo-area");
  		
        // 2.) check if a key is up, down, or pressed
    	_while(function(){
            if( kb.isKeyPressed(steps[i]) ) i++;
            else if( kb.isKeyPressed() ) i=0;
            if( i<=1 ) starttime = kb.getTime();
            if( Math.abs( kb.getTime() - starttime ) > 9000 )
            	i=0;
            if( i==steps.length ){
            	alert("haduken!!!!");
                i=0;
            } // end if
        }); // end _while()
    } // end  up_down_left_right_ba_ba_enter() 
    
    //----------------------------------------------------
    // name: swipe()
	// desc: defines a gesture movement with the mouse
    //----------------------------------------------------
    var swipe = function()
    {
    	// 1.) setup the mouse
        var ms = new CMouse();  
        ms.create("#swipe-area");
		
		alert("set up swipe action");
 
		// 2.) check if for the mouse swipe action
        var posx = 0;
  		var state = '';       
        _while( function(){
        	if( ms.isButtonDown() ){
             	posx = ms.getPos().x;
            	state = "down";
                var target = ms.getCurrentTarget();
                console.log("mouse down at posx: " + posx);
                console.log("mouse down at target: " + target );
                console.log("mouse down at target2: " + ms.getTarget() );
            } // end if
            
            if( ms.isButtonUp() ){
            	if( Math.abs( ms.getPos().x - posx ) > 100 )
                	alert( "swipe");
                console.log("mouse up at posx: " + ms.getPos().x );
            } // end if     	
        } ); // end while()
    } // end swipe()
    
    // do the keyboard combination
   	up_down_left_right_ba_ba_enter();
    
    // do the mouse gester
    swipe();
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>cinput.php</b>");
?>
	<h4>Test Keyboard Combination - {up,down,left,right,b,a,b,a,enter} combination</h4>
	<div tabindex="0" id="combo-area" style="width: 300px; height: 100px; background-color:red;">Hello, World!!!</div>
	<h4>Test Mouse Swipe - Click and Hold the Right Button, Drag 50 pixels, Release</h4>
	<div type="text" id="swipe-area" style="width: 500px; height: 100px; background-color:red;"/>Test Swipe Action Here!!!!!</div>
<?php
return ob_end();
	} // end innerhtml()
} // end CInputProgram
?>