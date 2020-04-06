<?php
include 'core/init.php';


$db = new Database();

if (isset($_POST['signin-submit'])) {
  $user = test_input($_POST['signin-name']);
  $email = test_input($_POST['signin-email']);
  $pass = test_input($_POST['signin-pass']);

  if (empty($user) || empty($email) || empty($pass)) {
    header("Location: localhost/infs/register.php?signup=empty");
    exit();
  } else {
    $query = "SELECT * FROM `users` WHERE user = '$user'";

    $res = $db->select($query);
    if (!empty($res)) {
      header("Location: register.php?signup=alreadyTaken");
      exit();
    } else {
        $hashPass = password_hash($pass, PASSWORD_DEFAULT);
        $query = "INSERT INTO `users` (`id`, `user`, `email`, `password`, `super`) VALUES (NULL, '$user', '$email', '$hashPass', 0);";
        $db->insert($query);
        exit();
    }
  }
}

?>
