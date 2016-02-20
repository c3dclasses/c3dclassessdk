<?php
//---------------------------------------------------------------------------
// name: cjsonvar.prg.php
// desc: demonstrates how to use remote variable in your program
//---------------------------------------------------------------------------

// includes
include_program( "CJSONVarProgram" );
include_memory( "jsonmemory", dirname(__FILE__)."/cjsonvar.prg.json", "CJSONMemory" );

//---------------------------------------------------
// name: CJSONVarProgram
// desc: hello world program
//---------------------------------------------------
class CJSONVarProgram extends CProgram{
	public function CJSONVarProgram(){ 
		parent :: CProgram();	
	} // end CJSONVarProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr("<b>cjsonvar.js</b>");
	var cmemory = use_memory("jsonmemory");
	_if( function(){ return ( cmemory.data() != null ); }, function(){ 
		printbr( "CJSONMemory Contents: " + cmemory._toString() );		
		printbr();
		var cvar=null;
		if((cvar=getvar("jsonmemory","foo1"))==null){ 
			printbr( "ERROR: couldn't delete cjsonvar. cjsonvar Doesn't exist!!"); 
		} // end if
		else 
		printbr( "contents of var: " + cvar._() );
		cvar._("Setting the Remote variable in javascript again!!");		
		this._return();
	})._endif(); // end _if()
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>cjsonvar.php</b>");
	echo_button( "new cjsonvar", "new_cjsonvar" );
	echo_button( "delete cjsonvar", "delete_cjsonvar" );
	echo_button( "get cjsonvar", "get_cjsonvar" );
	echo_button( "set cjsonvar", "set_cjsonvar" );
	printbr();
	$memory = use_memory( "jsonmemory" );
	printbr( "CJSONMemory Contents: " . $memory->toString() );
	printbr();
return ob_end();
	} // end innerhtml()
} // end cjsonvarProgram

function delete_cjsonvar(){ 
	if(($cjsonvar=getvar("jsonmemory","foo1"))==NULL){ 
		printbr( "ERROR: couldn't delete cjsonvar. cjsonvar Doesn't exist!!"); 
		return;  
	} // end if
	printbr( 'delvar("jsonmemory","foo1"): ' . print_r($cjsonvar->_(),true) );
	delvar($cjsonvar);
} // end delete_cjsonvar()

function new_cjsonvar(){ 
	if(($cjsonvar=newvar("jsonmemory","foo1","Hello, World: ".rand(),""))==NULL){
		printbr( "ERROR: couldn't create cjsonvar(foo1,NULL). Check if cjsonvar may already exists!!"); 	
		return;
	} // end if
	printbr( 'newvar("jsonmemory","foo1"): ' . print_r($cjsonvar->_(),true) ); 
} // end new_cjsonvar()

function get_cjsonvar(){ 
	if(($cjsonvar=getvar("jsonmemory","foo1"))==NULL){ 
		printbr( "ERROR: couldn't get cjsonvar. cjsonvar doesnt exist!!"); 
		return;  
	} // end if
	printbr( 'getvar("jsonmemory","foo1"): ' . print_r($cjsonvar->_(),true) );
} // end get_cjsonvar()

function set_cjsonvar(){ 
	if(($cjsonvar=getvar("jsonmemory","foo1"))==NULL){ 
		printbr( "ERROR: couldn't set cjsonvar. cjsonvar doesnt exist!!"); 
		return;  
	} // end if
	printbr( 'getvar("jsonmemory","foo1"): ' . print_r( $cjsonvar->_( array(1,2,3,4,5,6) ), true ) );
} // end get_cjsonvar()

function echo_button( $strlabel="button", $strfnaction="" ){
	if( isset($_REQUEST["echoButtonCallBack"]) == true && 
		function_exists( $_REQUEST["echoButtonCallBack"] ) == true &&
		$_REQUEST["echoButtonCallBack"] == $strfnaction )
		$_REQUEST["echoButtonCallBack"]();
?>
	<form>
		<input type="submit" value="<?php echo $strlabel ?>" />
        <input type="hidden" name="echoButtonCallBack" value="<?php echo $strfnaction ?>" />
        <input type="hidden" name="cprogramtype" value="cjsonvarProgram" />
    </form>
<?php	
} // end echo_button()
?>