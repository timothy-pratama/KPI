<?php
    session_start();

    $csrf_token = hash('sha256',uniqid());
    $_SESSION['csrf_token'] = $csrf_token;

    $base_salt = hash('sha256', uniqid());
    $_SESSION['base_salt'] = $base_salt;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Simple Blog - Register</title>

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="assets/css/styleRegister.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/sha256.js"></script>
</head>

<body>
<div class="container">
    <div class="top">
        <h1 id="title" class="hidden"><span id="logo"><span>Simple Blog</span></span></h1>
    </div>
    <div class="login-box animated fadeInUp">
        <div class="box-header">
            <h2>Register</h2>
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
            <label for="confirmPassword">Confirm Password</label>
            <br/>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            <br/>
            <button type="submit" onclick="validatePasswordAndRegister('<?php echo $base_salt ?>')">Register</button>
            <br/>
            <input type="hidden" id="csrftoken" name="csrftoken" value="<?php echo $csrf_token?>">
        </form>
    </div>
</div>
</body>

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