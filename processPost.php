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
		$judul= htmlspecialchars($_POST["Judul"]);
		$hari= htmlspecialchars($_POST["daydropdown"]);
		$bulan= htmlspecialchars($_POST["monthdropdown"]);
		$bulan=convertmonth($bulan);
		$tahun= htmlspecialchars($_POST["yeardropdown"]);
		$konten= htmlspecialchars($_POST["Konten"]);
		$tanggal = $tahun."-".$bulan."-".$hari;
		$author = $_SESSION['login']['username'];
		$gambar = htmlspecialchars($_POST['gambar']);

		echo $tanggal;
		if(isset($judul) && isset($tanggal) && isset($konten)){
			$query = $connection->prepare("INSERT INTO posting (judul, tanggal, konten, author, gambar) VALUES (?,?,?,?,?)");
			$query->bind_param('sssss',$judul, $tanggal, $konten, $author, $gambar);
			$result = $query->execute();
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