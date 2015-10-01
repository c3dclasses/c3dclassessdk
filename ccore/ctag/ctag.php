<?php
//---------------------------------------------------
// file: ctag.php
// desc: 
//---------------------------------------------------

//----------------------------------------
// name: CTag
// desc: defines a tag object
//----------------------------------------
class CTag{
    // members
    public $m_name;				// stores the tag name
    public $m_attributes;		// stores the tag attributes
    public $m_body;				// stores the tag body
    public $m_id;				// stores the id
    static public $m_counter=0;	// stores a counter value to determine id
	static public $m_rest;		// stores the rest of the nonextracted content
   
    // constructor
    public function CTag(){
        $this->m_id = CTag :: $m_counter++;
    } // CTag
   
   	public function getName(){
        return $this->m_tagname;
    } // end getName()
	
	public function getBody(){
        return $this->m_body;
    } // end getBody()
    
	public function getID(){
        return $this->m_tagname . "_" . $this->m_id;
    } // end getID()
   	
	public function getAttribute( $strname ){
		return ($this->m_attributes && isset($this->m_attributes[$strname])) ? $this->m_attributes[$strname] : "";
	} // end getAttribute()
   	
	public static function getRest(){ 
		return CTag :: $m_rest;
	} // end getRest()

	public static function extractFromString( $tagname, $stringtoextract, $strbextractcallback="" ){
        if( $tagname == "" || $stringtoextract == "" || trim( $stringtoextract ) == "" ) 
			return NULL;
		$dom = new DOMDocument( "1.0", "ISO-8859-15" );
		if( @$dom->loadHTML( $stringtoextract ) == false )
			return NULL;
		$nodes = $dom->getElementsByTagName($tagname);
        $doc = $dom->documentElement;
		$ctags = array();   
        if( $strbextractcallback != "" && function_exists( $strbextractcallback ) == false )
			$strbextractcallback = "";
		$nodesToRemove=NULL;
		foreach ($nodes as $node){
            $attributes=NULL;   
			if($node->hasAttributes()){
                foreach ($node->attributes as $attr)
                	$attributes[$attr->nodeName] = $attr->nodeValue;
		    } // end if
            $ctag = new CTag();
            $ctag->m_tagname = $tagname;
            $ctag->m_body = $node->nodeValue;
            $ctag->m_attributes = $attributes;
            if( $strbextractcallback != "" && $strbextractcallback( $ctag ) == false )
				continue;
			$ctags[] = $ctag;
        	$nodesToRemove[] = $node;
		} // end foreach
	   	if( $nodesToRemove )
			foreach( $nodesToRemove as $domElement )
  				$domElement->parentNode->removeChild($domElement);
		if( preg_match('/<boby>(?P<contents>.*)<\/body>/is', $dom->saveHTML(), $matches ) == 1 )
				CTag :: $m_rest = $matches["contents"]; 
		//$node = ( $element = $dom->getElementsByTagName( "body" ) ) ? $element->item(0) : NULL;
		//CTag :: $m_rest = $dom->saveHTML( $node );
		return $ctags;   
    } // end extractFromString()
   
    public static function explodeString( $tagname, $stringtoexplode, $badddelimiters=true ){   
        $strtag = '/(?P<scontents>.*)?(?P<tag><'.$tagname.'.*>.*<\/'.$tagname.'>)(?P<econtents>.*)?/is';   
        $arr = NULL;
        if( preg_match( $strtag, $stringtoexplode, $matches ) == 0 ){
            $arr[] = $stringtoexplode;
            return $arr;
        } // end if
        if( isset( $matches['scontents'] ) && $matches['scontents'] != "" )
            $arr = array_merge( ($arr)?$arr:Array(), CTag :: explodeString( $tagname, $matches['scontents'] ) );
        if( isset( $matches['tag'] ) && $matches['tag'] != "" )   
            $arr[] = $matches['tag'];
        if( isset( $matches['econtents'] ) && $matches['econtents'] != "" )   
            $arr[] = $matches['econtents'];
        return $arr;
    } // explodeString()
	
	//////////////////////////////
	// optimization
	
	// members
	static protected $m_dom = NULL;		// the dom object
	static protected $m_tag = NULL; 	// the tag that contains the tags to optimize
	static public $m_params = NULL; 	// the optimization params 
	
	//--------------------------------------------------------------------
	// name: clear()
	// desc: clears any caches files relating to any optimizations
	//--------------------------------------------------------------------
	public function optimize_clear( $strfilepath ){
		unlink( $strfilepath );
	} // end clear()
	
	//--------------------------------------------------------------------
	// name: optimize_start()
	// desc: starts to optimize html content within a tag
	//--------------------------------------------------------------------
	public static function optimize_start( $strhtml, $strtag="" ){
		CTag :: $m_dom = NULL;
		if( !$strhtml || !($dom = new DOMDocument()) || !($dom->loadHTML($strhtml)))
			return false;
		CTag :: $m_dom = $dom;
		CTag :: $m_tag = ( $strtag && ( $element = $dom->getElementsByTagName( $strtag ) ) ) ? $element->item(0) : NULL;
		return true;
	} // end optimimize_start()
	
