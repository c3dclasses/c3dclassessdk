<?php
//----------------------------------------------------------------------
// name: cwidget.usg.php
// desc: demonstrates how to use cwidget object that part of ctheme
//----------------------------------------------------------------------

// first include the widget resource so wordpress can see it
includewidget( "CHelloWorldWidget" );

//---------------------------------------------------------------------------------
// class: CHelloWorldWidget
// desc: a widget that defines a section on the page
//---------------------------------------------------------------------------------
class CHelloWorldWidget extends CWidget{
	
	public function CHelloWorldWidget(){ 
		$this->create( "CHelloWorldWidget", // widget class
					   "Hello Widget", 		// widget title you see on wordpress
					   "This widget creates a section or sidebar dynamically" 	// widget description
					   ); 
	} // end CSectionWidget() 

	public function body(){
		if(	!$this->m_cwidgetinstance || !($ccontrols=$this->m_cwidgetinstance->getCControls()))
			return;
		echo $ccontrol->option("foo-text");
	} // end body()

	// 
	public function admin_body(){		
		echo parent::admin_body();
		if(	!$this->m_cwidgetinstance || !($ccontrols=$this->m_cwidgetinstance->getCControls()))
			return;
		echo $ccontrol->text("foo-text","Please Enter Text");
	} // end admin_body()
	
	public function init(){
		alert("initialize the widget");
		return;	
	} // end init()
	
	public function update(){
	} // 
} // end CSectionWidget

?>