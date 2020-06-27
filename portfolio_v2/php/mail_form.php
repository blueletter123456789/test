<?php

	$name = $_POST["name"];	
	$mail = $_POST["mail"];	
	$tel = $_POST['tel'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];

	$name = htmlspecialchars($name, ENT_QUOTES);
	$mail = htmlspecialchars($mail, ENT_QUOTES);
	$tel = htmlspecialchars($tel, ENT_QUOTES);
	$subject = htmlspecialchars($subject, ENT_QUOTES);
	$message = htmlspecialchars($message, ENT_QUOTES);

	header('Location:http://localhost/github/portfolio_v2/index.html')
?>
