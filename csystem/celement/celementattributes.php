<?php
//------------------------------------------------------------------------------------
// file: celementattributes.php
// desc: defines set/get methods all the attributes an element can possibly have
//------------------------------------------------------------------------------------

// headers
include_once('cattributes.php');
include_js(relname(__FILE__).'/celementattributes.js');

//------------------------------------------------------------------------------------
// class: CElementAttributes
// desc:  defines set/get methods all the attributes an element can possibly have
//		  that includes tag, css, js, and etc.
//------------------------------------------------------------------------------------
class CElementAttributes{  
	protected 					$m_attr;	
	protected					$m_css;
	protected					$m_icss;	// inline css attributes
	protected 					$m_pcss;	// pseudo css attributes
	protected					$m_event;
	protected					$m_prop;
	protected					$m_uprop;
	protected					$m_info;	// info about the celement	
	static public				$m_clsattributes = NULL;		// stores all the class attributes of this class
	
	//-------------------------------------------------
	// name: CElementAttributes()
	// desc: constructor
	//-------------------------------------------------
	public function 	CElementAttributes(){ 
		$this->m_attr 	= new CAttributes();
		$this->m_info 	= new CAttributes();
		$this->m_css 	= new CCSSAttributes();
		$this->m_icss 	= new CCSSAttributes();
		$this->m_pcss	= NULL;
		$this->m_event 	= new CEventAttributes();
		$this->m_prop 	= new CPropertyAttributes();
		$this->m_uprop 	= new CUnModifiedPropertyAttributes();
		$this->m_attr->setCElement( $this );
		$this->m_css->setCElement( $this );
		$this->m_event->setCElement( $this );
		$this->m_prop->setCElement( $this );
	} // end CElementAttributes()
	
	//-------------------------------------------------------
	// name: create()
	// desc: creates the element attribute object
	//-------------------------------------------------------
	public function create( $param ){
	} // end create()
	
	//-------------------------------------------------------
	// name: getElement()
	// desc: returns the element
	//-------------------------------------------------------
	public function getElement(){ 
		return $this; 
	} // end getElement()

	//-------------------------------------------------------------------
	// name: attr(), css(), event(), on(), fire(), clearevent(), prop() 
	// desc: sets related properites and behaviors of this element
	//-------------------------------------------------------------------
	public function 	attr(){ $ret = call_user_func_array(array($this->m_attr,"attr"), func_get_args()); if( func_num_args() == 1 ) return $ret; return $this; }
	public function 	css(){ $ret = call_user_func_array(array($this->m_css,"attr"), func_get_args()); if( func_num_args() == 1 ) return $ret; return $this; }
	public function 	event( $strname, $value="" ){ return $this->m_event->addHandler( $strname, $value ); }
	public function 	on( $strname, $value="" ){ return $this->m_event->addHandler( $strname, $value ); }
	public function		off(){}
	public function		fire( $streventname ){}
	public function		clearevent( $streventname ){}
	public function		prop( $strname, $value="" ){ $ret = call_user_func_array(array($this->m_prop,"attr"), func_get_args()); if( func_num_args() == 1 ) return $ret; return $this; }
	
	public function		printbr($str){ printbr(str); }
	public function		_echo($str){ print(str); }
	
	
	//--------------------------------------------------------------
	// name: other
	// desc: sets related properites and behaviors of this element
	//--------------------------------------------------------------
	public function		propref( $strname, $refvalue ){}
	public function		uprop( $strname, $value="" ){ $ret = call_user_func_array(array($this->m_uprop,"attr"), func_get_args()); if( func_num_args() == 1 ) return $ret; return $this; }
	public function		info(){ $ret = call_user_func_array(array($this->m_info,"attr"), func_get_args()); if( func_num_args() == 1 ) return $ret; return $this; }
	public function 	icss(){ $ret = call_user_func_array(array($this->m_icss,"attr"), func_get_args()); if( func_num_args() == 1 ) return $ret; return $this; }
	public function 	ievent( $strname, $value="" ){ return $this->m_ievent->addHandler( $strname, $value ); }
	public function 	sevent( $strname, $value="" ){}
	public function		tween(){}
	
