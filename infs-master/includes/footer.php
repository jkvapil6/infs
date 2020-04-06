
  <footer>
    <div class="footer-content">

      <section class="contact">
        <img class="footer-logo" src="img/footer/f-logo.png" alt="logo">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at nunc vel est tincidunt porta.</p>
        <ul>
          <li><a href=""><img src="img/footer/f-fb.png" alt="href"></a></li>
          <li><a href=""><img src="img/footer/f-tw.png" alt="href"></a></li>
          <li><a href=""><img src="img/footer/f-yt.png" alt="href"></a></li>
          <li><a href=""><img src="img/footer/f-vim.png" alt="href"></a></li>
          <li><a href=""><img src="img/footer/f-pin.png" alt="href"></a></li>
          <li><a href=""><img src="img/footer/f-ins.png" alt="href"></a></li>
          <li><a href=""><img src="img/footer/f-be.png" alt="href"></a></li>
          <li><a href=""><img src="img/footer/f-wtf.png" alt="href"></a></li>
          <li><a href=""><img src="img/footer/f-sky.png" alt="href"></a></li>
          <li><a href=""><img src="img/footer/f-cl.png" alt="href"></a></li>
        </ul>
      </section>

      <section class="most-viewed">
        <h2>Most Viewed</h2>
        <?php
        /* nacteme posledni prispevek */
        $query = "SELECT * FROM posts ORDER BY ID LIMIT 3";
        $posts = $db->select($query);
        ?>
        <?php if($posts) : ?>
          <?php while($row = $posts->fetch_assoc()) : ?>
          <article>

            <img src="<?php echo $row['logo']; ?>" alt="article-img" width="70" height="70">

              <h3><a href='<?php echo $row['category'] ?>/<?php echo $row['id'] ?>'><?php echo $row['title']; ?></a></h3>

            <p>
              <?php echo formatDate($row['date']); ?>
              by
              <span class="by"><?php echo $row['author']; ?></span>
            </p>

          </article>
          <?php endwhile; ?>
        <?php else : ?>
        <p>There are no posts yet.</p>
        <?php endif;?>
      </section>

      <section class="twitter">
          <h2>Twitter</h2>
          <article class="twitter-article">
            <p><img src="img/footer/twittie.png" alt="tw-logo">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <div class="time-ago">n/a time ago</div>
          </article>
          <article class="twitter-article">
            <p><img src="img/footer/twittie.png" alt="tw-logo">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <div class="time-ago">n/a time ago</div>
          </article>
          <article class="twitter-article">
            <p><img src="img/footer/twittie.png" alt="tw-logo">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <div class="time-ago">n/a time ago</div>
          </article>
      </section>

      <div class="copyrights"><p>&copy; Copyright Gomalthemes 2017, All Rights Reserved</p></div>

    </div>
  </footer>
  </body>
</html>
