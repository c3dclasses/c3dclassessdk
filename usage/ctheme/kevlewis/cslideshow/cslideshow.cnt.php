<?php
//------------------------------------------------------------------------
// name: cslideshow.php
// desc: displays a content gallery for a widget
//------------------------------------------------------------------------

// includes
include_css( relname( __FILE__ ) ."/cslideshow.css" );
include_js( relname( __FILE__ ) ."/cslideshowcontrol.js" );
includecontent( "CSlideShow" );
//includecontentdata( "cslideshow_data" ); 
//includecontenttemplate( "cslideshow_template" ); 

//------------------------------------------------------------------------
// name: CSlideShow
// desc: displays a interactive gallery of content
//------------------------------------------------------------------------
class CSlideShow extends CContent{
	public function CSlideShow(){ 
		parent::CContent();
		$this->event("oncelementload", "CSlideShow.load");
	} // end CSlideShow()
	
	public function init(){
		$ccontrol = $this->getCWidgetInstance()->getCControls();
		$width = $ccontrol->option("width");
		$height = $ccontrol->option("height");
 		$this->css("width", $width);
		$this->css("height", $height);
		$this->css("position", "relative");
		/*$this->css("display","none");*/
	} // end init()
	
	public function load(){
$str = <<<SCRIPT
var id = this.id();
this.m_cslideshow=new CSlideShowControl( id, "#" + id + " .{$class}-slide" );
this.m_cslideshow.start();
this.css("display","block");
alert("loaded the slide show object");
SCRIPT;
		return $str;
	} // end load()

	public function innerhtml(){	
		//$template = $this->getTemplate();
		//$data = $this->getData();
		//if( $data == NULL || $template == NULL )
		//	return;	
		//ob_start();
		//cslideshow_data( $this );
		//$data = $this->m_data;
		//$class = strtolower( get_class( $this ) );
		//foreach( $data->{'list'} as $slide )
		//{
		//	echo "<div class=\"$class-slide\">";
		//	//$template( $slide );	
		//	$this->echotemplate( $template, $slide );
		//	echo "</div><!-- end $class-slide -->";
		//} // end foreach()
		//$str = ob_end();
		//return $str;
$str = <<<HTML
	<b>inside CContent object method</b>
HTML;
		return $str;
	} // end innerhtml()		
	
	public function admin_body(){
		$ccontrol = $this->getCWidgetInstance()->getCControls();
		echo "<p>";
		echo $ccontrol->label("Category ID: ", "catid");	// get the catgories as a list
		echo $ccontrol->text("catid", "");
		echo "</p>";
		echo "<p>";
		echo $ccontrol->label("Width", "width");
		echo $ccontrol->text("width", "");
		echo "</p>";
		echo "<p>";
		echo $ccontrol->label("Height", "height");
		echo $ccontrol->text("height", "");
		echo "</p>";	
	} // end admin_body()
} // end CSlideShow

////////////////////////////////////
///////////////////////////////////

/*
//-----------------------------------------------------------
// name: cslideshow_data()
// desc: sets up the data to be displayed by the template
//-----------------------------------------------------------
function cslideshow_data( $ccontent )
{
	if( $ccontent == NULL )
		return NULL;
	global $post;
	$cwi = $ccontent->getCWidgetInstance();	
	$icatid = $cwi->option("catid");
	query_posts( array('cat'=>$icatid,'order'=>'DESC','posts_per_page'=>-1) );
	if( have_posts() == false )
		return NULL;
	$data=NULL;
	$list=NULL;
	while( have_posts() ) : the_post(); 
		$img = get_post_meta( $post->ID, "image", true );
		$entry = new CDataEntry();
		$entry->{'image'} = $img;
		$entry->{'title'} = get_the_title();
		$entry->{'link'} = get_permalink();
		$entry->{'desc'} = get_the_excerpt();
		$list[] = $entry;
	endwhile;
	$data = new CData();
	$data->{"list"} = $list;
	$ccontent->m_data = $data;
	return $data;
} // end cslideshow_data()

//-----------------------------------------------------------
// name: cslideshow_template()
// desc: 
//-----------------------------------------------------------
function cslideshow_template( $entry )
{
?>
<style>
.info p{ font-size: 14px; line-height:20px; }
.ss-title
{    
	color: #6F4256;
    font-family: 'Segoe UI',Arial,Sans-Serif;
    font-weight: normal;
	font-size: 30px;
	line-height:36px;
	margin-top:50px;
	margin-bottom:20px;
}

.info .details
{
	background: url("http://img1.imagesbn.com/pImages/resources/gateway/2011/dev/blue_carot_link.png") no-repeat scroll right center transparent;
    color: #3169A8;
    float: right;
    font-size: 16px;
    margin: 8px 0 0;
    padding: 0 8px 0 0;
    text-decoration: none;
}

.info .details a
{
	font-size: 16px; 
}
</style> 
<div style="float: left; width: 30%; height: 100%;margin-left:20px; margin-top:10px" align="center">
	<img  style="float:right; margin-left: 20px; margin-right:20px;" src="<?php echo $entry->{'image'}; ?>">
</div>
<div class="info" style="float: left; width: 50%; height: 100%;">
	<h1 class="ss-title"><?php echo $entry->{'title'}; ?></h1>
	<?php echo $entry->{'desc'}; ?>
    <br />
    <br />
    <span class="details"><a href="<?php echo $entry->{'link'} ?>">Details</a></span>
</div>
<?php
} // end cslideshow_template()
*/
?>