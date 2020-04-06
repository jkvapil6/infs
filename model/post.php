
<?php

$db = new Database();

if (isset($_POST['add-post-button'])) {

  $cat = $_POST['post-cat'];
  $title = $_POST['post-title'];
  $logo = $_POST['post-logo'];
  $body = $_POST['post-body'];
  $author = $_POST['post-author'];
  $tags = $_POST['post-tags'];

  $query = "SELECT * FROM categories WHERE name = '$cat'";
  $res = $db->select($query);

  if (!$res) {
    phpAlert('This category does not exists!');
    header("refresh:0;url=admin.php?add=post");
  } else {

    $query =  "INSERT INTO `posts` (`id`, `category`, `title`, `logo`, `body`, `author`, `tags`, `date`) VALUES (NULL, '$cat', '$title', '$logo', '$body', '$author', '$tags', CURRENT_TIMESTAMP);";

    $db->insert($query);
    header("Location: admin.php?msg=".urlencode('successfully-added'));
  }
}
