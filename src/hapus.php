<?php
    session_start();

	$idPost=htmlspecialchars($_POST["post_id"]);
    $csrf_token = htmlspecialchars($_POST['csrf_token']);

    if($csrf_token != $_SESSION['csrf_token'])
    {
        exit("csrf_token_mismatch");
    }

    // db config
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="";
	$dbname="simpleblog";
	$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(mysqli_connect_errno()){
		die("Koneksi ke Database gagal : ".mysqli_connect_errno()
			." (". mysqli_connect_errno()." )");
	}

    $query = $connection->prepare("SELECT * FROM posting WHERE id = ?");
    $query->bind_param("i", $idPost);
    $query->execute();
    $results = $query->get_result();
    $post_info = $results->fetch_assoc();
    if($_SESSION['login']['username'] != $post_info['author'])
    {
        exit("Unauthorized Delete Post");
    }

    $query = $connection->prepare("DELETE FROM posting WHERE id = ?");
    $query->bind_param('i', $idPost);
    $query->execute();

	mysqli_close($connection);

    $_SESSION['csrf_token'] = hash('sha256', uniqid());
    exit("ok");
?>