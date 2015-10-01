<?php
//---------------------------------------------------------------------------
// name: CLoggerProgram.prg.php
// desc: demonstates how to use CLogger
//---------------------------------------------------------------------------

// includes
include_program("CLoggerProgram");
include_logger( dirname(__FILE__) . "/clogger.cfg.xml" );

//---------------------------------------------------
// name: CLoggerProgram
// desc: demonstatrates how to use CLogger
//---------------------------------------------------
class CLoggerProgram extends CProgram{
	public function CLoggerProgram(){ 
		parent :: CProgram();	
		
	} // end CLoggerProgram()
		
	// rendering methods
	public function innerhtml(){
ob_start();
		printbr("<b>CLoggerProgram.php</b>");
		alert( __CLASS__ );
		$logger = use_logger(__CLASS__);
		$logger->info("This is an informational message.\n");
		$logger->warn("I'm not feeling so good...\n");
		$logger->info("We have liftoff.");
return ob_end();
	} // end innerhtml()
} // end CLoggerProgram
?>