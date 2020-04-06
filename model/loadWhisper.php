<?php

$search = $_POST['newSearchedText'];

$conn = mysqli_connect('localhost','root','','infs');
$query = "SELECT * FROM posts WHERE tags LIKE '%$search%' OR title LIKE '%$search%' OR author LIKE '%$search%' LIMIT 3";

$posts = mysqli_query($conn, $query);

if (mysqli_num_rows($posts) >= 1) {
  $id = 1;
  while($row = $posts->fetch_assoc()) {
    echo "<li id=li-".$id." onclick='setSearchedContent(".$id.")' >".$row['title']."</li>";
    $id++;
  }
}

?>
