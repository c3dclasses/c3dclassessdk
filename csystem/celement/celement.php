<?php
//-------------------------------------------------------------------
// file: celement.php
// desc: defines a basic html element thats defined in a webpage
//-------------------------------------------------------------------

// headers
include_once('celementattributesex.php');
include_js(relname(__FILE__).'/celement.js');

//---------------------------------------------------------
// class: CElement
// desc: defines the base class of an element object
//---------------------------------------------------------
class CElement extends CElementAttributesEx{
	protected			$m_strtagname;					// stores the tag name
	protected			$m_bsingletag;					// single-tag or single-tag?
	protected			$m_innerhtml;					// the innerHTML component of a tag
	protected			$m_bbefore;						// renders the innerhtml before the child celements 
	protected			$m_childcelements;		 		// stores all the child elements that this element contains
	protected			$m_content;
	static public		$m_inumelements = 0;	 		// stores the number of elements that where constructed
	static public		$m_celements = NULL;	 		// stores all the element instances on a page
	static public		$m_registeredclasses = NULL;	// stores all the register classes
	
	// constructing
	public function 	CElement(){ 
		$this->initialize(); 
		$this->m_content = new CElementContent(); 
		$this->m_content->create($this); 
	} // end CElement()
	
	// creating 
	public function create( $param=NULL ){
	} // end create()
	
	// properties 
	public function 	tag(){ if( func_num_args() == 0 ) return $this->m_strtagname; $this->m_strtagname=func_get_arg(0); return $this; }	
	public function  	state(){ if( func_num_args() == 0 ) return parseInt($this->attr("state")); $this->attr("state",func_get_arg(0)); return $this; }
	public function		value(){ if( func_num_args() == 0 ) return $this->attr("value"); $this->attr( "value", func_get_arg(0) ); return $this; }
	public function		text(){} // returns the text inside the tags
	public function 	html(){ if( func_num_args() == 0 ) return $this->m_innerhtml; $this->m_innerhtml=func_get_arg(0); return $this; }
	public function		name(){ 
		if( func_num_args() == 0 ) return $this->attr( "name" );  	
		if( CElement::$m_celements == NULL ) 
			CElement::$m_celements = new CHash();			
		CElement::$m_celements->remove( $this->attr("name") );
		$this->attr( "name", func_get_arg(0) );  
		CElement::$m_celements->set( $this->attr("name"), $this );
		return $this; 
	} // end name()
	public function 	content(){ return $this->m_content; }
	
	// filename / paths	
	public function		filename(){ return $this->prop( "m_filename" ); }
	public function		urifilename(){ return $this->prop( "m_urifilename" ); }
	
	// padding, margins, border
	public function 	padding( $strloc ){$prop="padding-".$strloc; if(func_num_args()==1)return $this->css($prop); $this->css($prop,func_get_arg(1)); return $this; }	
	public function		margin( $strloc ){$prop="margin-".$strloc;if(func_num_args()==1)return $this->css($prop);$this->css($prop,func_get_arg(1)); return $this;}
	public function 	border( $strloc ){$prop="border-".$strloc;if(func_num_args()==1)return $this->css($prop);$this->css($prop,func_get_arg(1)); return $this;}	
	public function 	p( $strloc ){ return (func_num_args()==1) ? parseInt($this->padding($strloc)) : $this->padding($strloc, parseInt(func_get_arg(1)) . "px" ); }	
	public function 	m( $strloc ){ return (func_num_args()==1) ? parseInt($this->margin($strloc)) : $this->margin($strloc, parseInt(func_get_arg(1)) . "px" ); }	
	public function 	b( $strloc ){ return (func_num_args()==1) ? parseInt($this->border($strloc)) : $this->border($strloc, parseInt(func_get_arg(1)) . "px " . func_get_arg(2) ); }	
	
