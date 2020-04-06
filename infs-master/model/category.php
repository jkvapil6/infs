<?php

$db = new Database();

if (isset($_POST['add-cat-button'])) {

  $name = $_POST['cat-name'];

  $parent = 0;
  if (!empty($_POST['cat-parent'])) {
    $parent = $_POST['cat-parent'];
  }

  $query =  "INSERT INTO `categories` (`id`, `name`, `parent`) VALUES (NULL, '$name', '$parent');";

  $db->insert($query);
  header("Location: admin.php?msg=".urlencode('successfully-added'));
}
