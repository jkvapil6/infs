<?php

/* function takes db object and name of category as parameters,
  returns number of Articles of this category */
function getPostNumRows($db, $category) {

  $query = "SELECT * FROM posts WHERE category = '$category'";
  $posts = $db->select($query);

  if (empty($posts)) {
      return "No Posts";
  } else return mysqli_num_rows($posts) . " Posts";
}

/* function takes db object, number of artiles and offset as parameters,
  returns last n + offset Articles */
function getLastNArticles($db, $n = 5, $offset = 0) {

  $query = "SELECT * FROM posts ORDER BY ID DESC LIMIT $n OFFSET $offset";
  $posts = $db->select($query);

  return $posts;
}

/* function takes db object, number of artiles and offset as parameters,
  returns first n + offset Articles */
function getFirstNArticles($db, $n = 5, $offset = 0) {

  $query = "SELECT * FROM posts ORDER BY ID LIMIT $n OFFSET $offset";
  $posts = $db->select($query);

  return $posts;
}

/* function takes db object, name of category, number of artiles and offset as parameters,
  returns last n + offset Articles */
function getArticlesByCategory($db, $cat, $n = 8, $offset = 0) {

  $query = "SELECT * FROM posts WHERE category = '$cat' ORDER BY ID LIMIT $n OFFSET $offset";
  $posts = $db->select($query);

  return $posts;
}

/* function takes db object, name of article, returns article*/
function getArticleById($db, $id) {

  $query = "SELECT * FROM posts WHERE id = '$id'";
  $post = $db->select($query);

  return $post;
}

function getPrevPost($db, $id) {

    $query = "SELECT * FROM posts WHERE id < '$id' ORDER BY ID DESC LIMIT 1";
    $post = $db->select($query);

    return $post;
}

function getNextPost($db, $id) {

    $query = "SELECT * FROM posts WHERE id > '$id' ORDER BY ID DESC LIMIT 1";
    $post = $db->select($query);

    return $post;
}

function getReleatedArticles($db, $cat) {

    $query = "SELECT * FROM posts WHERE category = '$cat' ORDER BY ID DESC LIMIT 2";
    $post = $db->select($query);

    return $post;
}