	// position	
	public function		position(){ if(func_num_args()<=0)return $this->css("position"); $this->css("position",func_get_arg(0)); return $this; }
	public function 	x(){ $pt = $this->cpoint(); return (func_num_args()==0) ? $pt->x : $this->cpoint( func_get_arg(0), $pt->y, $pt->z ); }
	public function 	y(){ $pt = $this->cpoint(); return (func_num_args()==0) ? $pt->y : $this->cpoint( $pt->x, func_get_arg(0), $pt->z ); }
	public function 	z(){ $pt = $this->cpoint(); return (func_num_args()==0) ? $pt->z : $this->cpoint( $pt->x, $pt->y, func_get_arg(0) ); }
	public function		lockx(){ if( func_num_args() == 0 ) return $this->attr("lockx"); $this->attr( "lockx", toString(func_get_arg(0)) ); return $this; }
	public function		locky(){ if( func_num_args() == 0 ) return $this->attr("locky"); $this->attr( "locky", toString(func_get_arg(0)) ); return $this; }
	public function		lockz(){ if( func_num_args() == 0 ) return $this->attr("lockz"); $this->attr( "lockz", toString(func_get_arg(0)) ); return $this; }
	public function		minx(){ if( func_num_args() == 0 ) return $this->attr("minx"); $this->attr( "minx", parseInt(func_get_arg(0)) ); return $this; }
	public function		miny(){ if( func_num_args() == 0 ) return $this->attr("miny"); $this->attr( "miny", parseInt(func_get_arg(0)) ); return $this; }
	public function		minz(){ if( func_num_args() == 0 ) return $this->attr("minz"); $this->attr( "minz", parseInt(func_get_arg(0)) ); return $this; }
	public function		maxx(){ if( func_num_args() == 0 ) return $this->attr("maxx"); $this->attr( "maxx", parseInt(func_get_arg(0)) ); return $this; }
	public function		maxy(){ if( func_num_args() == 0 ) return $this->attr("maxy"); $this->attr( "maxy", parseInt(func_get_arg(0)) ); return $this; }
	public function		maxz(){ if( func_num_args() == 0 ) return $this->attr("maxz"); $this->attr( "maxz", parseInt(func_get_arg(0)) ); return $this; }
	public function 	cpoint(){
		$ox = $this->m('left') + $this->b('left') + $this->p('left');
		$oy = $this->m('top') + $this->b('top') + $this->p('top');
		$oz = 0;	
		if( func_num_args()==0 ){
			$pt = $this->m_content->cpoint();
			$pt->x -= $ox;
			$pt->y -= $oy;
			$pt->z -= $oz;
			return $pt;
		} // end if
		return $this->m_content->cpoint(func_get_arg(0)+$ox, func_get_arg(1)+$oy, func_get_arg(2)+$oz);
	} // end cpoint()
	
