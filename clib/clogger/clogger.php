<?php
//----------------------------------------------------------------------------------------------
// name: CLogger.php
// desc: abstracts the functionality for angularjs and makes it easy to use in c3dclassesSDK
//----------------------------------------------------------------------------------------------

// includes
include('/apache-log4php-2.3.0/src/main/php/Logger.php');
include_js( relname(__FILE__) . "/clogger.js" );

//------------------------------------------------------------------------------------------------
// name: CLogger
// desc:  abstracts the functionality for angularjs and makes it easy to use in c3dclassesSDK
//------------------------------------------------------------------------------------------------
class CLogger {
} // end CLogger

/////////////////////
// includes
function include_logger( $strconfigfile ){
	Logger::configure( $strconfigfile );
} // end include_logger()

function use_logger( $strloggername ){
	return Logger::getLogger( $strloggername );
} // end use_logger()
?>