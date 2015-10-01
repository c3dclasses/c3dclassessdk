<?php
//------------------------------------------------------------------------------------
// file: celementattributesex.php
// desc: defines set/get methods all the attributes an element can possibly have
//------------------------------------------------------------------------------------

// headers
include_once('celementattributes.php');
include_js(relname(__FILE__).'/celementattributesex.js');

//------------------------------------------------------------------------------------
// class: CElementAttributesEx
// desc:  extends celementattribute and provides extended functionality to do
//  		HTML5, CSS3 and advance javascript stuff
//------------------------------------------------------------------------------------
class CElementAttributesEx extends CElementAttributes{
	
	public function backgroundColor( $strcolor="initial" ){ 
		if(func_num_args()==0) 
			return $this->css("background-color"); 
		$this->css("background-color", $strcolor); 
		return $this;
	}
	
	public function backgroundClip( $strclip="content-box" ){ 
		if(func_num_args()==0) 
			return $this->css("background-clip");
	 	$this->css("background-clip", $clip); 
		return $this; 
	}
	
	public function backgroundAttachment( $strattachment="scroll" ){ 
		if(func_num_args()==0) 
			return $this->css("background-attachment"); 
			$this->css("background-attachment", $clip); 
		return $this; 
	} 
	
	public function backgroundImage( $strurls="none" ){ 
		if( !$strurls || $strurls == "none" ){
			$this->css("background-image", "none" );
			return $this;
		} // end if
		if(func_num_args()==0) 
			return $this->css("background-image"); 	
		if( gettype( $strurls ) == "array" ){
			foreach( $strurls as $i=>$strurl )
				$strurls[$i] = "url(".$strurls[$i].")";
			$strurls = implode(",",$strurls);
		} // end if
		else $strurls = "url(".$strurls.")";
		$this->css("background-image", $strurls ); 
		return $this; 
	} // end 
	
	public function backgroundRepeat( $repeat="initial" ){ 
		if(func_num_args()==0) 
			return $this->css("background-repeat"); 
		$this->css("background-repeat", $repeat); 
		return $this; 
	}
	
	public function backgroundPosition( $position="initial" ){ 
		if(func_num_args()==0) 
			return $this->css("background-position"); 
		$this->css("background-position", $position); 
		return $this; 
	} 
	
	public function backgroundSize( $size="initial" ){ 
		if(func_num_args()==0) 
			return $this->css("background-size"); 
		$this->css("background-size", $size); 
		return $this; 
	} 
	
	public function backgroundOrigin( $origin="initial" ){ 
		if(func_num_args()==0) 
			return $this->css("background-origin"); 
		$this->css("background-origin", $origin); 
		return $this; 
	}
	
	// border image
	public function borderImage( $strprops="" ){ 
		if(func_num_args()==0) 
			return $this->css("border-image"); 
		$this->css("-webkit-border-image",$strprops ); 
		$this->css("-o-border-image",$strprops ); 
		$this->css("border-image",$strprops ); 
		return $this;
	}
	
	public function borderImageSource( $strsource="none" ){ 
		if( !$strsource || $strsource == "none" ){
			$this->css("background-image-source", "none" );
			return $this;
		} // end if
		if(func_num_args()==0) 
			return $this->css("background-image-source"); 
		$this->css("-webkit-border-image-source",$strsource ); 
		$this->css("-o-border-image-source",$source ); 
		$this->css("border-image-source",$source ); 
		return $this;
	}

	public function borderImageSlice( $strslice="initial" ){ 
		if(func_num_args()==0) 
			return $this->css("background-image-slice"); 
		$this->css("-webkit-border-image-slice",$strslice ); 
		$this->css("-o-border-image-slice",$strslice ); 
		$this->css("border-image-slice",$strslice ); 
		return $this;
	}
	
	public function borderImageWidth( $strwidth="1px" ){ 
		if(func_num_args()==0) 
			return $this->css("background-image-slice"); 
		$this->css("-webkit-border-image-slice",$strwidth ); 
		$this->css("-o-border-image-slice",$strwidth ); 
		$this->css("border-image-slice",$strwidth ); 
		return $this;
	}

