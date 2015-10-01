<?php
//---------------------------------------------------------------------------
// name: javascript.prg.php
// desc: demonstates how to use javascript functions
//---------------------------------------------------------------------------

// includes
include_program( "javascript" );

//---------------------------------------------------
// name: javascript
// desc: demonstatrates how to use javascript functions
//---------------------------------------------------
class javascript extends CProgram{
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
} // end javascript
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
	
	//alert( cobject.getName() );
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
