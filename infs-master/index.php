<?php
  session_start();

  require 'model/articles.php';
  include 'core/init.php';
  $db = new Database();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="infs project">
    <meta name="keywords" content="infs project, web-dev course">
    <meta name="author" content="Jan Kvapil">
    <title>infs</title>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/slider.js"></script>
  </head>
  <body>
  <div class="container">

  	<div class="page">

      <a class="scroll-top" onclick="scrollUp()"><img src="img/up-arrow.svg" alt="up"></a>
      <script type="text/javascript">
        function scrollUp() {
          $(document).ready(function(){
             $("html, body").animate({ scrollTop: 0 }, 200);
          });
        }
      </script>

  		<header class="main-header">
    			<div class="left-nav">
            <?php
            if(isset($_SESSION['user'])) {
              echo "<form class='logout-form' action='model/logout.php' method='post'>
                <button type='submit' name='submit'>Logout</button>
              </form>";
            }
            ?>
            <ul>
              <?php
              if(isset($_SESSION['user'])) {

                if ($_SESSION['super'] > 0) {
                  echo "<li><a href='admin.php'>". $_SESSION['user'] . "</a></li>";
                } else {
                  echo "<li>". $_SESSION['user'] ."</li>";
                }

              } else {
                echo "<li><a href='login.php'>Login</a></li>
                <li><a href='register.php'>Register</a></li>";
              }
              ?>
            </ul>

    			</div>
    			<a class="logo" href="index.php"><img src="img/logo.png" alt="logo"></a>
    			<ul class="right-nav">
				    <li><a href="https://www.instagram.com/"><img src="img/insta.png" alt="insta"></a></li>
            <li><a href="https://www.pinterest.com/"><img src="img/p.png" alt="pinterest"></a></li>
            <li><a href="https://vimeo.com/"><img src="img/vimeo.png" alt="vimeo"></a></li>
            <li><a href="https://www.youtube.com/"><img src="img/yt.png" alt="youtube"></a></li>
            <li><a href="https://twitter.com/"><img src="img/twitter.png" alt="twitter"></a></li>
      			<li><a href="https://www.facebook.com/"><img src="img/fb.png" alt="fb"></a></li>
    			</ul>
  		    <nav class="nav-bar">
    			  <ul class="main-nav">
    				<li><a href="index.php">Home</a></li>
    				<li><a href="category/world">World</a></li>
    				<li><a href="category/sports">Sport</a></li>
    				<li><a href="category/lifestyle">Lifestyle</a></li>
    				<li><a href="category/food-n-health">Health</a></li>
    				<li><a href="category/fashion">Fashion</a></li>
    				<li><a href="category/technology">Technology</a></li>
    				<li><a href="category/technology">Post &amp; Pages</a></li>
            <li><a class="search" href="./search"><img src="img/search-btn.png" alt="submit" /></a></li>
          </ul>
    	   </nav>
     <div class="main-articles">

      <section class="first-article">
        <article>
          <div class="first-article-header">
              <h3 id="slider-h3">World</h3>
              <h2><a id="slider-a" href="post-page.php"></a></h2>
              <p id="slider-p"> time by autor</p>
          </div>
          <img id="slider-img" src="http://via.placeholder.com/500x458" alt="article-img" height="458" width="500">
        </article>
      </section>

      <section class="side-articles">
        <?php

        $posts = getFirstNArticles($db)
        ?>
        <?php if($posts) : ?>
          <?php while($row = $posts->fetch_assoc()) : ?>
          <article>
            <img src="<?php echo $row['logo']; ?>" alt="article-img" width="120" height="80">
            <div class="side-articles-header">
              <h2><a href='<?php echo $row['category'] ?>/<?php echo $row['id'] ?>'><?php echo $row['title']; ?></a></h2>
            </div>
            <div class='article-info'>
              <?php echo formatDate($row['date']); ?>
              by
              <span class="by"><?php echo $row['author']; ?></span>
            </div>
          </article>
          <?php endwhile; ?>
        <?php else : ?>
        <p>There are no posts yet.</p>
        <?php endif;?>
      </section>

      <script>
        next_post();
      </script>

    </div>
  </header>

