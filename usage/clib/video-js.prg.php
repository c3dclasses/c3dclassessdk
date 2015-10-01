<?php
//---------------------------------------------------------------------------
// name: video-js.prg.php
// desc: demonstates how to use video_js functions
//---------------------------------------------------------------------------

// includes
include_program( "video_js" );

//---------------------------------------------------
// name: video_js
// desc: demonstatrates how to use video_js functions
//---------------------------------------------------
class video_js extends CProgram{
	public function CBaseProgram(){ 
		parent :: CProgram();	
	} // end video_js()
	
	public function c_main(){
return <<<SCRIPT
SCRIPT;
	} // end c_main()
	
	// rendering methods
	public function innerhtml(){
ob_start();
?>	
	<video id="example_video_1" class="video_js vjs-default-skin" controls preload="none" width="640" height="264" poster="<?php echo relname(__FILE__); ?>/oceans-clip.jpg" data-setup="{}">
    	<!--<source src="http://video_js.zencoder.com/oceans-clip.mp4" type='video/mp4' />-->
    	<source src="<?php echo relname(__FILE__); ?>/oceans-clip.webm" type='video/webm' />
    	<!--<source src="http://video_js.zencoder.com/oceans-clip.ogv" type='video/ogg' />
        <source src="http://video_js.zencoder.com/oceans-clip.ogv" type='video/ogg' />-->
    	<track kind="captions" src="demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
  	</video>
<?php  
return ob_end();
	} // end innerhtml()
} // end video_js
?>