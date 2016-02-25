 <?php
	session_start();

 	require_once ('script/tanggal_indonesia.php');

	$dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="simpleblog";
	$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(mysqli_connect_errno()){
		die("Koneksi ke Database gagal : ".mysqli_connect_errno()
			." (". mysqli_connect_errno()." )");
	}

	$posting_id = htmlspecialchars($_GET['ID']);
	$nama = htmlspecialchars($_GET['nama']);
	$komentar = htmlspecialchars($_GET['komentar']);
	$tanggal = date('Y-m-d H:i:s');

 	$query = $connection->prepare("INSERT INTO comment (posting_id, nama, komentar, tanggal) VALUES (?,?,?,?)");
 	$query->bind_param('isss',$posting_id,$nama,$komentar, $tanggal);

 $hasil = $query->execute();
	if($hasil){
	
	}
	else{
		die("Database query failed");
	}

 	$query2 = $connection->prepare("SELECT * FROM comment WHERE id = ?");
 	$query2->bind_param('i', $posting_id);
 	$query2->execute();

	$results=$query2->get_result();
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