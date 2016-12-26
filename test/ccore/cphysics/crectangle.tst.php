<?php
//---------------------------------------------------------------------------
// file: crectangle.tst.php
// desc: demonstrates how to to use the crectangle object
//---------------------------------------------------------------------------

// includes
include_unittest("CRectangleUnitTest");

//-----------------------------------------------------
// name: CRectangleUnitTest
// desc: demonstrates how to to use the crectangle object
//-----------------------------------------------------
class CRectangleUnitTest extends CUnitTest {
	public function CRectangleUnitTest() { 
		parent :: CUnitTest();	
	} // end CRectangleUnitTest()
	
	// test method
	public function testCRectangle() {
		$crectangle = new CRectangle();
		$crectangle->set(100, 100, 0, 200, 200, 200);
		$this->assertTrue_CRectangle($crectangle, 100, 100, 0, 200, 200, 200);
		$cpoint = new CPoint();
		$cpoint->set(300, 300, 300);
	
		// aligning
		$crectangle2 = new CRectangle();
		$crectangle2->set(120, 120, 0, 50, 50, 50);
		$crectangle2->align($crectangle, CConstants :: $BOTTOM | CConstants :: $RIGHT);
		$this->assertTrue_CRectangle($crectangle2, 250, 250, 0, 50, 50, 50);
		$crectangle3 = new CRectangle();
		$crectangle3->set(120, 120, 0, 50, 50, 50);
		$crectangle3->align($crectangle, CConstants :: $TOP | CConstants :: $LEFT);
		//$this->printbr_CRectangle($crectangle3);
		$this->assertTrue_CRectangle($crectangle3, 100, 100, 0, 50, 50, 50);
	
		// inset
		$crectangle2->inset(10, 10, 10);	
		$this->assertTrue_CRectangle($crectangle2, 260, 260, 10, 40, 40, 40);
		$crectangle2->inset(-10, -10, -10);	
		$this->assertTrue_CRectangle($crectangle2, 250, 250, 0, 50, 50, 50);
				
		// adjust
		$crectangle4 = new CRectangle();
		$crectangle4->set(350, 350, 0, 30, 30, 30);
		$crectangle4->adjust($crectangle, CConstants :: $WIDTH);
		$this->assertTrue_CRectangle($crectangle4, 350, 350, 0, 200, 30, 30);
		$crectangle4->adjust($crectangle, CConstants :: $HEIGHT);
		$this->assertTrue_CRectangle($crectangle4, 350, 350, 0, 200, 200, 30);
		$crectangle4->adjust($crectangle, CConstants :: $LENGTH);
		$this->assertTrue_CRectangle($crectangle4, 350, 350, 0, 200, 200, 200);
		
		// map
		$crectangle5 = new CRectangle();
		$crectangle5->set(800, 800, 0, 20, 100, 30);
		$crectangle5->map($crectangle);
		$this->assertTrue_CRectangle($crectangle5, 800, 800, 0, 40, 200, 30);
		$crectangle5->pos->set(50,50,50);
		$crectangle5->map($crectangle);
		$this->assertTrue_CRectangle($crectangle5, 50, 50, 50, 40, 200, 30);
		
		// intersection
		$this->assertTrue($crectangle->intersectCRectangle($crectangle2));
		$this->assertTrue($crectangle->intersectCRectangle($crectangle4) == false);
		$this->assertTrue($crectangle->intersectCPoint($cpoint));		
	} // end testCRectangle()

	public function printbr_CRectangle($crectangle) {
		printbr($crectangle->pos->x);
		printbr($crectangle->pos->y);
		printbr($crectangle->pos->z);			
		printbr($crectangle->size->w);
		printbr($crectangle->size->h);
		printbr($crectangle->size->l);	
	} // end assertTrue_CRectangle()

	
	public function assertTrue_CRectangle($crectangle, $x, $y, $z, $w, $h, $l) {
		$this->assertTrue($crectangle->pos->x==$x);
		$this->assertTrue($crectangle->pos->y==$y);
		$this->assertTrue($crectangle->pos->z==$z);			
		$this->assertTrue($crectangle->size->w==$w);
		$this->assertTrue($crectangle->size->h==$h);
		$this->assertTrue($crectangle->size->l==$l);	
	} // end assertTrue_CRectangle()
	
} // end CRectangleProgram

