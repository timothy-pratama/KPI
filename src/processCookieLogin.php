<?php
    session_start();

    require_once ('script/cookie_helper.php');

    $rememberToken = htmlspecialchars($_COOKIE['rememberToken']);

    // MySQL Config
    $host = "localhost";
    $db_username = "root";
    $db_password = "";
    $table = "simpleblog";
    $connection = new mysqli($host, $db_username, $db_password, $table);

    // trying to connect to DB
    if($connection->connect_error)
    {
        die('Koneksi gagal: '.$connection->connect_error);
    }

    $query = $connection->prepare("SELECT * FROM user WHERE rememberToken = ?");
    $query->bind_param('s', $rememberToken);
    $query->execute();

    $result = $query->get_result();

    if($result->num_rows > 0)
    {
        $user = $result->fetch_assoc();
        $user_id = $user['id'];

        // create new session
        session_unset();
        session_destroy();
        session_start();
        session_regenerate_id();
        $_SESSION['login'] = $user;

        // create new cookie
        $newRememberToken = uniqid();
        $hashed_token = hash('sha256', $newRememberToken);

        $query = $connection->prepare("UPDATE user SET rememberToken = ? WHERE id = ?");
        $query->bind_param('si', $hashed_token, $user_id);
        $query->execute();

        $connection->close();
        addCookie('rememberToken', $hashed_token);
        header('location: index.php');
    }
    else
    {
        deleteCookie('rememberToken');
        header('location: login.php');
    }
?>