	// dimensions
	public function 	w(){ $sz = $this->csize(); return (func_num_args()==0) ? $sz->w : $this->csize( func_get_arg(0), $sz->h, $sz->l ); }
	public function 	h(){ $sz = $this->csize(); return (func_num_args()==0) ? $sz->h : $this->csize( $sz->w, func_get_arg(0), $sz->l ); }
	public function 	l(){ $sz = $this->csize(); return (func_num_args()==0) ? $sz->l : $this->csize( $sz->w, $sz->h, func_get_arg(0) ); }
	public function		lockw(){ if( func_num_args() == 0 ) return $this->attr("lockx"); $this->attr( "lockx", toString(func_get_arg(0)) ); return $this; }
	public function		lockh(){ if( func_num_args() == 0 ) return $this->attr("locky"); $this->attr( "locky", toString(func_get_arg(0)) ); return $this; }
	public function		lockl(){ if( func_num_args() == 0 ) return $this->attr("lockz"); $this->attr( "lockz", toString(func_get_arg(0)) ); return $this; }
	public function		minw(){ if( func_num_args() == 0 ) return $this->attr("minw"); $this->attr( "minw", parseInt(func_get_arg(0)) ); return $this; }
	public function		minh(){ if( func_num_args() == 0 ) return $this->attr("minh"); $this->attr( "minh", parseInt(func_get_arg(0)) ); return $this; }
	public function		minl(){ if( func_num_args() == 0 ) return $this->attr("minl"); $this->attr( "minl", parseInt(func_get_arg(0)) ); return $this; }
	public function		maxw(){ if( func_num_args() == 0 ) return $this->attr("maxw"); $this->attr( "maxw", parseInt(func_get_arg(0)) ); return $this; }
	public function		maxh(){ if( func_num_args() == 0 ) return $this->attr("maxh"); $this->attr( "maxh", parseInt(func_get_arg(0)) ); return $this; }
	public function		maxl(){ if( func_num_args() == 0 ) return $this->attr("maxl"); $this->attr( "maxl", parseInt(func_get_arg(0)) ); return $this; }
	public function 	csize(){
		$ow = ($this->m('left') + $this->m('right') + $this->b('left') + $this->b('right') + $this->p('left') + $this->p('left'));
		$oh = ($this->m('top') + $this->m('bottom') + $this->b('top') + $this->b('bottom') + $this->p('top') + $this->p('bottom'));
		$ol = 0;
		if( func_num_args()==0 ){
			$sz = $this->m_content->csize();
			$sz->w += $ow;
			$sz->h += $oh;
			$sz->l += $ol;
			return $sz;  
		} // end if
		return $this->m_content->csize(func_get_arg(0)-$ow, func_get_arg(1)-$oh, func_get_arg(2)-$ol);
	} // end csize()
	public function 	crectangle(){
		$crectangle = new CRectangle();
		$pt = $this->cpoint();
		$sz = $this->csize();
		$crectangle->create( $pt->x, $pt->y, $pt->z, $sz->w, $sz->h, $sz->l );
		return $crectangle;
	} // end crectangle()
	
	// elements	
	public function 	createChild( $strtagname ){
	} // end createChild() 
	public function		addChild( $strname, $celement=NULL ){ 
		if( $celement == NULL && gettype( $strname ) == "object" ){ 
			$celement = $strname; 
			$strname = $celement->name(); 
		} // end if
		if( $this != $celement ) {
			$this->m_childcelements->set( $strname, $celement ); 
			//printbr( "added the child" );
		} // end if
		return $this; 
	} // end addChild() 
	public function		removeChild( $celement ){ 
		$strname = ( gettype( $celement ) == "object" && get_class( $celement ) == "CElement" ) ? $celement->name() : $celement; 
		$this->m_childcelements->remove( $strname ); 
		return $this; 
	} // removeChild()
	public function 	getChild( $strname ){ 
		return $this->getChildRec( $strname, $this ); 
	} // end getChild()
	public function 	getFirstChild(){
	} // end getFirstChild()
	public function 	getLastChild(){
	} // end getLastChild()
	public function 	getNextChild(){
	} // end getLastChild()
	public function 	getPrevChild(){
	} // end getLastChild()
	public function 	getChildByIndex( $i ){
	} // end getChildByIndex()
	protected function	getChildRec( $strnametofind, $celement ){
		if( $celement == NULL ) 
			return NULL;
		if( $strnametofind == $celement->name() )
			return $celement;
		if( ( $children = $celement->getChildren() ) == NULL )
			return NULL;
		foreach( $children as $strname => $child )
			if( $child = $this->getChildRec( $strnametofind, $child ) )
				return $child;
		return NULL;		
	} // end getChildRec()
	public function 	moveChild(){
	} // end moveChild()
	public function 	getChildren(){ 
		return ($this->m_childcelements && $this->m_childcelements->valueOf()) ? $this->m_childcelements->valueOf() : NULL; 
	} // end getChildren() 
	public function		visitChildren( $strcallbackfunc ){
		// check if the function and this celement's children exist  
		if( function_exists( $strcallbackfunc ) == false || 
			( $children = $this->getChildren() ) == NULL ) 
			return false;
		// go through each children calling the callback function on each visit
		foreach( $children as $strname => $child ){
			$strcallbackfunc( $child );
			$child->visitChildren( $strcallbackfunc ); 
		} // end foreach
	} // visitChildren()
	public function		getParent(){
	} // end getParent()
	public function		getAncestors(){
	} // end getAncestors()
	public function		getDescendents(){
	} // end getDescendents()
	public function		getSiblings(){
	} // end getSiblings()
	public function		one( $selector ){
	} // end one()
	public function		all( $selector ){
	} // end all()
	
