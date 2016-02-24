<?php

    session_start();

    if(!isset($_SESSION['login']))
    {
        header('location: login.php');
        exit();
    }

    // connect to DB
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="simpleblog";
    $connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    if(mysqli_connect_errno()){
        die("Koneksi ke Database gagal : ".mysqli_connect_errno()
            ." (". mysqli_connect_errno()." )");
    }

    $id_post = htmlspecialchars($_GET['ID']);
    $query = $connection->prepare("SELECT * FROM posting WHERE id = ?");
    $query->bind_param('i', $id_post);
    $query->execute();

    $result = $query->get_result();
    $posting_data = $result->fetch_assoc();
    if($posting_data['author'] != $_SESSION['login']['username'])
    {
        header('location: index.php');
        exit();
    }

    $csrf_token = hash('sha256',uniqid());
    $_SESSION['csrf_token'] = $csrf_token;
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

<title>Simple Blog | Tambah Post</title>


</head>
<body class="default">
    <?php
        $posting_id=htmlspecialchars($_GET['ID']);
        $query="SELECT * FROM posting WHERE id=$posting_id";
        $query = $connection->prepare("SELECT * FROM posting WHERE id = ?");
        $query->bind_param('i', $posting_id);
        $query->execute();
        $result=$query->get_result();
        if($result) $row=mysqli_fetch_assoc($result);
        else echo 'query gagal';
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
    
    
    <h2 class="art-title" style="margin-bottom:40px">-</h2>

    <div class="art-body" style="top: 35px;">
        <div class="art-body-inner">
            <h2>Edit POST</h2>

            <div id="contact-area">
                <form enctype="multipart/form-data" id="formPost" method="post" action="processEdit.php?ID=<?php echo $posting_id ?>">
                    <label for="Judul">Judul: </label>
                    <input type="text" name="Judul" id="Judul" value="<?php echo $row['judul'] ?>">

                    <label for="Tanggal">Tanggal:</label>
                    <select id="daydropdown" name="daydropdown">
                    </select> 
                    <select id="monthdropdown" name="monthdropdown">
                    </select> 
                    <select id="yeardropdown" name="yeardropdown">
                    </select> 
                    <br><br>
                    <label for="gambar">Gambar:</label>
                    <!-- <img src="<?php echo $row['gambar'] ?>" alt="Some Image" style="width:400px;height:300px;"> -->
                    <input type="file" accept="image/*" id="gambar" name="gambar"></br>
                    <label for="Konten">Konten:</label><br>
                    <textarea name="Konten" rows="20" cols="20" id="Konten"><?php echo $row['konten'] ?></textarea>
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token ?>" />
                    <input type="submit" name="submit" value="Simpan" class="submit-button">
                    <br>
                </form>
            </div>
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
<script type="text/javascript" src="assets/js/date.js"></script>
<script type="text/javascript" src="assets/js/function.js"></script>
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