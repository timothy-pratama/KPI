<?php
	session_start();

	$params = session_get_cookie_params();
	setcookie("PHPSESSID", session_id(), 0, $params["path"], $params["domain"], true, true);

	$csrf_token = uniqid();
	$_SESSION['csrf_token'] = $csrf_token;

	if(isset($_COOKIE['rememberToken']))
	{
		header('location: processCookieLogin.php');
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Simple Blog - Login</title>

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="assets/css/styleLogin.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="top">
			<h1 id="title" class="hidden"><span id="logo"><span>Simple Blog</span></span></h1>
		</div>
		<div class="login-box animated fadeInUp">
			<div class="box-header">
				<h2>Log In</h2>
			</div>
			<form method="post" onsubmit="return false;">
				<label for="username">Username</label>
				<br/>
				<input type="text" id="username" name="username" required>
				<br/>
				<label for="password">Password</label>
				<br/>
				<input type="password" id="password" name="password" required>
				<br/>
				<button type="submit" onclick="doLogin()">Sign In</button>
				<br/>
				<br/>
				<label for="rememberMe">
					<input id="rememberMe" type="checkbox" value="remember" name="remember"> Remember Me
				</label>
				<br/>
				<p>Don't have account yet? <a href="registerForm.php"><b>Sign Up</b></a></p>
				<input type="hidden" id="csrf_token" value="<?php echo $csrf_token ?>">
			</form>
		</div>
	</div>
</body>

<script type="text/javascript" src="assets/js/sha256.js"></script>
<script type="text/javascript" src="assets/js/function.js"></script>

<script>
	$(document).ready(function () {
    	$('#logo').addClass('animated fadeInDown');
    	$("input:text:visible:first").focus();
	});
	$('#username').focus(function() {
		$('label[for="username"]').addClass('selected');
	});
	$('#username').blur(function() {
		$('label[for="username"]').removeClass('selected');
	});
	$('#password').focus(function() {
		$('label[for="password"]').addClass('selected');
	});
	$('#password').blur(function() {
		$('label[for="password"]').removeClass('selected');
	});
</script>

</html>