	//------------------------------------------------------------------
	// name: isSingleTag(), enableSingleTag(), initialize()
	// desc: helper 
	//-------------------------------------------------------------------
	public function 	isSingleTag(){ return $this->m_bsingletag; }
	public function		enableSingleTag( $bsingletag=true ){ $this->m_bsingletag = $bsingletag; }
	public function		initialize(){
		// set css, event, attr objects
		parent::CElementAttributes();
		
		// get default classname, classnames, id
		$strthisclassname = get_class( $this );
		$rc = new ReflectionClass( $strthisclassname );
		$strfilename = ($rc) ? $rc->getFileName() : "";
		$strthisclassnames = CElement :: getRegisteredClassName( $strthisclassname );
		$strclassname = strtolower( $strthisclassname );
		$strclassnames = strtolower( $strthisclassnames );
		$iid = CElement::$m_inumelements;
		CElement::$m_inumelements++;
		$strpath = relname( __FILE__ ) . "/celement.php";
	
		// set the element's default name, classnames, id, type, children, state, innerhtml
		$this->classes( $strclassnames );
		$this->name( $strclassname . "_" . $iid );
		$this->id( $strclassname . "_" . $iid );
		$this->attr( "classtype", $strthisclassname );
		$this->prop( "m_filename", $strfilename );
		$this->prop( "m_urifilename", urlfile( basename( $strfilename ), $strfilename ) );
		$this->prop( "__FILE__", $this->prop( "m_urifilename" ) );
		$this->tag("div", true);
		$this->html("");
		$this->state("0");
		$this->enableSingleTag(false);
		$this->m_childcelements = new CHash();
		$this->event("oncelementload", "{$strthisclassname}.load");
		$this->event("oncelementunload", "{$strthisclassname}.unload");
		$this->event("oncelementresize", "{$strthisclassname}.resize");
		$this->event("oncelementready", "{$strthisclassname}.ready");
	} // initialize()
	
	//------------------------------------------------------------------------------------
	// name: init(), load(), unload(), script(), info(), style(), html(), methods() 
	// desc: functions called by the kernal to define the client-side version of CElement
	//------------------------------------------------------------------------------------
	public function 		init(){ return true; }	
	public function 		deInit(){ return true; }
	public function 		ready(){ return "/*alert('load celement from php');*/"; } 
	public function 		load(){ return "/*alert('load celement from php');*/"; } 
	public function 		unload(){ return "/*alert('unload from php');*/ var a=10;"; } 
	public function 		resize(){ return ""; } 
	public function			props(){ return $this->toString_Properties(); }
	static public function 	methods(){ return ""; }
	static public function 	classmethods(){ return ""; }
	public function			info(){ return "";/*listfiles( dirname( __FILE__ ), relname( __FILE__ ) );*/ }	
	public function 		preprocess( $strhtml ){
		$strhtml = str_replace( "this.id", $this->id(), $strhtml );
		$strhtml = str_replace( "this.class", strtolower(get_class( $this )), $strhtml );
		$strhtml = str_replace( "this.element", "jQuery(\"#{$this->id()}\").get(0)", $strhtml );
		$strhtml = str_replace( "this.jelement", "jQuery(\"#{$this->id()}\")", $strhtml );
		$strhtml = str_replace( "this.celement", "CElement.getCElement(\"{$this->id()}\")", $strhtml );
		return $strhtml;
	} // end preprocess()	
	public function 		script(){ return $this->toString_Script(); } 
	public function 		style(){ return $this->toString_Style(); }
	public function 		body(){ return $this->preprocess( $this->toString_Body() ); } 
	public function			xsl(){}
	public function 		innerhtml(){ return $this->toString_InnerHTML(); }

