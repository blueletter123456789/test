<?php
session_start();

var_dump($_SESSION);

$session = $_SESSION;

// echo "<br>";
// var_dump($_SERVER);

if(isset($session['LOGIN']) && !empty($session['LOGIN'])){
	if($session['LOGIN'] != 'ok'){
		header('location:http://localhost/github/lesson/form/index.html');
		exit();
	}
	echo 'sessionOK';
}else{
	header('location:http://localhost/github/lesson/form/index.html');
	exit();
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>welcome page</title>
</head>
<body>

<h1>Welcome</h1>

</body>
</html>