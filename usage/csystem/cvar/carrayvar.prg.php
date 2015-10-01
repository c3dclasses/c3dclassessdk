<?php
//---------------------------------------------------------------------------
// name: carrayvar.prg.php
// desc: demonstrates how to use remote variable in your program
//---------------------------------------------------------------------------

// includes
include_program( "CArrayVarProgram" );
//include_memory( "arraymemory", dirname(__FILE__)."/carrayvar.prg.json", "Carraymemory" );
include_array_memory( "arraymemory", "session", $_SESSION );


//---------------------------------------------------
// name: CArrayVarProgram
// desc: hello world program
//---------------------------------------------------
class CArrayVarProgram extends CProgram{
	public function CArrayVarProgram(){ 
		parent :: CProgram();	
	} // end CArrayVarProgram()
	
	public function c_main(){
return <<<SCRIPT
	//printbr("<b>carrayvar.js</b>");
	//var cmemory = use_memory( "arraymemory" );
	/*
	_if( function(){ return ( cmemory.data() != null ); }, function(){ 
		printbr( "Carraymemory Contents: " + cmemory._toString() );		
		printbr();
		var carrayvar=null;
		if((carrayvar=getvar("arraymemory","foo1"))==null){ 
			printbr( "ERROR: couldn't delete carrayvar. carrayvar Doesn't exist!!"); 
		} // end if
		else 
		printbr( "contents of var: " + carrayvar._() );
		carrayvar._("Setting the Remote variable in javascript again!!");		
		this._return();
	})._endif(); // end _if()
	*/
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>carrayvar.php</b>");
	echo_button2( "new carrayvar", "new_carrayvar" );
	echo_button2( "delete carrayvar", "delete_carrayvar" );
	echo_button2( "get carrayvar", "get_carrayvar" );
	echo_button2( "set carrayvar", "set_carrayvar" );
	printbr();
	$memory = use_memory( "arraymemory" );
	printbr( "CArrayMemory Contents: " . $memory->toString() );
	printbr();
return ob_end();
	} // end innerhtml()
} // end CArrayVarProgram

function delete_carrayvar(){ 
	if(($carrayvar=getvar("arraymemory","foo1"))==NULL){ 
		printbr( "ERROR: couldn't delete carrayvar. carrayvar Doesn't exist!!"); 
		return;  
	} // end if
	printbr( 'delvar("arraymemory","foo1"): ' . print_r($carrayvar->_(),true) );
	delvar($carrayvar);
} // end delete_carrayvar()

function new_carrayvar(){ 
	if(($carrayvar=newvar("arraymemory","foo1","Hello, World: ".rand(),""))==NULL){
		printbr( "ERROR: couldn't create carrayvar(foo1,NULL). Check if carrayvar may already exists!!"); 	
		return;
	} // end if
	printbr( 'newvar("arraymemory","foo1"): ' . print_r($carrayvar->_(),true) ); 
} // end new_carrayvar()

function get_carrayvar(){ 
	if(($carrayvar=getvar("arraymemory","foo1"))==NULL){ 
		printbr( "ERROR: couldn't get carrayvar. carrayvar doesnt exist!!"); 
		return;  
	} // end if
	printbr( 'getvar("arraymemory","foo1"): ' . print_r($carrayvar->_(),true) );
} // end get_carrayvar()

function set_carrayvar(){ 
	if(($carrayvar=getvar("arraymemory","foo1"))==NULL){ 
		printbr( "ERROR: couldn't set carrayvar. carrayvar doesnt exist!!"); 
		return;  
	} // end if
	printbr( 'getvar("arraymemory","foo1"): ' . print_r( $carrayvar->_( array(1,2,3,4,5,6) ), true ) );
} // end get_carrayvar()

function echo_button2( $strlabel="button", $strfnaction="" ){
	if( isset($_REQUEST["echoButtonCallBack"]) == true && 
		function_exists( $_REQUEST["echoButtonCallBack"] ) == true &&
		$_REQUEST["echoButtonCallBack"] == $strfnaction )
		$_REQUEST["echoButtonCallBack"]();
?>
	<form>
		<input type="submit" value="<?php echo $strlabel ?>" />
        <input type="hidden" name="echoButtonCallBack" value="<?php echo $strfnaction ?>" />
        <input type="hidden" name="cprogramtype" value="CArrayVarProgram" />
    </form>
<?php	
} // end echo_button()
?>