	//----------------------------------------------------------------
	// name: getCElements()
	// desc: returns the number of elements stored in the container
	//----------------------------------------------------------------
	static public function 	getCElements(){ 
		$celements = CElement::$m_celements; 
		return ( $celements && $celements->valueOf() ) ? $celements->valueOf() : NULL; 
	} // end getCElements
	
	//-----------------------------------------------------------------------------------------
	// name: getRegisteredClassName(), getClassName()
	// desc: returns the registered class names for a class
	// note: this class caches the classname so that getClassName doesnt need to be called 
	// example: getRegisteredClassName("CProgram") = "CProgram CElement"
	// example: getClassName( 'celement' ) = 'celement'
	//			getClassName( 'cprogram' ) = 'cprogram celement'
	//			getClassName( 'cmyprogram' ) = 'cmyprogram cprogram celement'
	//-----------------------------------------------------------------------------------------
	static public function getRegisteredClassName( $strthisclassname ){
		if( $strthisclassname == "" )
			return "";
		if( CElement::$m_registeredclasses == NULL )
			CElement::$m_registeredclasses = new CHash();
		if( ( $strregclassnames = CElement::$m_registeredclasses->get( $strthisclassname ) ) )
			return $strregclassnames;	
		CElement::$m_registeredclasses->set( $strthisclassname, ( $strregclassnames = CElement::getClassName( $strthisclassname ) ) );
		return $strregclassnames;
	} // end registerClasses
	static public function getClassName( $strclassname ){
		if( $strclassname == "" || $strclassname == NULL )
			return "";
		if( isset( CElementAttributes::$m_clsattributes[ $strclassname ] ) == false )
			CElementAttributes::$m_clsattributes[ $strclassname ] = new CCSSAttributes();
		if( $strclassname == "CElement" ) 
			return "CElement";		
		return $strclassname . " " . CElement :: getClassName( get_parent_class( $strclassname ) );
	} // end getClassName()	