	//---------------------------------------------------------------------------------------
	// name: optimize_end()
	// desc: stops to optimize html content within a tag and returns the content as a string
	//---------------------------------------------------------------------------------------
	public static function optimize_end(){
		$dom = CTag :: $m_dom;
		$tag = CTag :: $m_tag;
		if($dom) $strhtml = $dom->saveHTML($tag);
		CTag :: $m_dom = NULL;
		CTag :: $m_tag = NULL;
		CTag :: $m_params = NULL;
		return $strhtml;
	} // end optimize_end()
	
	//--------------------------------------------------------------------------------------
	// name: optimize_init_params()
	// desc: initializes the parameters that are pass in to default value if not exist
	// 		params(
	//				strfilepath=>
	//				fnfilterurls=>
	//				fncreatenode=>
	//				bcache=>
	//				btop=>
	//			)
	//--------------------------------------------------------------------------------------
	protected static function optimize_init_params( $params ){
		CTag :: $m_params = NULL;
		if( !$params )
			return false;
		if( /*!$isset( $params["fnfilterurls"] ) ||*/
			!function_exists( $params["fnfilterurls"] ) ||
			/*!$isset( $params["fncreatenode"] ) ||*/
			!function_exists( $params["fncreatenode"] ) )
			return false;		
		if( !isset( $params["bcache"] ) )
		 	$params["bcache"] = false;
		if( !isset( $params["btop"] ) )
		 	$params["btop"] = false;
		CTag :: $m_params = $params;	
		return true;
	} // end optimize_init_params()
	
	//-------------------------------------------------------------
	// name: optimize_tags()
	// desc: optimizes the tags within 
	//-------------------------------------------------------------
	public static function optimize_tags( $strfilepath, $params ){
		$dom = CTag :: $m_dom;
		$tag = ( CTag :: $m_tag ) ? ( CTag :: $m_tag ) : $dom;	
		$params["strfilepath"] = $strfilepath;	
		if( $strfilepath == "" || !$dom || !(CTag :: optimize_init_params( $params )) )
			return false;		
		$strurls = call_user_func( CTag :: $m_params["fnfilterurls"], $dom );
		if( !$strurls )
			return false;
		if( ( file_exists( $strfilepath ) == FALSE || CTag :: $m_params["bcache"] == false ) )
			CTag :: optimize_urls( $strurls );		
		$node = call_user_func( CTag :: $m_params["fncreatenode"], $dom );
		if( !$node )
			return false;
		if( CTag :: $m_params["btop"] == true && $tag->firstChild )
			$tag->insertBefore( $node, $tag->firstChild );
		else $tag->appendChild( $node );
		return true;
	} // end optimize_tags()
	
	//---------------------------------------------------------------------------------------
	// name: optimize_js()
	// desc: optimizes the javascript tags containing src urls
	//---------------------------------------------------------------------------------------
	public static function optimize_js( $strfilepath, $btop=false, $bcache=false ){
		CTag :: optimize_tags( $strfilepath, array( "btop"=>$btop, "bcache"=>$bcache, 
									   "fncreatenode"=>	"create_script_node_callback",
									   "fnfilterurls"=> "filter_script_urls_callback" ) );
	} // end optimize_js()
	
	//---------------------------------------------------------------------------------------
	// name: optimize_css()
	// desc: optimizes the link tags containing href urls
	//---------------------------------------------------------------------------------------
	public static function optimize_css( $strfilepath, $btop=false, $bcache=false ){
		CTag :: optimize_tags( $strfilepath, array( "btop"=>$btop, "bcache"=>$bcache, 
									   "fncreatenode"=>"create_link_node_callback",
									   "fnfilterurls"=>"filter_link_urls_callback",
									   "fnfiltercontents"=>"filter_contents_callback" ) );		
	} // end optimize_css()
	
	///////////////////////
	// helper methods
	
	//--------------------------------------------------------------
	// name: optimize_urls
	// desc: optimizes the urls by combining and minifying them
	//--------------------------------------------------------------
	protected static function optimize_urls( $strurls ){
		if( !$strurls )
			return false;
		$strcontents = CTag :: combine_urls( $strurls );
		if( $strcontents == "" )
			return false;
		$file = fopen( CTag :: $m_params["strfilepath"], "w" );
		fwrite( $file, $strcontents );
		fclose( $file );
		return true;
	} // optimize_urls()
	
