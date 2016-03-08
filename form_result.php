<?php
$msg = "";
if(isset($_GET["msgtype"])){
	$msgtype = $_GET["msgtype"];
	if($msgtype == 1){
		$msg = 'Thank you for submitting<br />your information.<br /><span style="color:#d52124">Good Luck!</span>';
	}else if($msgtype == 2){
		$msg = 'You have been opted out<br />of the Send &amp; Score<br />Sweepstakes.';
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>NBC Survey Form</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body style="margin:0; padding:0">

<div id="result_msg_container">
    <p class="result_msg"><?=$msg?></p>
</div>

</body>
</html>