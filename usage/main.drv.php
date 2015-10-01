<?php
//-------------------------------------------------------------
// name: main.drv.php
// desc: defines the html template
//-------------------------------------------------------------

//---------------------------------------------------
// name: main_html
// desc: renders the main html to the browser
//---------------------------------------------------
function main_html($ckernal) {
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Main.php</title>
		<?php if($ckernal) echo $ckernal->head(); // embed and run javascript code ?>
	</head>
	<body>
    	<?php echoAllProgramTypesControl(); ?>
    	<div id="header">
			Header
			<?php if($ckernal) echo $ckernal->headr(); // embed tags ?>
		</div>
		
        <div id="content" ng-app="<?php echo CAngularJS::getApp(); ?>">
			Content
			<?php if($ckernal) echo $ckernal->body(); // embed tags ?>
		</div>
        
        <div id="footer">
			Footer
			<?php if($ckernal) echo $ckernal->footer(); // embed footer belong to an element tags ?>
		</div>
        <?php if($ckernal) echo $ckernal->foot(); // embed and run javascript code ?>
    </body>
</html>
<?php
} // end main_html()

//---------------------------------------------------
// name: echoAllProgramTypesControl()
// desc: echos all the program types in a control
//---------------------------------------------------
function echoAllProgramTypesControl() {
	global $cprogramtypes;
	if($cprogramtypes == NULL || isset($_POST["m_bajax"]) == true)
		return; 
	$cform = new CForm();
	$cform->create();	
	$ccontrols = $cform->getCControls();
	echo $ccontrols->form("cprogramtype","control");
	echo $ccontrols->select("cprogramtype", 1, array_combine($cprogramtypes, $cprogramtypes));
	echo $ccontrols->submit("submit", "submit");
	echo $ccontrols->endform();
	return;
} // end echoAllProgramTypesControl()
?>