	//------------------------------------------------------------------
	// name: combine_urls()
	// desc: takes all of the urls contents and combines them into one 
	// 		 and returns a string containing combined results
	//------------------------------------------------------------------
	protected static function combine_urls( $strurls ){
		$str = "";
		if(!$strurls)
			return "";
		$fnfiltercontents = CTag :: $m_params["fnfiltercontents"];
		foreach( $strurls as $strurl ){
			$url = parse_url($strurl);
			$strabsurl = ($url["host"]) ? $strurl : ($_SERVER['DOCUMENT_ROOT']."/".$strurl);
			$strcontents = file_get_contents( $strabsurl );
			if( $fnfiltercontents && is_callable( $fnfiltercontents ) )
				$strcontents = $fnfiltercontents( $strurl, $strcontents );
			$str .= $strcontents;
			$str .= "\n";
		} // end foreach
		return $str;
	} // end combine_urls()
	
	//-------------------------------------------------------------------
	// name: geturlfrompath()
	// desc: returns the url for a given file path relative to doc root
	//-------------------------------------------------------------------
	public static function geturlfrompath( $strfilepath ){ 
		return ( ($i = strpos( $strfilepath, $_SERVER['DOCUMENT_ROOT'] ) ) === FALSE ) ?
		"" : substr( $strfilepath, $i + strlen( $_SERVER['DOCUMENT_ROOT'] ) );
	} // end geturlfrompath()
} // end CTag

///////////////////////
// callbacks

//-----------------------------------------------------------
// name: filter_script_urls_callback()
// desc: filters and removesall the script urls
//-----------------------------------------------------------
function filter_script_urls_callback( $dom ){
	if( !$dom || !($elements = $dom->getElementsByTagName("script")) )
		return NULL;	
	$urls=NULL;
	$remove=NULL;
	foreach( $elements as $element ){
		if( $element->getAttribute( "src" ) ){
			$urls[] =  $element->getAttribute( "src" );
			$remove[] = $element;
		} // end if
	} // end foreach()
	if( $remove )
		foreach( $remove as $node )
			$node->parentNode->removeChild( $node );
	return $urls;
} // end filter_script_urls_callback()

//-----------------------------------------------------------
// name: create_script_node_callback()
// desc: creates a scriptnode 
//-----------------------------------------------------------
function create_script_node_callback( $dom ){
	$strfilepath = CTag :: $m_params["strfilepath"];
	if( ( $node = $dom->createElement( "script" ) ) == NULL )
		return NULL;
	$node->setAttribute("src", CTag :: geturlfrompath( $strfilepath ) );
	$node->setAttribute( "type", "text/javascript");
	return $node;
} // end create_script_node_callback()

//---------------------------------------------------------------------
// name: filter_link_urls_callback()
// desc: filters a link nodes containing a reference to a css files
//---------------------------------------------------------------------
function filter_link_urls_callback( $dom ){
	if( !$dom || !($elements = $dom->getElementsByTagName("link")) )
		return NULL;	
	$urls=NULL;
	$remove=NULL;
	foreach( $elements as $element ){
		if( $element->getAttribute( "href" ) && 
			($element->getAttribute( "rel" ) == "stylesheet") ){
			$urls[] =  $element->getAttribute( "href" );
			$remove[] = $element;
		} // end if
	} // end foreach()
	if( $remove )
		foreach( $remove as $node )
			$node->parentNode->removeChild( $node );
	return $urls;
} // end filter_link_urls_callback()

//------------------------------------------------------------------
// name: create_script_node_callback()
// desc: creates a link node containing a reference to a css file
//------------------------------------------------------------------
function create_link_node_callback( $dom ){
	$strfilepath = CTag :: $m_params["strfilepath"];
	if( ( $node = $dom->createElement( "link" ) ) == NULL )
		return NULL;
	$node->setAttribute("href", CTag :: geturlfrompath( $strfilepath ) );
	$node->setAttribute("rel", "stylesheet");
	$node->setAttribute("type", "text/css");
	return $node;
} // end get_script_node_callback()

//------------------------------------------------------
// name: filter_contents_callback()
// desc: 
//------------------------------------------------------
function filter_contents_callback( $strurl, $strcontent ){
	$urls = extract_css_urls( $strcontent );
	if( !$urls )
		return $strcontent;
	$strcsspath = dirname( $strurl );
	$done=NULL;
	if( !$urls || (!$urls["property"] && !$urls["import"]) )
		return $strcontent;
		
	if( $urls["property"] )
	foreach( $urls["property"] as $i => $url ){
		$urlparts = parse_url($url);
		$url2 = ( $urlparts["host"] ) ? $url : ($strcsspath."/".$url);
		if( $done == NULL || isset( $done[$url2] ) == false ){
			$strcontent = str_replace( $url, $url2, $strcontent );
			$done[$url2]=true;
		} // end if
	} // end foreach()
	
	if( $urls["import"] )
	foreach( $urls["import"] as $i => $url ){
		$urlparts = parse_url($url);
		$url2 = ( $urlparts["host"] ) ? $url : ($strcsspath."/".$url);
		if( $done == NULL || isset( $done[$url2] ) == false ){
			$strcontent = str_replace( $url, $url2, $strcontent );
			$done[$url2]=true;
		} // end if
	} // end foreach()
	
	return $strcontent;			
} // end filter_contents_callback()
?>