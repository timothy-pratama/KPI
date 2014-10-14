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
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="";
	$dbname="simpleblog";
	$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(mysqli_connect_errno()){
		die("Koneksi ke Database gagal : ".mysqli_connect_errno()
			." (". mysqli_connect_errno()." )");
	}
	if(isset($_POST["submit"])){
		$judul=$_POST["Judul"];
		$hari=$_POST["daydropdown"];
		$bulan=$_POST["monthdropdown"];
		$bulan=convertmonth($bulan);
		$tahun=$_POST["yeardropdown"];
		$konten=$_POST["Konten"];
		$tanggal = $tahun."-".$bulan."-".$hari;
		$id=$_GET['ID'];
		if(isset($judul) && isset($tanggal) && isset($konten)){
			$query="UPDATE posting SET";
			$query.=" tanggal='$tanggal', judul='$judul', konten='$konten'";
			$query.=" WHERE id='$id'";
			$result=mysqli_query($connection,$query);
			if($result){
				echo "berhasil";
			}
			else{
				die("Database query failed");
			}
			mysqli_close($connection);
			header("Location: index.php");
		}
		else{
			header("Location: new_post.php");
			die();
		}
	
	}
	else{//Jika belom disubmit
		header("Location: new_post.php");
		die();
	}
?>