
<aside class="post-aside">
  <section class="social-profiles">
    <header>
      <h2>Social Profiles</h2>
    </header>
    <ul>
      <li>
        <a href="#"><img src="../img/post-page/fb.png" alt="fb" style="width:60px;height:60px;"></a>
        <h3>666</h3>
        <p>Followers</p>
      </li>
      <li>
        <a href="#"><img src="../img/post-page/tw.png" alt="tw" style="width:60px;height:60px;"></a>
        <h3>666</h3>
        <p>Followers</p>
      </li>
      <li>
        <a href="#"><img src="../img/post-page/yt.png" alt="yt" style="width:60px;height:60px;"></a>
        <h3>666</h3>
        <p>Followers</p>
      </li>
      <li>
        <a href="#"><img src="../img/post-page/insta.png" alt="insta" style="width:60px;height:60px;"></a>
        <h3>666</h3>
        <p>Followers</p>
      </li>
    </ul>
  </section>
  <section class="subscribe">
    <header>
      <h2>Subscribe</h2>
    </header>
    <form class="subscribe-form" action="../index.php" method="post">
      <h3>Subscribe to our newsletter</h3>
      <input type="text" name="sub-email" placeholder="Email">
      <button type="submit" name="sub-submit">Subscribe</button>
      <p>Don't worry, we spam</p>
    </form>
  </section>
  <section class="whats-hot">
    <header>
      <h2>What's Hot</h2>
    </header>
    <?php $posts =  getArticlesByCategory($db,"Technology", 3); ?>
    <?php if($posts) : ?>
      <?php while($row = $posts->fetch_assoc()) : ?>
      <article>
        <a href='../<?php echo $row['category'] ?>/<?php echo $row['id'] ?>'><img src="../<?php echo $row['logo']; ?>" alt="article-img" width="200" height="174"></a>
        <header>
          <h3><?php echo $row['title'] ?></h3>
          <div class='article-info'><?php echo formatDate($row['date']); ?>
             by <span class="by"><?php echo $row['author']; ?></span>
          </div>
        </header>
      </article>
      <?php endwhile; ?>
    <?php else : ?>
    <p>There are no posts yet.</p>
    <?php endif;?>
  </section>

  <section class="most-popular">
    <header><h2>Most Popular</h2></header>
    <?php
    $posts = getFirstNArticles($db);
    ?>
    <?php if($posts) : ?>
      <?php while($row = $posts->fetch_assoc()) : ?>
      <article>
        <img src="../<?php echo $row['logo']; ?>" alt="article-img" style="width:75px;height:75px;">
        <header>
          <a href='../<?php echo $row['category'] ?>/<?php echo $row['id'] ?>'><h3><?php echo shortenTitle($row['title'], 40); ?></h3></a>
          <div class='article-info'><?php echo formatDate($row['date']); ?>
             by <span class="by"><?php echo $row['author']; ?></span>
          </div>
        </header>
      </article>
      <?php endwhile; ?>
    <?php else : ?>
    <p>There are no posts yet.</p>
    <?php endif;?>
  </section>

  <section class="instagram">
    <header>
      <h2>Instagram</h2>
    </header>
      <div class="gallery">
        <a href="../img/gallery/1.jpg" data-lightbox="mygallery"><img src="../img/gallery/1-small.jpg" alt="galler-img" style="width:95px;height:95px;"></a>
        <a href="../img/gallery/2.jpg" data-lightbox="mygallery"><img src="../img/gallery/2-small.jpg" alt="galler-img" style="width:95px;height:95px;"></a>
        <a href="../img/gallery/3.jpg" data-lightbox="mygallery"><img src="../img/gallery/3-small.jpg" alt="galler-img" style="width:95px;height:95px;"></a>
        <a href="../img/gallery/4.jpg" data-lightbox="mygallery"><img src="../img/gallery/4-small.jpg" alt="galler-img" style="width:95px;height:95px;"></a>
        <a href="../img/gallery/5.jpg" data-lightbox="mygallery"><img src="../img/gallery/5-small.jpg" alt="galler-img" style="width:95px;height:95px;"></a>
        <a href="../img/gallery/6.jpg" data-lightbox="mygallery"><img src="../img/gallery/6-small.jpg" alt="galler-img" style="width:95px;height:95px;"></a>
      </div>
  </section>
</aside>
