
<?php include_once 'view/post-header.php'; ?>
<?php include 'model/comment.php';?>

<?php
  ob_start(); // wtf reseni pro chybne nacitani stranky po pridani komentare (modifikaci headeru)
?>

<div class="post-page">
  <div class="post">
    <?php
    $post = getArticleById($db, $_GET['id']);
    ?>
    <?php if($post) : ?>
      <?php while($row = $post->fetch_assoc()) : ?>
      <article>
        <img src="../<?php echo $row['logo']; ?>" alt="article-img" width="670" height="400">
        <header>
          <h2><?php echo $row['title']; ?></h2>
        </header>
        <div class='article-info'>
          <?php echo formatDate($row['date']); ?>
          by
          <span class="by"><?php echo $row['author']; ?></span>
        </div>
        <div class="article-body">
          <?php echo $row['body']; ?>
        </div>

        <div class="tags">
          <ul>
            <li><h2>Tags:</h2></li>
            <?php
              $tags = explode(", ", $row['tags']);

              foreach ($tags as $value) {
                echo "<li>$value</li>";
              }
             ?>
          </ul>
        </div>
      </article>
      <section class="share">
        <ul>
          <li><h2>Share:</h2></li>
          <li><a href="https://www.facebook.com/"><img src="../img/post-page/share-fb.png" alt="fb"></a></li>
          <li><a href="https://twitter.com/"><img src="../img/post-page/share-tw.png" alt="twitter"></a></li>
          <li><a href="https://www.youtube.com/"><img src="../img/post-page/share-yt.png" alt="youtube"></a></li>
          <li><a href="https://vimeo.com/"><img src="../img/post-page/share-v.png" alt="vimeo"></a></li>
          <li><a href="https://www.pinterest.com/"><img src="../img/post-page/share-p.png" alt="pinterest"></a></li>
        </ul>
      </section>
      <section class="author">
        <header>
          <img src="../img/profile-img.png" alt="avatar">
          <h2><?php echo $row['author']; ?></h2>
        </header>
        <p>Donec finibus, augue a convallis luctus, neque lacus blandit mi, id sodales neque magna non odio. </p>
        <ul>
          <li><a href="https://www.facebook.com/"><img src="../img/fb.png" alt="fb"></a></li>
          <li><a href="https://twitter.com/"><img src="../img/twitter.png" alt="twitter"></a></li>
          <li><a href="https://www.youtube.com/"><img src="../img/yt.png" alt="youtube"></a></li>
          <li><a href="https://vimeo.com/"><img src="../img/vimeo.png" alt="vimeo"></a></li>
          <li><a href="https://www.pinterest.com/"><img src="../img/p.png" alt="pinterest"></a></li>
          <li><a href="https://www.instagram.com/"><img src="../img/insta.png" alt="insta"></a></li>
        </ul>

        <?php
        $prev = getPrevPost($db, $_GET['id']);
        $next = getNextPost($db, $_GET['id']);
        ?>
        <div class="prev-post">
          <h5>Previous Post</h5>
          <img src="../img/arrow.svg" alt="left">
          <h4>
            <?php if($prev) : ?>
              <?php $row = $prev->fetch_assoc(); ?>
              <a href='../<?php echo $row['category'] ?>/<?php echo $row['id'] ?>'><?php echo $row['title'] ?></a>
            <?php else : ?>
              No previous post
            <?php endif;?>
          </h4>
        </div>
        <div class="next-post">
          <h5>Next Post</h5>
          <img src="../img/arrow.svg" alt="right" class="rotate180">
          <h4>
          <?php if($next) : ?>
            <?php $row = $next->fetch_assoc(); ?>
            <a href='../<?php echo $row['category'] ?>/<?php echo $row['id'] ?>'><?php echo $row['title'] ?></a>
          <?php else : ?>
            No next post
          <?php endif;?>
          </h4>
        </div>
      </section>
      <section class="related-articles">
        <header>
          <h2>Related Articles</h2>
        </header>
        <?php
        $post = getArticleById($db, $_GET['id']);
        $thisPost = $post->fetch_assoc();
        $prev = getReleatedArticles($db, $thisPost['category']);
        ?>
        <?php if($prev) : ?>
          <?php while($row = $prev->fetch_assoc()) : ?>
          <article>
            <a href='../<?php echo $row['category'] ?>/<?php echo $row['id'] ?>'>
              <img src="../<?php echo $row['logo']; ?>" alt="article-img">
            </a>
            <header>
              <h3><?php echo $row['title']; ?></h3>
              <div class='article-info'>
                <?php echo formatDate($row['date']); ?>
                by
                <span class="by"><?php echo $row['author']; ?></span>
              </div>
            </header>

          </article>
          <?php endwhile; ?>
        <?php else : ?>
        <p>There are related posts yet.</p>
        <?php endif;?>
      </section>
      <section class="load-comments">
        <?php
        $comms = getLastComments($db, $_GET['id'], 5);

        ?>
        <?php if($comms) : ?>
          <?php
          $n = getNumOfComms($db, $_GET['id']);
          echo "<header>
                  <h2>". $n ." Comments</h2>
                </header>";
          ?>
          <?php while($row = $comms->fetch_assoc()) : ?>
          <div class="comment">
            <img src="../img/profile.jpg" alt="comment-img" style="width:75px;height:75px;">
            <h3><?php echo $row['user']; ?></h3>
            <p><?php echo $row['message']; ?></p>
            <div class='comment-info'>
              <div class="reply">
                <a onclick='wtf( <?php echo $row['id']; ?> );'><img src="../img/return.svg" alt="reply">Reply</a>
              </div>
              <?php
              echo timeAgo($row['date']);
              ?>
              <div class="sub-comments">
                <?php
                /* Loading subcomments */
                $subcomms = getLastSubComments($db, $row['id'], 3);
                if($subcomms) {
                   while($subrow = $subcomms->fetch_assoc()) {
                     echo "<div class='sub-comment'>";
                     echo "<img src='../img/profile.jpg' alt='comment-img' style='width:75px;height:75px;'>
                       <h3>".$subrow['user']."</h3>
                       <p>".$subrow['message']."</p>
                       <div class='comment-info'>
                       ".timeAgo($subrow['date'])."</div>";
                    echo "</div>";
                   }
                }
                ?>
              </div>
              <form id="form-<?php echo $row['id']; ?>" class='form-sub-comment'  method='post'>
                <textarea name='sub-comm-text' rows='8' cols='80' placeholder='Your comment here' required></textarea>
                <input class='comm-in-left' type='hidden' name='sub-comm-id' value='<?php echo $row['id']; ?>'>
                <input class='comm-in-left' type='text' name='sub-comm-name' value='' placeholder='Your name' required>
                <input class='comm-in-right' type='email' name='sub-comm-email' value='' placeholder='Your email'>
                <button type='submit' name='sub-comm-submit'>Submit</button>
              </form>
              <script>
                function wtf(id) {
                  $("#form-" + id).fadeToggle(500);
                }
              </script>
            </div>
          </div>
          <?php endwhile; ?>
        <?php else : ?>
        <h2>There are no comments yet.</h2s>
        <?php endif;?>
      </section>

      <section class="write-comment">
        <h2>Leave a Reply</h2>
        <?php
        echo "<form class='form-comment' method='post'>
          <textarea name='comm-text' rows='8' cols='80' placeholder='Your comment here' required></textarea>
          <input class='comm-in-left' type='text' name='comm-name' value='' placeholder='Your name' required>
          <input class='comm-in-right' type='email' name='comm-email' value='' placeholder='Your email'>
          <button type='submit' name='comm-submit'>Submit</button>
        </form>";
        ?>
      </section>

      <?php endwhile; ?>
    <?php else : ?>
    <p>There are no posts yet.</p>
    <?php endif;?>



  </div>
  <?php include_once 'view/post-aside.php'; ?>
</div>
<?php include_once 'view/post-footer.php'; ?>
