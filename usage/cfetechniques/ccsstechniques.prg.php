<?php
//---------------------------------------------------------------------------
// name: ccsstechniques.prg.php
// desc: demonstrates CSS techniques
//---------------------------------------------------------------------------

// includes
include_program( "CCSSTechniquesProgram" );
include_css(relname(__FILE__) . "/ccsstechniques.css");
include_sass( dirname(__FILE__ ) . "/ccsstechniques2.scss" );
include_css(relname(__FILE__) . "/ccsstechniques.css");
include_css("http://fonts.googleapis.com/css?family=Average|Courgette");


//---------------------------------------------------
// name: CCSSProgram
// desc: hello world program
//---------------------------------------------------
class CCSSTechniquesProgram extends CProgram{
	public function CCSSTechniquesProgram(){ 
		parent :: CProgram();	
	} // end CCSSProgram()
	
	public function c_main(){
return <<<SCRIPT
	printbr( "<b>ccsstechniques.js</b>" );
	
	// jquery chaining
	$("p").css("color", "red").slideUp(2000).slideDown(2000);
	
	var deferred = $.Deferred();
	
	deferred.resolve("hello, world");
	deferred.done( function( value ){ alert( value ); } );
	
SCRIPT;
	} // end load()
	
	// rendering methods
	public function innerhtml(){
ob_start();
	printbr("<b>ccsstechniques.php</b>"); 
	printbr("This is the image sprite below");
	$src = relname(__FILE__)."/sprites.gif";
?>
	<img src="<?php echo $src; ?>"/>
    <div id='container'></div>
   
    <br/>
    <br/>
    <br/>
    <br/>
    
    <p>Grid System</p>
    <div class="grid">
    	<div class="col-2-3">Main Div</div>
        <div class="col-1-3">Side Bar</div>
    </div>
    
    <br/>
    <br/>
    <br/>
    <br/>
   	
    <div id="boxsizingdemo">
    	This is the box sizing demo
    </div>
    
<?php
return ob_end();
	} // end innerhtml()
} // end CCSSProgram
?>