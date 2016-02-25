<?php
	session_start();

	include ('simple-php-captcha.php');
    $_SESSION['captcha'] = simple_php_captcha();

	if(isset($_SESSION['login']))header('location: index.php');
	else if(isset($_COOKIE['rememberToken'])) header('location: processCookieLogin.php');
	else{
		$params = session_get_cookie_params();
		setcookie("PHPSESSID", session_id(), 0, $params["path"], $params["domain"], false, true);

		$csrf_token = hash('sha256',uniqid());
		$_SESSION['csrf_token'] = $csrf_token;
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
                <label for="captcha">Captcha</label>
                <br/>
                <input type="text" id="captcha" name="captcha" required>
                <br/>
                <img src="<?php echo $_SESSION['captcha']['image_src'] ?>">
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