	public function borderImageOutset( $stroutset="0" ){ 
		if(func_num_args()==0) 
			return $this->css("background-image-slice"); 
		$this->css("-webkit-border-image-slice",$stroutset ); 
		$this->css("-o-border-image-slice",$stroutset ); 
		$this->css("border-image-slice",$stroutset ); 
		return $this;
	}

	public function borderImageRepeat( $strrepeat="stretch" ){ 
		if(func_num_args()==0) 
			return $this->css("background-image-slice"); 
		$this->css("-webkit-border-image-slice",$strrepeat ); 
		$this->css("-o-border-image-slice",$strrepeat ); 
		$this->css("border-image-slice",$strrepeat ); 
		return $this;
	}
	
	// gradient
	public function linearGradient( $strprop ){	
		$strprop2 = str_replace( $strprop, "to", "" );	
		$this->css("background", "-webkit-linear-gradient($strprop2)"); 
		$this->css("background", "-o-linear-gradient($strprop2)"); 
		$this->css("background", "-moz-linear-gradient($strprop2)"); 
		$this->css("background", "linear-gradient($strprop)");
	}

	public function radialGradient( $strprop ){	
		$strprop2 = str_replace( $strprop, "at", "," );	
		$this->css("background", "-webkit-radial-gradient($strprop2)"); 
		$this->css("background", "-o-radial-gradient($strprop2)"); 
		$this->css("background", "-moz-radial-gradient($strprop2)"); 		
		$this->css("background", "radial-gradient($strprop)"); 
	}
	
	public function repeatingRadialGradient( $strprop ){	
		$this->css("background", "-webkit-repeating-radial-gradient($strprop)"); 
		$this->css("background", "-o-repeating-radial-gradient($strprop)"); 
		$this->css("background", "-moz-repeating-radial-gradient($strprop)"); 		
		$this->css("background", "repeating-radial-gradient($strprop)"); 
	}

/*	
	border-image-source 	The path to the image to be used as a border 	
border-image-slice 	The inward offsets of the image-border 	
border-image-width 	The widths of the image-border 	
border-image-outset 	The amount by which the border image area extends beyond the border box 	
border-image-repeat 	Whether the image-border should be repeated, rounded or stretched
	*/
	
	public function borderRadius( $strurl, $loc ){}
	public function textShadow( $hshadow, $vshadow, $blurradius, $color ){}
	public function wordWrap(){}
	
	
	public function translate(){}
	public function rotate( $degree ){}
	public function scale(){}
	public function skew(){}
	public function backfaceCulling(){}
	public function perspective_origin(){}
	public function animate(){} // key frames 
	public function tween(){}
	
	public function transition( $pseudoelement, 
								$property, 
								$to="", 
								$from="", 
								$duration="2s", 
								$timingfunc="linear", 
								$delay="1s" ){
		if( $pseudoelement != "" && $property != "" && $to != "" ) // set up the destination keyframe of the transition for the given propery
			$this->pcss( $pseudoelement, $property, $to );	
		
		if( $from ) // set up the initial keyframe of the transition for the given propery
			$this->css( $property, $from );
		
		// set the transition for this given property
		$transition = NULL;
		if( $property ) $transition[] = $property;
		if( $duration ) $transition[] = $duration;
		if( $timingfunc ) $transition[] = $timingfunc;
		if( $delay ) $transition[] = $delay;
		
		// append the transition 
		$str = $this->css("transition");
		if( $transition ){
			if( $str )
				$str .= ",";
			$str .= implode( " ", $transition );
		} // end if
			
		$this->css("-webkit-transition", $str ); 
 	   	$this->css("transition", $str );
		return $this;
	} // end transition()
	
	public function keyframe( $keyframeid, 
							  $frame, 
							  $name, 
							  $value ){
	} // end keyframe()
	
	public function animation( $keyframeid, 
							   $duration="1s",
							   $timingfunc="linear",
							   $delay="2s",
							   $interation="infinite",
							   $direction="alternate",
							   $playstate="running" ){
						
								   
	} // end animation()
							   
	
	/*
	public function toStringCSSTransitions(){
		$str = "";
		if( $this->$m_csstransitions )
			$str .= implode( ",", $this->m_csstransition )
		
		return ( $this->$m_csstransitions != NULL ) ? ;
	}
	*/
	
	
	
} // CElementAttributesEx