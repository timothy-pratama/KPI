 <?php

	$dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="simpleblog";
	$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(mysqli_connect_errno()){
		die("Koneksi ke Database gagal : ".mysqli_connect_errno()
			." (". mysqli_connect_errno()." )");
	}

	$id = $_GET['ID'];
	$nama = $_GET['nama'];
	$komentar = $_GET['komentar'];

	$query="INSERT INTO `comment` (id, nama, komentar) VALUES ('{$id}', '{$nama}', '{$komentar}')";
	$hasil=mysqli_query($connection,$query);
	if($hasil){
	
	}
	else{
		die("Database query failed");
	}

	$query2="SELECT * FROM `comment` WHERE id=$id";
	$results=mysqli_query($connection,$query2);
	while($result=mysqli_fetch_assoc($results)){
		echo "
			<li class='art-list-item'>
                <div class='art-list-item-title-and-time'>
                    <h2 class='art-list-title'><a href='#'>".$result['nama']."</a></h2>
                    <div class='art-list-time'>2 menit lalu</div>
                </div>
                <p>".$result['komentar']."</p>
		";
	}

	mysqli_close($connection);
 ?>