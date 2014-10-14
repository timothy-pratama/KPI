<?php
	$idPost=$_GET["ID"];
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="";
	$dbname="simpleblog";
	$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(mysqli_connect_errno()){
		die("Koneksi ke Database gagal : ".mysqli_connect_errno()
			." (". mysqli_connect_errno()." )");
	}
	$query="DELETE FROM posting WHERE id=$idPost";
	$result=mysqli_query($connection,$query);
	if($result){
		echo $message;
	}
	else{
		die("Database query failed");
	}
	mysqli_close($connection);
	header("Location: index.php");
?>