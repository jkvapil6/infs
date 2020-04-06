

<?php include 'model/search.php';?>

<?php
  include_once 'core/init.php';
  include 'model/articles.php';
  $db = new Database();
  session_start();
?>

<!DOCTYPE html>
<html lang="cs">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="infs project">
    <meta name="keywords" content="infs project, web-dev course">
    <meta name="author" content="Jan Kvapil">
    <title>infs</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/lightbox.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
    <script type="text/javascript" src="../js/lightbox-plus-jquery.js"></script>

  </head>
  <body>
    <div class="container">

    		<header class="post-main-header">


          <nav>
            <a class="logo" href="../index.php"><img src="../img/post-page/logo.png" alt="logo"></a>
            <a class="search" href="../search"><img src="../img/search-btn.png" alt="search"></a>
            <ul>
              <li><a href="../category/food-n-health">Post &amp; Pages</a></li>
              <li><a href="../category/food-n-health">Health</a></li>
              <li><a href="../category/lifestyle">Lifesyle</a></li>
              <li><a href="../category/sports">Sport</a></li>
              <li><a href="../category/world">World</a></li>
              <li><a href="../index.php">Home</a></li>
            </ul>
          </nav>
          <section class="heading">
            <nav>
              <h1>Post Page</h1>
              <p>
                <?php
                $uri = $_SERVER['REQUEST_URI'];
                $escaped_uri = htmlspecialchars( $uri, ENT_QUOTES, 'UTF-8' );
                $arr = explode("/", $escaped_uri);

                $i = 0;
                $len = count($arr);
                foreach ($arr as $item) {
                    if (($i == 0) || ($i == $len - 1)) {
                      if (($i == $len - 1) && isset($_GET['id'])) {
                        $res = getArticleById($db, $_GET['id']);
                        $article = $res->fetch_assoc();
                        echo "<span>" . $article['title'] . "</span>";
                      } else {
                        echo $item;
                      }
                    } else {
                      echo $item . " / ";
                    }
                    $i++;
                }
                 ?>
              </p>
            </nav>
          </section>
        </header>
        <div class="page">
          <a class="scroll-top" onclick="scrollUp()"><img src="../img/up-arrow.svg" alt="up"></a>
          <script type="text/javascript">
            function scrollUp() {
              $(document).ready(function(){
                 $("html, body").animate({ scrollTop: 0 }, 200);
              });
            }
          </script>
