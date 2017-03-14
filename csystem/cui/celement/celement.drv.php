<?php
//-------------------------------------------------------------------
// file: celement.drv.php
// desc: integrates celement with cangularjs 
//-------------------------------------------------------------------

// includes
include_js(relname(__FILE__).'/celement.drv.js');

//--------------------------------------------------------------------------------
// name: defineStyles(), defineFunctions(), defineClassStyles(), defineClasses()	
// desc: methods called only by the kernal to set up all the celements
//--------------------------------------------------------------------------------
function CElement_defineStyles(){	
	$str = "\r\n/* celement styles ///////////////////////*/\r\n";;
	if( $celements = CElement::getCElements() )
		foreach( $celements as $strname => $celement )
			$str .= $celement->style();  // add some javascript 
	return "\r\n".trim($str);
} // end CElement_defineStyles()

function CElement_defineClassStyles(){	
	$str = "/* celement class styles ///////////////////////*/\r\n";
	if( CElementAttributes::$m_clsattributes == NULL )
		return $str;
	foreach( CElementAttributes::$m_clsattributes as $strclassname => $celementattr )
		$arr[] = ".".strtolower($strclassname)."{".$celementattr->toString()."}\n";
	for( $i=(count($arr)-1); $i>-1; $i--) 		
		$str .= $arr[$i];
	return "\r\n".trim($str)."\r\n";
} // end CElement_defineClassStyles()

function CElement_defineFunctions(){
	$str = "// functions ////////////////////////\r\n";
	if( $celements = CElement::getCElements() )
		foreach( $celements as $strname => $celement )
			$str .= $celement->script();  // add some javascript 		
	return $str;
} // end CElement_defineFunctions()

function CElement_defineClasses(){
	$str = "// classes ////////////////////////\r\n";
	if( $celements = CElement::getCElements() )
		foreach( $celements as $strname => $celement )
			$str .= $celement->toString_Classes( get_class( $celement ) );
	return trim($str)."\r\n\r\n";
} // end CElement_defineClasses()
	
function CElement_defineProperties(){
	$str = "// properties ////////////////////////\r\n";
	if( $celements = CElement::getCElements() )
		foreach( $celements as $strname => $celement )
			$str .= $celement->props();
	return $str;
} // CElement_defineProperties()

//-------------------------------------------------------------------------------------------------
// name: hooks()
//       CElement_defineFunctions(), CElement_defineClasses(), CElement_defineStyles()
// desc: sets up callback methods to be hooked in with the kernal
//-------------------------------------------------------------------------------------------------
CHook :: add( "fscript", "CElement_defineClasses" );
CHook :: add( "fscript", "CElement_defineFunctions" );
CHook :: add( "fscript", "CElement_defineProperties" );
CHook :: add( "style", "CElement_defineStyles" );

//---------------------------------------------------------
// name: CElement_IncludeNGControllers() 
// desc: includes the controller on the element object
//---------------------------------------------------------
function CElement_includeNGControllers(){
	if(!class_exists("CAngularJS"))
		return "";
	$celements = CElement :: getCElements();
	if( !$celements )
		return "";
	foreach( $celements as $strname => $celement ){
		$classtype = $celement->attr("classtype");
		$controller = CAngularJS :: getControllerNameByClass($classtype);
		if( $controller != "" ){
			$celement->attr( "ng-controller", $controller );
			$celement->attr( "ng-init", "init('".$celement->id()."');" ); 
		} // end if
	} // end foreach
	return "";
} // end CElement_includeController()

// add hooks
CHook :: add( "init", "CElement_includeNGControllers" ); // call during the initialization of the kernal when it initilizes the CElements
?>