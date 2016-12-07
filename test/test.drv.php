<?php
//-------------------------------------------------------------
// name: test.drv.php
// desc: defines the html template
//-------------------------------------------------------------

//---------------------------------------------------
// name: test_html
// desc: renders the test html to the browser
//---------------------------------------------------
function test_html($ckernal) {
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Test.php</title>
		<?php if($ckernal) echo $ckernal->head(); // embed and run javascript code ?>
	</head>
	<body>
    	<div id="header">
			<?php if($ckernal) echo $ckernal->headr(); // embed tags ?>
		</div>		
		<div id="content">
			<?php if($ckernal) echo $ckernal->body(); // embed tags ?>
		</div>
        
        <div id="footer">
			<?php if($ckernal) echo $ckernal->footer(); // embed footer belong to an element tags ?>
		</div>
        <?php if($ckernal) echo $ckernal->foot(); // embed and run javascript code ?>
    </body>
</html>
<?php
} // end main_html()
?>
