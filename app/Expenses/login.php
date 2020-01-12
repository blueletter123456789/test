<?PHP


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name=”viewport” content=”width=device-width, initial-scale=1.0″>
	<title>Login page</title>
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
	<link href="https://fonts.googleapis.com/css?family=Long+Cang&display=swap" rel="stylesheet">
</head>
<body>
	<div id="app">
		<div class="title">
			<p>SignIn</p>
		</div>
		<div class="input_box">
			<form>
				<input id="user_id" type="text" name="user_id" placeholder="ID" required>
				<input id="pass" type="password" name="pass" placeholder="PASSWORD" required>
				<input id="button" type="submit" name="button" value="SIGNIN">
			</form>
		</div>
	</div>

	<!--　Vue.js 導入部 -->
	<script src="https://unpkg.com/es6-promise"></script>
	<script src="https://unpkg.com/vue"></script>
	<script src="https://unpkg.com/http-vue-loader"></script>
	<script type="text/javascript" src="JS/main.js"></script>

</body>
</html>