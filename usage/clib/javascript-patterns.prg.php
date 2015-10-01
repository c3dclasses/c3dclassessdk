<?php
//---------------------------------------------------------------------------
// name: JavascriptPatterns.prg.php
// desc: demonstates how to use javascript functions
//---------------------------------------------------------------------------

// includes
include_program( "JavascriptPatterns" );

//---------------------------------------------------
// name: JavascriptPatterns
// desc: demonstatrates how to use javascript functions
//---------------------------------------------------
class JavascriptPatterns extends CProgram{
	public function javascript(){ 
		parent :: CProgram();	
	} // end javascript()
	
	public function c_main(){
return <<<SCRIPT
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){
ob_start();
?>	
<?php  
return ob_end();
	} // end innerhtml()
} // end JavascriptPatterns
ob_start();
?>
<script parse="true" location="footer">
	function CObject(){
		var m_name = "kevin";
		return {
			getName : function(){
				return m_name;
			}, // end getName()
			setName : function( name ){
				this.name = name;
			} // end getName()
		} // end return
	} // end CObject
	
	cobject = CObject();
	cobject.setName("Joe");
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
