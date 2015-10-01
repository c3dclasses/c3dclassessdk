<?php
//----------------------------------------------------------
// name: content.cnt.php
// desc: defines simple usage to create content resources
//----------------------------------------------------------

// include content resources
includecontent( "ccontent_foo", array( "form"=>"ccontent_foo_form",			// defines the form for customization 
									   "body"=>"ccontent_foo", 				// defines the body of the content to display it
									   "init"=>"ccontent_foo_init", 		// defines the initialization of the content
									   "update"=>"ccontent_foo_update" ) );	// defines how the content get updated
									   
includecontent( "ccontent_content", array( "body"=>"ccontent_content" ) );	// just includes a body for display

//-----------------------------------------------------------------------------
// name: ccontent_foo()
// desc: init(), form(), update(), body()
// in: cwidgetintances the widget that the content live in or belongs to
//-----------------------------------------------------------------------------
function ccontent_foo_init( $cwidgetinstance ){
} // end ccontent_foo_init()
function ccontent_foo_form( $cwidgetinstance ){
	$ccontrols = $cwidgetinstance->getCControls();
	echo $ccontrols->text( "input-stuff", "Enter Text Here..." );
	echo "inside of the form";
	echo $ccontrols->content_form("subcontrol");
} // end ccontent_foo<strong></strong>
function ccontent_foo_update( $cwidgetinstance ){
	useiofile("foo")->println("using io file to write contents");
} // end ccontent_foo_update()
function ccontent_foo( $cwidgetinstance ){	
	$ccontrols = $cwidgetinstance->getCControls();
	$str = $ccontrols->content_body("subcontrol");
	return $str . "this is my sample content to show inside a widget"; 
} // end ccontent_foo

//-----------------------------------------------------------------------------
// name: ccontent_foo()
// desc: init(), form(), update(), body()
// in: cwidgetintances the widget that the content live in or belongs to
//-----------------------------------------------------------------------------
function ccontent_content ( $cwidgetinstance ){
	printbr("hello world from ccontent_content");
} // end ccontent_content()
?>
