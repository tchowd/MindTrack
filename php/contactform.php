<?php

if (isset($_POST['submit'])) {
	$mailfrom = $_POST['first'];
	$body = $_POST['phone'];
	$subject = "MindTrack";

	$mailTo = "cps530@hotmail.com";
	mail($mailTo, $subject, $body);
	header("Location: contactus.php?mailsend");

}
