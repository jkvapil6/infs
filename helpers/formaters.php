<?php

function formatDate($date) {
  return date('F j, Y', strtotime($date));
}

function timeAgo($date) {
  $nowtime = time();
  $time = date('U', strtotime($date));
  $diff = floor((($nowtime - $time) / 3600));
  if ($diff > 24) {
    $res = floor($diff / 24);
    return $res ." days ago";
  } else {
    return $diff ." hours ago";
  }
}

function shortenText($text, $chars = 450) {

  if (strlen($text) < $chars) return $text;
  $text = $text . " ";
  $text = substr($text, 0, $chars);
  $text = substr($text, 0, strrpos($text, ' '));
  $text = $text . "..</p>";
  return $text;
}

function shortenTitle($text, $chars = 120) {
  if (strlen($text) < $chars) return $text;
  $text = $text . " ";
  $text = substr($text, 0, $chars);
  $text = substr($text, 0, strrpos($text, ' '));
  $text = $text . "..";
  return $text;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
