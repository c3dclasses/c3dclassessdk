<?php
//---------------------------------------------------------------------------------
// file: cprogram.php
// desc: defines a framework to create and run php program object 
//---------------------------------------------------------------------------------

// includes
include_js( relname( __FILE__ ) . "/cprogram.js" );

//---------------------------------------------------------------------------------------------
// name: CProgram
// desc: defines a program that runs in a specified area of the webpage inside the webbrowser
//---------------------------------------------------------------------------------------------
class CProgram extends CElement{
	// members
	static protected $m_cprogramtypes = NULL;	// stores the type of programs that a user can instantiate
	static protected $m_cprogram = NULL;		// stores all of the programs that are instantiated
	
	//-----------------------------------------------------------
	// name: CProgram() / create()
	// desc: constructs and creates the CProgram
	//-----------------------------------------------------------
	public function  	CProgram(){ 
		parent::CElement(); 
		$classtype = $this->attr( "classtype" );
		$this->event( "oncprogramc_main", "{$classtype}.c_main" );
	} // end CProgram()
	public function 	create( $params=NULL ){ 
		if( $params && isset($params["parentcontainer"]) )
			$this->attr( "parentcontainer", $params["parentcontainer"]);  
		if( CProgram :: $m_cprogram == NULL )
			CProgram :: $m_cprogram = new CHash();
		CProgram :: $m_cprogram->set( $this->id(), $this ); 
		return true; 
	} // end create()
	
	//---------------------------------------------------------------
	// name: c_main() / s_main()
	// desc: c_main() - embeds clientside code
	//       s_main() - embeds serverside code
	//---------------------------------------------------------------
	public function 	c_main(){ return ""; }
	public function 	s_main(){ return true; } 

	//--------------------------------------------------------------------------------
	// name: getCProgram() / getCProgram() / doInit() / doSMain() / toString_Body()
	// desc: class methods 
	//--------------------------------------------------------------------------------
	public static function  getCProgram( $strprogramname ){ 
		return ( CProgram :: $m_cprogram == NULL ) ? NULL : CProgram :: $m_cprogram->get( $strprogramname ); 
	} // end getCProgram()
	public static function  getCPrograms(){ 
		return ( CProgram :: $m_cprogram == NULL ) ? NULL : CProgram :: $m_cprogram->valueOf(); 
	} // end getCPrograms()
	public static function	getCProgramTypes(){
		return ( CProgram :: $m_cprogramtypes == NULL ) ? NULL : CProgram :: $m_cprogramtypes->keys()->valueOf();
	} // end getCProgramTypes()

/*
	public static function 	doInit(){
		if( $cprograms = CProgram :: getCPrograms() )
			foreach( $cprograms as $strname => $cprogram ) 
				$cprogram->init();
	} // end doInit()
	public static function 	doSMain(){
		if( $_REQUEST == NULL || isset( $_REQUEST["s_main"] ) == false )
			return false;
		if( $cprograms = CProgram :: getCPrograms() )
			foreach( $cprograms as $strname => $cprogram ) 
				$cprogram->s_main(); 
		return true;
	} // end doSMain()
	public static function 	doBody(){
		$str = "";
		if( $cprograms = CProgram :: getCPrograms() )
			foreach( $cprograms as $strname => $cprogram ) 
				$str .= $cprogram->body();
		return $str;
	} // end toString_Body()
*/	
	// register the program 
	public static function 	register( $cprogramtype, $params=NULL ){
		if( class_exists( $cprogramtype ) == false )
			return false;
		if( CProgram :: $m_cprogramtypes == NULL )
			CProgram :: $m_cprogramtypes = new CHash(); 	
		CProgram :: $m_cprogramtypes->set( $cprogramtype, $params );
		return true; 
	} // end register
} // end CProgram

//----------------------------------------------------------------------------------------
// name: use_program(), include_program(), include_programs()
// desc: include a bunch of php files with a given extension and from a given path 
//----------------------------------------------------------------------------------------
function include_program( $strcprogramtype, $params=NULL ){  CProgram :: register( $strcprogramtype, $params ); }
function use_program( $cprogram, $params=NULL ){ return ( $cprogram != NULL && $cprogram->create( $params ) ); }
function include_programs( $strpath ){ if( function_exists( "includephpfilesfrompath" ) == true ) includephpfilesfrompath( $strpath, ".prg.php" ); }

/*
// hook handlers
function CProgram_doInit(){ return CProgram::doInit(); }
CHook :: add( "init", "CProgram_doInit" );
function CProgram_doSMain(){ return CProgram::doSMain(); }
CHook :: add( "s_main", "CProgram_doSMain" );
function CProgram_doBody(){ return CProgram::doBody(); }
CHook :: add( "body", "CProgram_doBody" );
*/
?>