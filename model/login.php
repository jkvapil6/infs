<?php

session_start();

include 'config/config.php';
include 'core/Database.php';

$db = new Database();

if (isset($_POST['signin-submit'])) {
  $user = $_POST['signin-name'];
  $pass = $_POST['signin-pass'];

  if (empty($user) || empty($pass)) {
    header("Location: localhost/infs/login.php?signin=empty");
    exit();
  } else {
    $query = "SELECT * FROM `users` WHERE user = '$user'";
    $res = $db->select($query);
    if (mysqli_num_rows($res) < 1) {
      header("Location: login.php?signin=noUser");
      exit();
    } else {
      if ($row = mysqli_fetch_assoc($res)) {
        $hashPassChck = password_verify($pass, $row['password']);
        if ($hashPassChck == false) {
          header("Location: ../index.php?signin=error");
          exit();
        } else {
          $_SESSION['user'] = $row['user'];
          $_SESSION['email'] = $row['email'];
          $_SESSION['pass'] = $row['password'];
          $_SESSION['super'] = $row['super'];
          header("Location: index.php?signin=success");
        }
      } else {
        header("Location: login.php?signin=error");
      }
    }
  }
}

?>
