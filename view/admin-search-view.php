<?php include 'model/search.php';?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Edit Posts</h1>
</div>
<form class="search-form" action="admin.php?edit=posts" method="post">
  <input type="text" name="search">
  <button type="submit" name="search-submit-button" >Search</button>
</form>

<section class="admin-articles">
<?php
  getEditArticles();
?>
</section>
