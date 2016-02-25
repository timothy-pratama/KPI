<?php
	session_start();
	include ('script/tanggal_indonesia.php');

	$dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="simpleblog";
	$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(mysqli_connect_errno()){
		die("Koneksi ke Database gagal : ".mysqli_connect_errno()
			." (". mysqli_connect_errno()." )");
	}

	$id=htmlspecialchars($_GET['ID']);

	$query=$connection->prepare("SELECT * FROM comment WHERE posting_id = ?");
	$query->bind_param('i', $id);
	$query->execute();
	$results=$query->get_result();

	while($result=mysqli_fetch_assoc($results)){
		echo "
			<li class='art-list-item'>
                <div class='art-list-item-title-and-time'>
                    <h2 class='art-list-title'><a href='#'>".$result['nama']."</a></h2>
                    <div class='art-list-time'>".tanggalIndonesia($result['tanggal'])."</div>
                </div>
                <p>".$result['komentar']."</p>
		";
	}

	mysqli_close($connection);

?>