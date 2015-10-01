<?php
//---------------------------------------------------------------------------
// name: cdatabasevar.prg.php
// desc: demos hows to get data from database easily using cvar
//---------------------------------------------------------------------------

// includes
include_program( "CDatabaseVarProgram" );
//include_memory( "databasememory", "localhost/c3dclassessdk/cdatabasevar.prg", "CDatabaseMemory", array("username"=>"root", "password"=>"") );
//include_memory( "databasememory", "localhost/c3dclassessdk/cdatabasememory", "CDatabaseMemory", array("username"=>"kevlewis_admin", "password"=>"yu?me@work2") );
include_memory( "databasememory", "localhost/prac/cdatabasememory", "CDatabaseMemory", array("username"=>"root", "password"=>"") );


//---------------------------------------------------
// name: CDatabaseVarProgram
// desc: Database Var Program
//---------------------------------------------------
class CDatabaseVarProgram extends CProgram{
	public function CDatabaseVarProgram(){ 
		parent :: CProgram();	
	} // end cdatabasevarProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr("<b>cdatabasevar.js</b>");
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	alert("hello, world");
?>
<style>
/*#this.id{ background:red; }*/
</style>
<script>
//this.jelement.css("background", "red" );
</script>
<?php
	printbr("<b>cdatabasevar.php</b>");
	echo_cdatabasevar_button( "new cdatabasevar", "new_cdatabasevar" );
	echo_cdatabasevar_button( "delete cdatabasevar", "delete_cdatabasevar" );
	echo_cdatabasevar_button( "get cdatabasevar", "get_cdatabasevar" );
	echo_cdatabasevar_button( "set cdatabasevar", "set_cdatabasevar" );
	printbr();
	
	$memory = use_memory( "databasememory" );
	if( $memory )
		printbr( "Cdatabasememory Contents: " . $memory->toString() );
	else 
		printbr( "Cdatabasememory Contents: no contents" );
	
	printbr();
return ob_end();
	} // end innerhtml()
} // end cdatabasevarProgram

function delete_cdatabasevar(){ 
	if(($cdatabasevar=getvar("databasememory","foo1"))==NULL){ 
		printbr( "ERROR: couldn't delete cdatabasevar. cdatabasevar Doesn't exist!!"); 
		return;  
	} // end if
	printbr( 'delvar("databasememory","foo1"): ' . print_r($cdatabasevar->_(),true) );
	delvar($cdatabasevar);
} // end delete_cdatabasevar()

function new_cdatabasevar(){ 
	if(($cdatabasevar=newvar("databasememory","foo1","Hello, World: ".rand(),""))==NULL){
		printbr( "ERROR: couldn't create cdatabasevar(foo1,NULL). Check if cdatabasevar may already exists!!"); 	
		return;
	} // end if
	printbr( 'newvar("databasememory","foo1"): ' . print_r($cdatabasevar->_(),true) ); 
} // end new_cdatabasevar()

function get_cdatabasevar(){ 
	if(($cdatabasevar=getvar("databasememory","foo1"))==NULL){ 
		printbr( "ERROR: couldn't get cdatabasevar. cdatabasevar doesnt exist!!"); 
		return;  
	} // end if
	printbr( 'getvar("databasememory","foo1"): ' . print_r($cdatabasevar->_(),true) );
} // end get_cdatabasevar()

function set_cdatabasevar(){ 
	if(($cdatabasevar=getvar("databasememory","foo1"))==NULL){ 
		printbr( "ERROR: couldn't set cdatabasevar. cdatabasevar doesnt exist!!"); 
		return;  
	} // end if
	printbr( 'getvar("databasememory","foo1"): ' . print_r( $cdatabasevar->_( array(1,2,3,4,5,6) ), true ) );
} // end get_cdatabasevar()

function echo_cdatabasevar_button( $strlabel="button", $strfnaction="" ){
	if( isset($_REQUEST["echoButtonCallBack"]) == true && 
		function_exists( $_REQUEST["echoButtonCallBack"] ) == true &&
		$_REQUEST["echoButtonCallBack"] == $strfnaction )
		$_REQUEST["echoButtonCallBack"]();
?>
	<form>
		<input type="submit" value="<?php echo $strlabel ?>" />
        <input type="hidden" name="echoButtonCallBack" value="<?php echo $strfnaction ?>" />
        <input type="hidden" name="cprogramtype" value="CDatabaseVarProgram" />
    </form>
<?php	
} // end echo_button()
?>