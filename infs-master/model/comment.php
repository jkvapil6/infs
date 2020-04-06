<?php

if (isset($_POST['comm-submit'])) {

  $user = test_input($_POST['comm-name']);
  $email = test_input($_POST['comm-email']);
  $text = test_input($_POST['comm-text']);
  $postid = test_input($_GET['id']);

  if (empty($user) || empty($email) || empty($text)) {
      //header("Location: " . "http://" . $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'] . "&error=empty");
      phpAlert("Before submitting the form you must fill in all fields.");
      header("refresh:0;url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
  } else {
    if (!preg_match("/^[a-zA-Z]*/", $user)) {
      //header("Location: " . "http://" . $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'] . "&error=invalidUsername");
      phpAlert("Invalid username.");
      header("refresh:0;url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
    } else {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //header("Location: " . "http://" . $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'] . "&error=invalidEmail");
        phpAlert("Invalid email.");
        header("refresh:0;url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
      } else {
        $query = "INSERT INTO `comments` (`id`, `post-id`, `user`, `email`, `date`, `message`) VALUES (NULL, '$postid', '$user', '$email', CURRENT_TIMESTAMP, '$text');";

        $db->insert($query);
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit();
      }
    }
  }
}

if (isset($_POST['sub-comm-submit'])) {

  $parent = test_input($_POST['sub-comm-id']);
  $user = test_input($_POST['sub-comm-name']);
  $email = test_input($_POST['sub-comm-email']);
  $text = test_input($_POST['sub-comm-text']);
  $postid = test_input($_GET['id']);

  if (empty($user) || empty($email) || empty($text)) {
      //header("Location: " . "http://" . $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'] . "&error=empty");
      phpAlert("Before submitting the form you must fill in all fields.");
      //header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
      header("refresh:0;url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
      //exit();
  } else {
    if (!preg_match("/^[a-zA-Z]*/", $user)) {
      //header("Location: " . "http://" . $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'] . "&error=invalidUsername");
      phpAlert("Invalid username.");
      header("refresh:0;url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
      exit();
    } else {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //header("Location: " . "http://" . $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'] . "&error=invalidEmail");
        phpAlert("Invalid email.");
        header("refresh:0;url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
      } else {
        $query = "INSERT INTO `comments` (`id`, `post-id`, `parent-id`, `user`, `email`, `date`, `message`) VALUES (NULL, '$postid', '$parent', '$user', '$email', CURRENT_TIMESTAMP, '$text');";

        $db->insert($query);
        //echo $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'] ;
        //header("Location: ".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit();
      }
    }
  }
}


function getLastComments($db, $id, $n = 10) {

  $query = "SELECT * FROM comments WHERE `post-id` = '$id' AND `parent-id` IS NULL ORDER BY ID DESC LIMIT $n";
  $comms = $db->select($query);

  return $comms;
}

function getLastSubComments($db, $id, $n = 10) {

  $query = "SELECT * FROM comments WHERE `parent-id` = '$id' ORDER BY ID DESC LIMIT $n";
  $comms = $db->select($query);

  return $comms;
}

function getNumOfComms($db, $id) {
  $query = "SELECT * FROM comments WHERE `post-id` = '$id'";
  $comms = $db->select($query);
  return mysqli_num_rows($comms);
}
