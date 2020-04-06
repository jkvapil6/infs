<?php include_once 'view/post-header.php'; ?>

<div class="post-page">
  <div class="category-articles">

    <?php
    if (!empty($_GET['category'])) {
      $cat = $_GET['category'];
      $posts = getArticlesByCategory($db, $cat);
    }
    ?>
    <?php if($posts) : ?>
      <?php while($row = $posts->fetch_assoc()) : ?>
      <article>
        <img src="../<?php echo $row['logo']; ?>" alt="article-img" style="width:300px;height:180px;">
        <header>
          <h4><?php echo $row['category']; ?></h4>
          <h3><?php echo shortenTitle($row['title'], 40); ?></h3>
          <div class='article-info'><?php echo formatDate($row['date']); ?>
            by <span class="by"><?php echo $row['author']; ?></span>
          </div>
        </header>
        <div class='article-body'><?php echo shortenText($row['body'], 150); ?></div>
        <a href='../<?php echo $row['category'] ?>/<?php echo $row['id'] ?>' class="read-more">Read More</a>
      </article>
      <?php endwhile; ?>
    <?php else : ?>
    <p>There are no posts yet.</p>
    <?php endif;?>

  </div>
  <?php include_once 'view/post-aside.php'; ?>
</div>

<?php include_once 'view/post-footer.php'; ?>
