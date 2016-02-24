<?php
	session_start();

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
	require_once("uploadPhoto.php");
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
	if(isset($_POST["submit"])){
		$judul= htmlspecialchars($_POST["Judul"]);
		$hari= htmlspecialchars($_POST["daydropdown"]);
		$bulan= htmlspecialchars($_POST["monthdropdown"]);
		$bulan=convertmonth($bulan);
		$tahun= htmlspecialchars($_POST["yeardropdown"]);
		$konten= htmlspecialchars($_POST["Konten"]);
		$csrf_token=$_POST["csrf_token"];
		$tanggal = $tahun."-".$bulan."-".$hari;
		$author = $_SESSION['login']['username'];
		if($_SESSION['csrf_token']!=$csrf_token) exit();
		$result=uploadPhoto();
		echo 'jablay';
		if($result[0]){
			if(isset($judul) && isset($tanggal) && isset($konten) && isset($result[1])){
				$query = $connection->prepare("INSERT INTO posting (judul, tanggal, konten, author, gambar) VALUES (?,?,?,?,?)");
				$query->bind_param('sssss',$judul, $tanggal, $konten, $author, $result[1]);
				$result = $query->execute();
				if($result){
					echo "berhasil";
				}
				else{
					die("Database query failed");
				}
				header("Location: index.php");
			}
			else{
				header("Location: new_post.php");
			}
		}else{
			echo "result false";
			header("Location: index.php");
		}
	}
	else{//Jika belom disubmit
		header("Location: new_post.php");
	}
	unset($_SESSION['csrf_token']);
	mysqli_close($connection);
?>