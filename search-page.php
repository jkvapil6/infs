

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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/lightbox.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
    <script type="text/javascript" src="js/lightbox-plus-jquery.js"></script>

  </head>
  <body>
    <div class="container">

    		<header class="post-main-header">
          <nav>
            <a class="logo" href="./index.php"><img src="./img/post-page/logo.png" alt="logo"></a>
            <a class="search" href="./search"><img src="./img/search-btn.png" alt="search"></a>
            <ul>
              <li><a href="./category/food-n-health">Post &amp; Pages</a></li>
              <li><a href="./category/food-n-health">Health</a></li>
              <li><a href="./category/lifestyle">Lifesyle</a></li>
              <li><a href="./category/sports">Sport</a></li>
              <li><a href="./category/world">World</a></li>
              <li><a href="./index.php">Home</a></li>
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


<div class="search-page">
  <form class="search-form" method="post">
    <input class="search-input" type="text" autocomplete="off" name="search" placeholder="search.." oninput="getAjaxContent()">
    <button type="submit" name="search-submit-button">search</button>
  </form>

  <ul class='whisperer'></ul>
  <script type="text/javascript" src="js/whisperer.js"></script>

  <section class="searched-articles">
    <?php
      $posts = getSearchedArticles($db);
    ?>
    <?php if($posts) : ?>
      <?php while($row = $posts->fetch_assoc()) : ?>
      <article>
        <img src="<?php echo $row['logo']; ?>" alt="article-img" style="width:260px;height:160px;">
        <header>
          <h4><?php echo $row['category']; ?></h4>
          <h3><?php echo $row['title']; ?></h3>
          <div class='article-info'><?php echo formatDate($row['date']); ?>
            by <span class="by"><?php echo $row['author']; ?></span>
          </div>

          <p><?php echo shortenText($row['body'], 150); ?></p>
        </header>
        <a href="post-page.php?id='.<?php $row['id']; ?>." class="read-more">Read More</a>
      </article>
      <?php endwhile; ?>
    <?php endif;?>
  </section>
</div>

</div>
  </div>
  	<footer>
      <div class="post-footer-content">

				<section class="contact">
					<img class="footer-logo" src="./img/footer/f-logo.png" alt="logo">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at nunc vel est tincidunt porta.</p>
				</section>

				<section class="usefull-links">
					<h2>Usefull Links</h2>
          <ul>
            <li> <a href="#">Home 1</a></li>
            <li> <a href="#">Home 2</a></li>
            <li> <a href="#">Home 3</a></li>
            <li> <a href="#">Home 4</a></li>
            <li> <a href="#">Home 5</a></li>
          </ul>
				</section>

        <section class="follow-us">
					<h2>Follow Us</h2>
          <nav>
            <a href="#"><div class="img-space"><img src="img/post-footer/facebook.svg" alt=""></div>Facebook</a>
            <a href="#"><div class="img-space"><img src="img/post-footer/twitter.svg" alt=""></div>Twitter</a>
            <a href="#"><div class="img-space"><img src="img/post-footer/youtube.svg" alt=""></div>Youtube</a>
            <a href="#"><div class="img-space"><img src="img/post-footer/vimeo.svg" alt=""></div>Vimeo</a>
            <a href="#"><div class="img-space"><img src="img/post-footer/pinterest.svg" alt=""></div>Pinterest</a>
          </nav>

				</section>

				<section class="newsletter">
					<h2>Newsletter</h2>
					<form class="newsletter-form" action="index.php" method="post">
            <input type="text" name="newsletter-input" value="" placeholder="Email">
            <button type="submit" name="button">SUBSCRIBE</button>
          </form>
				</section>

				<div class="copyrights"><p>&copy; Copyright Gomalthemes 2017, All Rights Reserved</p></div>
			</div>
		</footer>
  </body>
</html>
