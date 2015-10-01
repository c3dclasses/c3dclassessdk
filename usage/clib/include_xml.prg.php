<?php
//---------------------------------------------------------------------------
// name: include_xml.prg.php
// desc: demonstates how to use angularjs functions for cform
//---------------------------------------------------------------------------

// includes
include_program( "include_xml" );
//include_js( relname(__FILE__) . "/" . "celement-controller.js");
//include_controller( "include_xml", array( "name"=>"foo_controller", "func"=>"foo") );
include_xml( "myhtml", "http://c3dclasses/usage/libs/content.html" );
include_xml( "google", "http://www.google.com" );

//---------------------------------------------------
// name: include_xml
// desc: demonstates how to use angularjs functions
//---------------------------------------------------
class include_xml extends CProgram{
	public function include_xml(){ 
		parent :: CProgram();
		//$this->attr("hello","hello");
		
		// add this attribute to the 
		//$this->attr( "ng-app", $this->id() );
		//$this->attr( "ng-controller", "CElement_Controller" );
		//$this->attr( "ng-init", "first='John';last='Doe';" );
		$this->attr( "ng-init", "foo='fifyefofum';" );
		
		
		//$this->scope("first","'John'");
		//$this->scope("last","'Doe'");
		//$this->scope("num",'8');
		
		// enable angular js
		$this->angular();
		
	} // end include_xml()
	
	public function c_main(){
return <<<SCRIPT
	//this.scope.setKev(10);
	//alert( this.kev );
	this.kev = 20;
	this.park = "<i>This is my park</i>";
	alert("main");
	
	this.foo = function(){ alert("cookie crisp"); }
	
	//var _this = this;
	//_for( 2000, function(){
	//	_this.kev = this.getIteration();
	//	_this.update();
	//});
	
	// update this elements html/view region
	this.update();
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){		
ob_start();
?>
	<?php echo contents_xml( "myhtml" ); //  get data from out views?>
    <button ng-click="this.foo()"></button> <!-- excute scope methods -->
     <?php echo contents_xml( "google" ); ?>
<?php
return ob_end();
	} // end innerhtml()
} // end angularjs
?>