<main class="main-content">

	<section class="world-news">
		<nav class="world-news-nav">
      <h2>World News</h2>
      <div class="bottom-line"></div>
      <ul class="regions">
        <li><a href="category/World">All</a></li>
        <li><a href="category/Asia">Asia</a></li>
        <li><a href="category/Europe">Europe</a></li>
        <li><a href="category/America">America</a></li>
      </ul>
      <div class="arrows">
        <button class="arrow"><img src="img/left-arrow.png" alt="btn"></button>
        <button class="arrow"><img src="img/right-arrow.png" alt="btn"></button>
      </div>
		</nav>

		<section class="last-3">
      <?php
      $posts = getArticlesByCategory($db,"World", 3);
      ?>
      <?php if($posts) : ?>
        <?php while($row = $posts->fetch_assoc()) : ?>
        <article>
          <header>
            <img src="<?php echo $row['logo']; ?>" alt="article-img">
            <h3><?php echo $row['title']; ?></h3>
            <div class='article-info'>
              <?php echo formatDate($row['date']); ?>
              by <span class="by"><?php echo $row['author']; ?></span>
            </div>
          </header>
          <?php echo shortenText($row['body'], 150); ?>
  				<a href='<?php echo $row['category'] ?>/<?php echo $row['id'] ?>' class="read-more">Read More</a>
        </article>
        <?php endwhile; ?>
      <?php else : ?>
      <p>There are no posts yet.</p>
      <?php endif;?>
		</section>

		<section class="last-4-to-12">
      <?php $posts =  getArticlesByCategory($db,"World", 9, 3); ?>
      <?php if($posts) : ?>
        <?php while($row = $posts->fetch_assoc()) : ?>
        <article>
          <img src="<?php echo $row['logo']; ?>" alt="article-img" style="width:80px;height:80px;">
          <h3><a href='<?php echo $row['category'] ?>/<?php echo $row['id'] ?>'><?php echo $row['title']; ?></a></h3>
          <div class='article-info'>
            <?php echo formatDate($row['date']); ?>
            by <span class="by"><?php echo $row['author']; ?></span>
          </div>
        </article>
        <?php endwhile; ?>
      <?php endif;?>

		</section>
	</section>

	<section class="fashion">
		<header>
      <h2>Fashion</h2>
      <div class="bottom-line"></div>
      <ul class="arrows">
        <li><button class="arrow"><img src="img/right-arrow.png" alt="btn"></button></li>
        <li><button class="arrow"><img src="img/left-arrow.png" alt="btn"></button></li>
      </ul>
    </header>

    <?php $posts =  getArticlesByCategory($db,"Fashion", 3); ?>
    <?php if($posts) : ?>
      <?php while($row = $posts->fetch_assoc()) : ?>
      <article>
        <img src="<?php echo $row['logo']; ?>" alt="article-img">
        <header>
        <h3><?php echo $row['title']; ?></h3>
        </header>
        <div class='article-info'>
        <?php echo formatDate($row['date']); ?>
        by <span class="by"><?php echo $row['author']; ?></span>
        </div>
        <div class="article-body">
         <?php echo shortenText($row['body'], 350); ?>
        </div>
        <a href='<?php echo $row['category'] ?>/<?php echo $row['id'] ?>' class="read-more">Read More</a>
      </article>
      <?php endwhile; ?>
    <?php else : ?>
    <p>There are no posts yet.</p>
    <?php endif;?>
	</section>

	<section class="bottom-boxes">
		<div class="other-categories">

			<section class="lifesyle">
				<header>
          <h2>Lifestyle</h2>
          <div class="bottom-line"></div>
          <ul class="arrows">
            <li><button class="arrow"><img src="img/right-arrow.png" alt="btn"></button></li>
            <li><button class="arrow"><img src="img/left-arrow.png" alt="btn"></button></li>
          </ul>
        </header>

        <?php $posts =  getArticlesByCategory($db,"Lifestyle", 1); ?>
        <?php if($posts) : ?>
          <?php $row = $posts->fetch_assoc() ?>
          <div class="ls-last-article">
            <article>
              <img src="<?php echo $row['logo']; ?>" alt="article-img" width="300" height="300">
              <header>
                <h3><a href='<?php echo $row['category'] ?>/<?php echo $row['id'] ?>'><?php echo $row['title']; ?></a></h3>
                <div class='article-info'>
                  <?php echo formatDate($row['date']); ?>
                  by <span class="by"><?php echo $row['author']; ?></span>
                </div>
              </header>
            </article>
          </div>
        <?php else : ?>
        <p>There are no posts yet.</p>
        <?php endif;?>

        <div class="ls-3-articles">
        <?php $posts =  getArticlesByCategory($db,"Lifestyle", 3, 1); ?>
        <?php if($posts) : ?>
          <?php while($row = $posts->fetch_assoc()) : ?>
          <article>
            <img src="<?php echo $row['logo']; ?>" alt="article-img" style="width:90px;height:90px;">
            <header>
              <h3><a href='<?php echo $row['category'] ?>/<?php echo $row['id'] ?>'><?php echo $row['title']; ?></a></h3>
              <div class='article-info'>
                <?php echo formatDate($row['date']); ?>
                by <span class="by"><?php echo $row['author']; ?></span>
              </div>
            </header>
          </article>
          <?php endwhile; ?>
        <?php else : ?>
        <p>There are no posts yet.</p>
        <?php endif;?>
        </div>
			</section>

			<section class="sports">
        <header>
          <h2>Sports</h2>
          <div class="bottom-line"></div>
          <ul class="arrows">
            <li><button class="arrow"><img src="img/right-arrow.png" alt="btn"></button></li>
            <li><button class="arrow"><img src="img/left-arrow.png" alt="btn"></button></li>
          </ul>
        </header>

        <?php $posts =  getArticlesByCategory($db,"Sports", 1); ?>
        <?php if($posts) : ?>
          <?php $row = $posts->fetch_assoc() ?>
          <div class="sp-last-article">
            <article >
              <img src="<?php echo $row['logo']; ?>" alt="article-img" width="310" height="200">
                <header>
                  <h3><?php echo $row['title']; ?></h3>
                </header>
                <div class='article-info'>
                  <?php echo formatDate($row['date']); ?>
                  by <span class="by"><?php echo $row['author']; ?></span>
                </div>
                <div class='article-body'>
                  <?php echo shortenText($row['body'], 180); ?>
                </div>
                <a href='<?php echo $row['category'] ?>/<?php echo $row['id'] ?>' class="read-more">Read More</a>
            </article>
          </div>
        <?php else : ?>
        <p>There are no posts yet.</p>
        <?php endif;?>

				<div class="sp-4-articles">
        <?php $posts =  getArticlesByCategory($db,"Sports", 4, 1); ?>
        <?php if($posts) : ?>
          <?php while($row = $posts->fetch_assoc()) : ?>
          <article>
            <img src="<?php echo $row['logo']; ?>" alt="article-img" style="width:80px;height:80px;">
            <header>
              <h3><a href='<?php echo $row['category'] ?>/<?php echo $row['id'] ?>'><?php echo $row['title']; ?></a></h3>
              <div class='article-info'>
                <?php echo formatDate($row['date']); ?>
                by <span class="by"><?php echo $row['author']; ?></span>
              </div>
            </header>
          </article>
          <?php endwhile; ?>
        <?php else : ?>
        <p>There are no posts yet.</p>
        <?php endif;?>

				</div>
			</section>

      <div class="tech-n-food">
				<section class="technology">
					<header>
            <h2>Technology</h2>
            <ul class="arrows">
              <li><button class="arrow"><img src="img/right-arrow.png" alt="btn"></button></li>
              <li><button class="arrow"><img src="img/left-arrow.png" alt="btn"></button></li>
            </ul>
          </header>
          <?php $posts =  getArticlesByCategory($db,"Technology", 2); ?>
          <?php if($posts) : ?>
            <?php while($row = $posts->fetch_assoc()) : ?>
            <article>
              <header>
                <a href='<?php echo $row['category'] ?>/<?php echo $row['id'] ?>'><img src="<?php echo $row['logo']; ?>" alt="article-img" width="200" height="174"></a>
              </header>
            </article>
            <?php endwhile; ?>
          <?php else : ?>
          <p>There are no posts yet.</p>
          <?php endif;?>
				</section>
				<section class="food-n-health">
					<header>
            <h2>Food &amp; Health</h2>
            <ul class="arrows">
              <li><button class="arrow"><img src="img/right-arrow.png" alt="btn"></button></li>
              <li><button class="arrow"><img src="img/left-arrow.png" alt="btn"></button></li>
            </ul>
          </header>

          <?php $posts =  getArticlesByCategory($db,"Food-n-health", 4); ?>
          <?php if($posts) : ?>
            <?php while($row = $posts->fetch_assoc()) : ?>
            <article>
              <img src="<?php echo $row['logo']; ?>" alt="article-img" style="width:80px;height:80px;">
              <header>
                <h3><a href='<?php echo $row['category'] ?>/<?php echo $row['id'] ?>'><?php echo $row['title']; ?></a></h3>
                <div class='article-info'>
                  <?php echo formatDate($row['date']); ?>
                  by <span class="by"><?php echo $row['author']; ?></span>
                </div>
              </header>
            </article>
            <?php endwhile; ?>
          <?php else : ?>
          <p>There are no posts yet.</p>
          <?php endif;?>
				</section>
      </div>
    </div>

		<aside class="side-bar">
			<section class="recent-posts">
				<header><h2>Recent Posts</h2></header>

        <?php $posts =  getFirstNArticles($db,5); ?>
        <?php if($posts) : ?>
          <?php while($row = $posts->fetch_assoc()) : ?>
          <article>
            <img src="<?php echo $row['logo']; ?>" alt="article-img" width="65" height="65">
            <header>
              <a href='<?php echo $row['category'] ?>/<?php echo $row['id'] ?>'><h3><?php echo $row['title']; ?></h3></a>
            </header>
            <div class='article-info'>
              <?php echo formatDate($row['date']); ?>
              by <span class="by"><?php echo $row['author']; ?></span>
            </div>
          </article>
          <?php endwhile; ?>
        <?php else : ?>
        <p>There are no posts yet.</p>
        <?php endif;?>

			</section>
			<section class="categories">
				<header><h2>Categories</h2></header>
				<ul>
					<li>
            <a href="category/Fashion">Fashion</a>
            <div class="num-of-posts">
              <?php
              echo getPostNumRows($db,'Fashion');
              ?>
            </div>
          </li>
					<li>
            <a href="category/Lifestyle">Lifestyle</a>
            <div class="num-of-posts">
              <?php
              echo getPostNumRows($db,'Lifestyle');
              ?>
            </div>
          </li>
					<li>
            <a href="category/Food-n-health">Food</a>
            <div class="num-of-posts">
              <?php
              echo getPostNumRows($db,'Food-n-health');
              ?>
            </div>
          </li>
					<li>
            <a href="category/World">World</a>
            <div class="num-of-posts">
              <?php
              echo getPostNumRows($db,'World');
              ?>
            </div>
          </li>
					<li>
            <a href="category/Sports">Sports</a>
            <div class="num-of-posts">
              <?php
              echo getPostNumRows($db,'Sports');
              ?>
            </div>
          </li>
					<li>
            <a href="category/Technology">Tech</a>
            <div class="num-of-posts">
              <?php
              echo getPostNumRows($db,'Technology');
              ?>
            </div>
          </li>
					<li>
            <a href="category/Food-n-health">Health</a>
            <div class="num-of-posts">
              <?php
              echo getPostNumRows($db,'Food-n-health');
              ?>
            </div>
          </li>
				</ul>
			</section>
			<div class="banner"><img src="img/banner.png" alt="banner"></div>
		</aside>
	</section>

	</main>
  </div>
</div>
<?php include_once 'includes/footer.php'; ?>
