<?php
    $username = htmlspecialchars($_POST['username']);
    $connection = new mysqli('localhost', 'root', '', 'simpleblog');
    if($connection->connect_error)
    {
        die('Koneksi ke database gagal: ' . $connection->connect_error);
    }

    $query = $connection->prepare('SELECT * FROM user WHERE username = ?');
    $query->bind_param('s', $username);
    $query->execute();
    $result = $query->get_result();

    $connection->close();

    if($result->num_rows == 0)
    {
        exit('fail');
    }
    else
    {
        exit($result->fetch_assoc()['baseSalt']);
    }
?>