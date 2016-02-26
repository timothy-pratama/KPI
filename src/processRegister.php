<?php
    session_start();

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $csrf_token = htmlspecialchars($_POST['csrf_token']);
    $base_salt = htmlspecialchars($_POST['session_id']);

    if($csrf_token != $_SESSION['csrf_token'])
    {
        echo('csrf_token mismatch');
        exit();
    }

    if($base_salt != $_SESSION['base_salt'])
    {
        exit('base salt modified!');
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
        $insertQuery = $connection->prepare("INSERT INTO user (username, password, baseSalt) VALUES (?, ?, ?)");
        $insertQuery->bind_param('sss', $username, $password, $base_salt);
        $insertQuery->execute();

        $connection->close();
        echo 'ok';

        $_SESSION['csrf_token'] = hash('sha256',uniqid());
    }
    else
    {
        echo 'fail';
    }
?>
