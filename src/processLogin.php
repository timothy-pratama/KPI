<?php
    session_start();

    require_once ('script/cookie_helper.php');

    $csrf_token = htmlspecialchars($_POST['csrf_token']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $remember = htmlspecialchars($_POST['rememberMe']);
    $captcha = htmlspecialchars($_POST['captcha']);

    if($csrf_token != $_SESSION['csrf_token'])
    {
        echo 'csrf_token_mismatch';
        exit();
    }

    if($captcha != $_SESSION['captcha']['code'])
    {
        exit('wrong_captcha');
    }

    // MySQL config
    $dbhost = 'localhost';
    $dbname = 'root';
    $dbpass = '';
    $dbtable = 'simpleblog';

    //create connection
    $connection = new mysqli($dbhost, $dbname, $dbpass, $dbtable);

    //check connection
    if($connection->connect_error)
    {
        die('koneksi gagal: '.$connection->connect_error);
    }

    $query = $connection->prepare('SELECT * FROM user WHERE username = ?');
    $query->bind_param('s', $username);

    $query->execute();
    $result = $query->get_result();

    if($result->num_rows === 0)
    {
        echo 'fail';
    }
    else
    {
        $user = $result->fetch_assoc();
        $hashed_password = $user['password'];
        $user_id = $user['id'];
        if($password === $hashed_password)
        {
            if($remember === 'true')
            {
                $rememberToken = uniqid();
                $rememberToken = hash('sha256',$rememberToken);

                $query = $connection->prepare("UPDATE user SET rememberToken = ? WHERE id = ?");
                $query->bind_param('si',$rememberToken, $user_id);
                $query->execute();

                addCookie("rememberToken", $rememberToken);

                $connection->close();
            }
            echo 'ok';

            session_destroy();
            session_start();
            $_SESSION['login'] = $user;
        }
        else
        {
            echo ('fail');
        }
    }

?>