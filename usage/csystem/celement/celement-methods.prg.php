<?php
//---------------------------------------------------------------------------
// name: celement-methods.prg.php
// desc: demonstrates how to use CElement
//---------------------------------------------------------------------------

// includes
include_program( "CElementMethodsProgram" );

//---------------------------------------------------
// name: CElementMethodsProgram
// desc: celement program demo
//---------------------------------------------------
class CElementMethodsProgram extends CProgram{
	protected $m_celement;
	public function CElementMethodsProgram(){ 
		parent :: CProgram();
	} // end CElementMethodsProgram()
	
	public function c_main(){ 
return <<<JSCRIPT
printbr("<b>celement-methods.js</b>");

var cparent = this.getParent();
cparent.css("border","#000000 solid 1px" );	

var cbody = CElement.toCElement("body");
cbody.css("border", "blue solid 1px");

var ckernal_output = CElement.toCElement("#ckernal-output");
ckernal_output.css("background", "blue");

var cbold = CElement.toCElements("b");
for( var i=0; i<cbold.length; i++ )
	cbold[i].css("color", "orange");

this.css("background", "red");
var children = this.getChildren();
if( children )
	for( var i=0; i<children.length; i++ )
		children[i].html( children[i].html() + "- adding html to child<br />" );
 

alert("getting child index 2");
var cchild = this.getChildByIndex(2);
if( cchild ){
	cchild.css("color","white");
	alert("getting child index 2");
	var cchildnext = cchild.nextSibling();
	cchildnext.css("color","blue");
	var cchildprev = cchild.prevSibling();
	cchildprev.css("color","green");
} // end if

alert("moving the child from index 2 to 0");
cchild.moveSibling( 0 );		// make cchild[2] from current location to cchild[0]

alert("removing the last child");
this.popChild();				

alert("inserting new element at position 2");
var _this = this;
var celement = new CElement();
celement.create( jQuery( "<div>insertChild(2) - New Element 1 is created here</div>" ) );
this.insertChild( celement, 2 );

alert("pushing new element at end");
celement = new CElement();
celement.create( jQuery( "<div>pushChild() - New Element 2 is created here</div>" ) );
this.pushChild( celement );

alert("pushing new element at front");
celement = new CElement();
celement.create( jQuery( "<div>unshiftChild() - New Element 3 is created here</div>" ) );
this.unshiftChild( celement );

celement = new CElement();
celement.create( jQuery( "<div>Click me to remove first child element</div>" ) );
this.pushChild( celement );
celement.event("click", function(){ alert("removing new element at front");  _this.shiftChild(); } );

celement = new CElement();
celement.create( jQuery( "<div>Click me to pop last child element</div>" ) );
this.pushChild( celement );
celement.event("click", function(){ alert("removing new element at back");  _this.popChild(); } );
JSCRIPT;
	} // end c_main()
	
	public function innerhtml(){
ob_start();
print("<b>child[0]</b>");
print("<b>child[1]</b>");
print("<b>child[2]</b>");
print("<b>child[3]</b>");
print("<b>child[4]</b>");
return ob_end();
	} // end innerhtml()
} // end CElementMethodsProgram
?>