	//--------------------------------------------------------------
	// name: id(), classes(), addClass(), hasClass(), removeClass() 
	// desc: other
	//-------------------------------------------------------------
	public function 	id(){ return ( func_num_args() == 0 ) ? $this->attr("id") : $this->attr("id",func_get_arg(0)); }	
	public function		classType(){ return $this->attr("classtype"); }	
	public function 	classes(){ return ( func_num_args() == 0 ) ? $this->attr("class") : $this->attr("class",func_get_arg(0));  }
	public function 	addClass( $value ){ if( $this->hasClass( $value ) ){ return $this;} return $this->classes( $this->classes() . " " . trim( $value ) ); } 
	public function 	hasClass( $value ){ return ( strpos( $this->classes(), $value ) != FALSE ); }
	public function		removeClass( $value ){ return $this->classes( trim( str_replace( trim( $value ), "", $this->classes() ) ) ); }
	public function		toggleClass( $value ){ return $this->classes( trim( str_replace( trim( $value ), "", $this->classes() ) ) ); }
	public function		replaceClass( $value ){ return $this->classes( trim( str_replace( trim( $value ), "", $this->classes() ) ) ); }
	
	//-------------------------------------------------------------
	// name: onload(), onunload(), onresize(), onready()
	// desc: event handlers that can be overridden
	//-------------------------------------------------------------
	public function 	onload(){ /*alert("running onload() from jscript");*/ }
	public function 	onunload(){ /*alert("running onunload() from jscript");*/ }
	public function 	onresize(){ /*alert("running onresize() from jscript");*/ }
	public function 	onready(){ /*alert("running onready() from jscript");*/ }
	
	//------------------------------------------------------------
	// name: other 
	// desc: helpers that return jquery, mootools, yui objects
	//------------------------------------------------------------
	public function 	getEventHandlers( $strevent ){}
	public function 	jq( $param ){}
	public function 	jquery( $param ){}
	public function 	mt( $param ){}
	public function 	mootools( $param ){}
	public function 	yui( $param ){}
	public function		toString(){ return $this->m_attr->toString() . $this->m_css->toString() . $this->m_event->toString(); }
	
	//--------------------------------------------------------------------
	// name: pcss()
	// desc: sets the pseudo css for a given element like element:hover
	//--------------------------------------------------------------------
	public function pcss($pseudo){
		if( $pseudo == "" || $pseudo == NULL )
			return $this;
		if( $this->m_pcss == NULL )
			$this->m_pcss = array();
		if( isset( $this->m_pcss[$pseudo] ) == false )
			$this->m_pcss[$pseudo] = new CCSSAttributes();
		if( func_num_args() > 2 )
			$args = array( func_get_arg(1), func_get_arg(2) );
		else $args = array( func_get_arg(1) );
		$ret = call_user_func_array( array($this->m_pcss[$pseudo],"attr"), $args ); 
		if( func_num_args() == 2 ) 
			return $ret;
		return $this; 
	} // end pcss()
	
	//---------------------------------------------------------------
	// name: toStringPsuedoCSS()
	// desc: returns a string of the element's pseudo element css	
	//---------------------------------------------------------------
	public function 	toStringPseudoCSS(){
		$str = "";
		if( $this->m_pcss != NULL )
			foreach( $this->m_pcss as $name => $css )
				if( $css ) 
					$str .= "#{$this->id()}:$name{".$css->toString()."}\n";
		return $str;
	} // end toStringPsuedoCSS()	
} // CElementAttributes

//-----------------------------------------------------------
// name: css()
// desc: sets the css of the class
// example: css("celement", name, value)
// example: setting - css( "CElement", name, value )
// example: getting - css( "CElement", name ) 
//-----------------------------------------------------------
function css( $strclassname, $strname, $value ){ 
	if( CElementAttributes::$m_clsattributes && isset( CElementAttributes::$m_clsattributes[ $strclassname ] ) ) 
		return CElementAttributes::$m_clsattributes[ $strclassname ]->attr( $strname, $value ); 
} // end css() 
