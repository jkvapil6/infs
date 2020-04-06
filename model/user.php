<?php

$db = new Database();

if (isset($_POST['add-user-button'])) {

  $user = $_POST['user'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $super = $_POST['super'];

  $hashPass = password_hash($pass, PASSWORD_DEFAULT);

  $query =  "INSERT INTO `users` (`id`, `user`, `email`, `password`, `super`) VALUES (NULL, '$user', '$email', '$hashPass', '$super');";

  $db->insert($query);
  header("Location: admin.php?msg=".urlencode('successfully-added'));
}
