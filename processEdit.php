<?php
	function convertmonth($month){
		if($month=="Jan")return 1;
		else if($month=="Feb")return 2;
		else if($month=="Mar")return 3;
		else if($month=="Apr")return 4;
		else if($month=="May")return 5;
		else if($month=="Jun")return 6;
		else if($month=="Jul")return 7;
		else if($month=="Aug")return 8;
		else if($month=="Sept")return 9;
		else if($month=="Oct") return 10;
		else if($month=="Nov") return 11;
		else if($month=="Dec") return 12;		
	}
?>
<?php
	require_once('uploadPhoto.php');
	session_start();
	if(!isset($_SESSION['login'])){
    	header('location: login.php');
    	exit();
    }
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="";
	$dbname="simpleblog";
	$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(mysqli_connect_errno()){
		die("Koneksi ke Database gagal : ".mysqli_connect_errno()
			." (". mysqli_connect_errno()." )");
	}
	//Check whose post is it
	$query = $connection->prepare("SELECT author FROM posting WHERE id = ? ");
	$query->bind_param('i',$posting_id);
	$result = $query->execute();
	if($result['author']!=$_SESSION['login']['author']) exit('have no authority'); //ingin mengedit post milik orang lain
	if($_POST['csrf_token']!=$_SESSION['csrf_token']) exit('token missmatch');


	if(isset($_POST["submit"])){
		$judul=htmlspecialchars($_POST["Judul"]);
		$hari=htmlspecialchars($_POST["daydropdown"]);
		$bulan=htmlspecialchars($_POST["monthdropdown"]);
		$bulan=convertmonth($bulan);
		$tahun=htmlspecialchars($_POST["yeardropdown"]);
		$konten=htmlspecialchars($_POST["Konten"]);
		$tanggal = $tahun."-".$bulan."-".$hari;
		$posting_id=htmlspecialchars($_GET['ID']);
		$result=uploadPoto();;
		if(isset($judul) && isset($tanggal) && isset($konten)){
			$query = $connection->prepare("UPDATE posting SET tanggal = ?, judul = ?, konten = ?, gambar = ? WHERE id = ?");
			$query->bind_param('ssssi',$tanggal,$judul, $konten, $result[1], $posting_id);
			$result = $query->execute();
			if($result) echo "berhasil";
			else echo "Database query failed";
			header("Location: index.php");
		}
		else header("Location: new_post.php");
	}
	else{//Jika belom disubmit
		header("Location: new_post.php");
	}
	unset($_SESSION['csrf_token']);
	mysqli_close($connection);
?>