	//----------------------------------------------------------------------------------------
	// name: toString(), toString_Body(), toString_InnerHTML(), toString_ClosingTag(),
	//		 toString_OpeningTag(), toString_InlineAttributes(), toString_InnerHTML(),
	//		 toString_AllChildCElements(), toString_ClosingTag(), toString_Script(),
	//		 toString_Classes(), toString_Class()
	// desc: returns a string representing body, style, script, ect tags
	//----------------------------------------------------------------------------------------
	public function		toStringInfo(){ return $this->m_info->toString(); }
	public function		toString(){ return $this->toString_Body(); } 
	public function		toString_Body(){	
		$str = $this->toString_OpeningTag();
		if( $this->m_bsingletag == true ) 
			return $str;		
		$str .= $this->innerhtml();
		$str .= $this->toString_ClosingTag();
		//$str .= $this->prop->toString();
		return $str;
	} // end toString_Body()
	public function 	toString_OpeningTag(){
		if( $this->m_strtagname == "" ) return "";
		$str = "<{$this->m_strtagname} ";
		$str .= $this->toString_InlineAttributes();
		if( $this->m_bsingletag == true ) 
			$str .= " /";
		$str .= ">";
		return $str;
	} // end toString_OpeningTag()	
	public function 	toString_InlineAttributes(){
		$str = $this->m_attr->toString();
		$str .= ' style="' . $this->m_icss->toString() . '"';
		return $str;
	} // end toString_InlineAttributes()	
	public function		toString_InnerHTML(){
		$str = "";
		if( $this->m_bbefore ){
			if( is_object( $this->m_innerhtml ) == true && 
				is_subclass_of( $this->m_innerhtml, "CElement" ) == true )  
				$str .= $this->m_innerhtml->body();
			else $str .= $this->m_innerhtml;
		} // end if
		$str .= $this->toString_AllChildCElements();		
		if( is_object( $this->m_innerhtml ) == true && 
			is_subclass_of( $this->m_innerhtml, "CElement" ) == true )  
				$str .= $this->m_innerhtml->body();
			else $str .= $this->m_innerhtml;		
		return $str;
	} // end toString_InnerHTML()
	public function 	toString_AllChildCElements(){ 
		$str="";
		if( ( $children = $this->getChildren() ) == NULL )
			return $str;
		foreach( $children as $strname => $child )
			$str .= $child->toString_Body();
		return $str;
	} // end toString_AllChildCElements()
	public function		toString_ClosingTag(){ return ( $this->m_strtagname != "" ) ? "</{$this->m_strtagname}>" : ""; }
	public function		toString_Style(){ 
		$str = "#{$this->id()}"."{".$this->m_css->toString()."}\n";
		$str .= $this->toStringPseudoCSS();
		return $str; //"#{$this->id()}"."{".$this->m_css->toString()."}\n"; 
	}
	public function		toString_Script(){ return $this->m_event->toString(); /* . "\r\n" . $this->m_event->toStringHandlers();*/ } 
	public function 	toString_Properties(){ 
		$id = $this->id();
		$str = "CPropertyAttributes.{$id}=".$this->m_prop->toString().";\r\n"; 
		$str .= "CUnModifiedPropertyAttributes.{$id}=".$this->m_uprop->toString().";\r\n"; 
		$str .= "CEventAttributes.{$id}=".$this->m_event->toStringHandlers().";\r\n";
		return $str;
	} // end toString_Properties()
	public function 	toString_Classes( $strclasstype ){
		global $isdefined;
		$str="";
		if( $strclasstype == "CProgram" || $strclasstype == "CElement" || isset( $isdefined[ $strclasstype ] ) == true ||
			$strclasstype == "" || $strclasstype == NULL ) 	// check if this class is already defined 
				return $str;
		$strparentclasstype = get_parent_class( $strclasstype ); // get the parent class
		$str .= $this->toString_Classes( $strparentclasstype );  // if it has a parent class get it's parent class first
		$str .= $this->toString_Class( $strclasstype, $strparentclasstype ); // now echo this class last
		$str .= "\n";	
		$isdefined[ $strclasstype ] = true; 	// flag that this class been defined
		return $str;
	} // toString_Classes()
	public function toString_Class( $strclasstype, $strparentclasstype ){
		//try{ if( ( $rMethod=new ReflectionMethod( $strclasstype, "methods") ) == NULL || // get the methods of the class
		//		 ( $rMethod->getDeclaringClass()->getName() != $strclasstype ) ) 
		//		 	return ""; 
		//}
		//catch( exception $e ){ return ""; }		
		$strmethods = (($strmethods=call_user_func( $strclasstype . '::methods' ))!="")?($strmethods.","):$strmethods;
		$strclassmethods = call_user_func( $strclasstype . '::classmethods' );
return <<<JSCRIPT
var $strclasstype = new Class
({ 
	// meta data
    Extends: $strparentclasstype,  
	{$strmethods}
	ClassMethods : {
	{$strclassmethods}
	} // end ClassMethods
}); // end $strclasstype
JSCRIPT;
	} // toString_Class()
} // end CElement

//---------------------------------------------------------
// name: CElementContent
// desc: defines the element content area
//---------------------------------------------------------
class CElementContent{
	public function			CElementContent(){ $this->m_celement=NULL; }
	public function 		create( $celement ){ $this->m_celement = $celement; }
	