ob_start();
?>
<script parse="true" location="footer">
//-----------------------------------------------------
// name: CRectangleUnitTest
// desc: demonstrates how to to use the ccontent object
//-----------------------------------------------------
include_unittest("CRectangleUnitTest");
var CRectangleUnitTest = new Class ({ 
    Extends: CUnitTest,	
	// test method
	testCRectangle : function() {
		var crectangle = new CRectangle();
		crectangle.set(100, 100, 0, 200, 200, 200);
		this.assertTrue_CRectangle(crectangle, 100, 100, 0, 200, 200, 200);
		cpoint = new CPoint();
		cpoint.set(300, 300, 300);

		// aligning
		var crectangle2 = new CRectangle();
		crectangle2.set(120, 120, 0, 50, 50, 50);
		crectangle2.align(crectangle, CConstants.BOTTOM | CConstants.RIGHT);
		this.assertTrue_CRectangle(crectangle2, 250, 250, 0, 50, 50, 50);
		var crectangle3 = new CRectangle();
		crectangle3.set(120, 120, 0, 50, 50, 50);
		crectangle3.align(crectangle, CConstants.TOP | CConstants.LEFT);
		this.assertTrue_CRectangle(crectangle3, 100, 100, 0, 50, 50, 50);
			
		// inset
		crectangle2.inset(10, 10, 10);	
		this.assertTrue_CRectangle(crectangle2, 260, 260, 10, 40, 40, 40);
		crectangle2.inset(-10, -10, -10);	
		this.assertTrue_CRectangle(crectangle2, 250, 250, 0, 50, 50, 50);
				
		// adjust
		var crectangle4 = new CRectangle();
		crectangle4.set(350, 350, 0, 30, 30, 30);
		crectangle4.adjust(crectangle, CConstants.WIDTH);
		this.assertTrue_CRectangle(crectangle4, 350, 350, 0, 200, 30, 30);
		crectangle4.adjust(crectangle, CConstants.HEIGHT);
		this.assertTrue_CRectangle(crectangle4, 350, 350, 0, 200, 200, 30);
		crectangle4.adjust(crectangle, CConstants.LENGTH);
		this.assertTrue_CRectangle(crectangle4, 350, 350, 0, 200, 200, 200);
		
		// map
		var crectangle5 = new CRectangle();
		crectangle5.set(800, 800, 0, 20, 100, 30);
		crectangle5.map(crectangle);
		this.assertTrue_CRectangle(crectangle5, 800, 800, 0, 40, 200, 30);
		crectangle5.pos.set(50,50,50);
		crectangle5.map(crectangle);
		this.assertTrue_CRectangle(crectangle5, 50, 50, 50, 40, 200, 30);
	
		// intersection
		this.assertTrue(crectangle.intersectCRectangle(crectangle2));
		this.assertTrue(crectangle.intersectCRectangle(crectangle4) == false);
		this.assertTrue(crectangle.intersectCPoint(cpoint));		
	}, // end testCRectangle
	printbr_CRectangle : function(crectangle) {
		var str = "";
		str += (crectangle.pos.x) + " ";
		str += (crectangle.pos.y) + " ";
		str += (crectangle.pos.z) + " ";			
		str += (crectangle.size.w) + " ";
		str += (crectangle.size.h) + " ";
		str += (crectangle.size.l);	
		alert(str);
	}, // end assertTrue_CRectangle()

	assertTrue_CRectangle : function(crectangle, x, y, z, w, h, l) {
		this.assertTrue(crectangle.pos.x==x);
		this.assertTrue(crectangle.pos.y==y);
		this.assertTrue(crectangle.pos.z==z);			
		this.assertTrue(crectangle.size.w==w);
		this.assertTrue(crectangle.size.h==h);
		this.assertTrue(crectangle.size.l==l);	
	} // end assertTrue_CRectangle()
	
}); // end CRectangleProgram
</script><!-- end script -->
<?php
ob_end_queue("body");	// put this code in the script queue to be rendered later
?>