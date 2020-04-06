<?php include 'model/post.php'; ?>
<section class="admin-posts-add">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add post</h1>
  </div>
  <form class='edit-post' method='post'>
    <label>Category</label>
    <textarea class='in' rows='1' name='post-cat'></textarea>
    <label>Title</label>
    <textarea class='in' rows='1' name='post-title'></textarea>
    <label>Logo</label>
    <textarea class='in' rows='1' name='post-logo' placeholder="logo-src"></textarea>
    <label>Author</label>
    <textarea class='in' rows='1' name='post-author'></textarea>
    <label>Tags</label>
    <textarea class='in' rows='1' name='post-tags'></textarea>
    <label>Body</label>
    <textarea name='post-body'></textarea>
    <button type='submit' name='add-post-button'>ADD</button>
  </form>


</section>
