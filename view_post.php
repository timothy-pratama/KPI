<?php
    session_start();

    if(!isset($_SESSION['login']))
    {
        header('location: login.php');
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="Deskripsi Blog">
<meta name="author" content="Judul Blog">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="omfgitsasalmon">
<meta name="twitter:title" content="Simple Blog">
<meta name="twitter:description" content="Deskripsi Blog">
<meta name="twitter:creator" content="Simple Blog">
<meta name="twitter:image:src" content="{{! TODO: ADD GRAVATAR URL HERE }}">

<meta property="og:type" content="article">
<meta property="og:title" content="Simple Blog">
<meta property="og:description" content="Deskripsi Blog">
<meta property="og:image" content="{{! TODO: ADD GRAVATAR URL HERE }}">
<meta property="og:site_name" content="Simple Blog">

<link rel="stylesheet" type="text/css" href="assets/css/screen.css" />
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<title>Simple Blog | Apa itu Simple Blog?</title>


</head>

<body class="default" onload="show_comment(<?php echo $_GET['ID']?>)">
    <?php
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
        $query = $connection->prepare("SELECT * FROM posting WHERE id = ?");
        $query->bind_param('i', $id);
        $query->execute();
        $results=$query->get_result();
        if($results) $result=mysqli_fetch_assoc($results);
        else{
            echo "QUERY FAILED";
        }
    ?>
<div class="wrapper">

<nav class="nav">
    <a style="border:none;" id="logo" href="index.php"><h1>Simple<span>-</span>Blog</h1></a>
    <ul class="nav-primary">
        <li><a href="logout.php">Logout</a></li>
        <li><a href="new_post.php">+ Tambah Post</a></li>
    </ul>
</nav>

<article class="art simple post">
    
    <header class="art-header">
        <div class="art-header-inner" style="margin-top: 0px; opacity: 1;">
            <time class="art-time"><?php echo tanggalIndonesia($result['tanggal'])?></time>
            <h2 class="art-title"><?php echo $result['judul']?></h2>
            <p class="art-subtitle"></p>
        </div>
    </header>

    <div class="art-body">
        <div class="art-body-inner">
            <h3 style="text-align: center;"> <?php echo $result['author'] ?> </h3>

            <img src="<?php echo $result['gambar'] ?>" style="width: 100%" />

            <p style="text-align: justify"><?php echo $result['konten']?></p>
            <hr />
            
            <h2>Komentar</h2>

            <div id="contact-area">
                <form id="comen" method="POST" action="#" onsubmit="return false">
                    <label for="Nama">Nama:</label>
                    <input type="text" name="Nama" id="Nama" disabled value="<?php echo $_SESSION['login']['username'] ?>">

                    <label for="Komentar">Komentar:</label><br>
                    <textarea name="Komentar" rows="20" cols="20" id="Komentar" style="height: 100px"></textarea>
                    <input type="submit" name="submit" value="Kirim" class="submit-button" onclick="comment(<?php echo $_GET['ID']?>)">
                </form>
                <span id="error" style="color:red;"></span>
                <span id="errorEmail" style="color:red;"></span>
            </div>

            <ul id="yeay" class="art-list-body">
            </ul>
        </div>
    </div>

</article>

<footer class="footer">
    <div class="back-to-top"><a href="">Back to top</a></div>
    <!-- <div class="footer-nav"><p></p></div> -->
    <div class="psi">&Psi;</div>
    <aside class="offsite-links">
        Asisten IF3110 /
        <a class="rss-link" href="#rss">RSS</a> /
        <br>
        <a class="twitter-link" href="http://twitter.com/YoGiiSinaga">Yogi</a> /
        <a class="twitter-link" href="http://twitter.com/sonnylazuardi">Sonny</a> /
        <a class="twitter-link" href="http://twitter.com/fathanpranaya">Fathan</a> /
        <br>
        <a class="twitter-link" href="#">Renusa</a> /
        <a class="twitter-link" href="#">Kelvin</a> /
        <a class="twitter-link" href="#">Yanuar</a> /
        
    </aside>
</footer>

</div>
<script type="text/javascript" src="assets/js/ajax.js"></script>
<script type="text/javascript" src="assets/js/fittext.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/respond.min.js"></script>
<script type="text/javascript">
  var ga_ua = '{{! TODO: ADD GOOGLE ANALYTICS UA HERE }}';

  (function(g,h,o,s,t,z){g.GoogleAnalyticsObject=s;g[s]||(g[s]=
      function(){(g[s].q=g[s].q||[]).push(arguments)});g[s].s=+new Date;
      t=h.createElement(o);z=h.getElementsByTagName(o)[0];
      t.src='//www.google-analytics.com/analytics.js';
      z.parentNode.insertBefore(t,z)}(window,document,'script','ga'));
      ga('create',ga_ua);ga('send','pageview');
</script>

</body>
</html>