	// standard 
	public function			left(){ if( func_num_args() == 0 ) return $this->m_celement->css( "left" ); $this->m_celement->css( "left", func_get_arg( 0 ) ); return $this; }
	public function			right(){ if( func_num_args() == 0 ) return $this->m_celement->css( "right" ); $this->m_celement->css( "right", func_get_arg( 0 ) ); return $this; }
	public function			top(){ if( func_num_args() == 0 ) return $this->m_celement->css( "top" ); $this->m_celement->css( "top", func_get_arg( 0 ) ); return $this; }
	public function			bottom(){ if( func_num_args() == 0 ) return $this->m_celement->css( "bottom" ); $this->m_celement->css( "bottom", func_get_arg( 0 ) ); return $this; }
	public function			zindex(){ if( func_num_args() == 0 ) return $this->m_celement->css( "z-index" ); $this->m_celement->css( "z-index", func_get_arg( 0 ) ); return $this; }
	public function			width(){ if( func_num_args() == 0 ) return $this->m_celement->css( "width" ); $this->m_celement->css( "width", func_get_arg( 0 ) ); return $this; }
	public function			height(){ if( func_num_args() == 0 ) return $this->m_celement->css( "height" ); $this->m_celement->css( "height", func_get_arg( 0 ) ); return $this; }
	public function			length(){ if( func_num_args() == 0 ) return $this->m_celement->css( "length" ); $this->m_celement->css( "length", func_get_arg( 0 ) ); return $this; }
	
	// positioning
	public function 		x(){ $pt = $this->cpoint(); return ( func_num_args()==0 ) ? $pt->x : $this->cpoint( func_get_arg(0), $pt->y, $pt->z ); }
	public function 		y(){ $pt = $this->cpoint(); return ( func_num_args()==0 ) ? $pt->y : $this->cpoint( $pt->x, func_get_arg(0), $pt->z ); }
	public function 		z(){ $pt = $this->cpoint(); return ( func_num_args()==0 ) ? $pt->z : $this->cpoint( $pt->x, $pt->y, func_get_arg(0) ); }
	public function 		cpoint(){
		if(!$this->m_celement) 
			return $this;
		if( func_num_args()==0 )
			return new CPoint( parseInt( $this->left() ), parseInt( $this->top() ), parseInt( $this->zindex() ) );
		$bx=$this->m_celement->attr("blockx");
		$by=$this->m_celement->attr("blocky");
		$bz=$this->m_celement->attr("blockz");
		if( $bx == "" || $bx == false ) 
			$this->left( parseInt(func_get_arg(0)) . "px" ); 
		if( $by == "" || $by == false ) 
			$this->top( parseInt(func_get_arg(1)) . "px" ); 
		if( $bz == "" || $bz == false ) 
			$this->zindex( parseInt(func_get_arg(2)) ); 
		return $this->m_celement;	
	} // end cpoint()

	// dimensions
	public function 		w(){ $sz = $this->csize(); return ( func_num_args()==0 ) ? $sz->w : $this->csize( func_get_arg(0), $sz->h, $sz->l ); }
	public function 		h(){ $sz = $this->csize(); return ( func_num_args()==0 ) ? $sz->h : $this->csize( $sz->w, func_get_arg(0), $sz->l ); }
	public function 		l(){ $sz = $this->csize(); return ( func_num_args()==0 ) ? $sz->l : $this->csize( $sz->w, $sz->h, func_get_arg(0) ); }	
	public function 		csize(){
		if(!$this->m_celement) 
			return $this;
		if( func_num_args()==0 ) 
			return new CSize( parseInt( $this->width() ), parseInt( $this->height() ), parseInt( $this->length() ) );
		$w = parseInt(func_get_arg(0));
		$h = parseInt(func_get_arg(1));
		$l = parseInt(func_get_arg(2));
		$bw=$this->m_celement->attr("lockw");
		$bh=$this->m_celement->attr("lockh");
		$bl=$this->m_celement->attr("lockl");
		if( $bw == "" || $bw == false ) $this->width( $w . "px" ); 
		if( $bh == "" || $bh == false ) $this->height( $h . "px" ); 
		if( $bl == "" || $bl == false ) $this->length( $l . "px" ); 
		return $this->m_celement;
	} // end csize()
	public function 		crectangle(){
		$crectangle = new CRectangle();
		$pt = $this->cpoint();
		$sz = $this->csize();
		$crectangle->create( $pt->x, $pt->y, $pt->z, $sz->w, $sz->h, $sz->l );
		return $crectangle;
	} // end crectangle()
	protected $m_celement;
} // end CElementContent 
?>