<?php

function getSearchedArticles($db) {
  if (isset($_POST['search-submit-button'])) {

    // bug pri pouziti objektu db ve funkci mysqli_real_escape_string..
    //$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    //$search = mysqli_real_escape_string($conn, $_POST['search']);
    $search = test_input($_POST['search']);
    echo "<p>Results of searching ".$_POST['search'].":</p>";
    $query = "SELECT * FROM posts WHERE title LIKE '%$search%' OR body LIKE '%$search%'";
    $posts = $db->select($query);

    return $posts;
  }
}


function getEditArticles() {
  if (isset($_POST['search-submit-button'])) {

    $db = new Database();

    // bug pri pouziti objektu db ve funkci mysqli_real_escape_string..
    //$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    //$search = mysqli_real_escape_string($conn, $_POST['search']);
    $search = test_input($_POST['search']);

    $query = "SELECT * FROM posts WHERE title LIKE '%$search%' OR body LIKE '%$search%'";
    $posts = $db->select($query);

    if($posts) {
      while($row = $posts->fetch_assoc()) {
        echo "<article>
                <img src=". $row['logo'] ." alt='article-img' width='260' height='160'>
                <header>
                  <h4>". $row['category'] ."</h4>
                  <h3>". shortenText($row['title'], 40) ."</h3>
                  <div class='article-info'>". formatDate($row['date']) ."
                    by <span class='by'>". $row['author'] ."</span>
                  </div>
                   <p>
                     <span>
                       ". shortenText($row['body'], 120) ."
                     </span>
                   </p>
                </header>
                <a class='edit' href='admin.php?edit=posts&id=". $row['id'] ."'>Edit</a>
              </article>";
      }
    } else {
      echo "Not found anything.";
    }
  }
}
