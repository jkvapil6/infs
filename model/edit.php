<?php
require 'core/init.php';
ob_start();

function getUserEditForm($id) {

  $db = new Database();
  $query = "SELECT * FROM users WHERE id = '$id'";
  $res = $db->select($query);

  if ($res) {
    $row = $res->fetch_assoc();
    echo "<form class='edit-user-form' method='post'>
              <label for='username'>Username</label>
              <input type='text' name='user' value='".$row['user']."'>
              <label for='email'>Email</label>
              <input type='text' name='email' value='".$row['email']."'>
              <label for='password'>Password</label>
              <input type='text' name='pass' value='".$row['password']."'>
              <label for='super'>Permissions (1 = admin, 0 = user)</label>
              <input type='text' name='super' value='".$row['super']."'>
              <button type='submit' name='edit-button'>edit</button>
            </form>";

    if (isset($_POST['edit-button'])) {
      setUpdatedUsers($row['id'], $_POST['user'], $_POST['email'], $_POST['pass'], $_POST['super']);
    }
  } else {
    echo "Not found anything.";
  }
}

function setUpdatedUsers($id, $user, $email, $pass, $super) {

  $db = new Database();
  $query = "UPDATE `users` SET `user` = '$user', `email` = '$email', `password` = '$pass', `super` = '$super' WHERE `users`.`id` = '$id';";
  $db->update($query);

  header("Location: admin.php?msg= ".urlencode('successfully-updated'));
  exit();
}


function getCategoryEditForm($id) {

  $db = new Database();
  $query = "SELECT * FROM categories WHERE id = '$id'";
  $res = $db->select($query);

  if ($res) {
    $row = $res->fetch_assoc();
    echo "<form class='edit-user-form' method='post'>
              <label>Name</label>
              <input type='text' name='cat-name' value='".$row['name']."'>
              <label>Parent</label>
              <input type='text' name='cat-parent' value='".$row['parent']."'>
              <button type='submit' name='edit-button'>edit</button>
            </form>";

    if (isset($_POST['edit-button'])) {
      setUpdatedCategory($row['id'], $row['name'], $_POST['cat-name'], $_POST['cat-parent']);
    }
  } else {
    echo "Not found anything.";
  }
}

function setUpdatedCategory($id, $prevName, $name, $parent) {

  $db = new Database();
  $query = "UPDATE `posts` SET `category` = '$name' WHERE `posts`.`category` = '$prevName';";
  $db->update($query);

  $query = "UPDATE `categories` SET `name` = '$name', `parent` = '$parent' WHERE `categories`.`id` = '$id';";
  $db->update($query);

  header("Location: admin.php?msg= ".urlencode('successfully-updated'));
  exit();
}


function echoUsers() {

  $db = new Database();
  $query = "SELECT * FROM users ORDER BY ID";
  $users = $db->select($query);

  if ($users) {
    while ($row = $users->fetch_assoc()) {
      echo "<tr class='user'>
              <td>
                <a href='admin.php?edit=users&id=".$row['id']."'>".$row['user']."</a>
              </td>
              <td>
                ".$row['email']."
              </td>
              <td>
                ".$row['super']."
              </td>
              <td>
                <a href='admin.php?delUser=".$row['id']."'>delete</a>
              </td>
            </tr>";
    }
  } else {
    echo "<p>There are no users yet.</p>";
  }
}


function echoCategories() {

  $db = new Database();
  $query = "SELECT * FROM categories ORDER BY ID";
  $cats = $db->select($query);

  if ($cats) {
    while ($row = $cats->fetch_assoc()) {
      echo "<tr class='user'>
              <td>
                ".$row['id']."
              </td>
              <td>
                <a href='admin.php?edit=categories&id=".$row['id']."'>".$row['name']."</a>
              </td>
              <td>
                ".$row['parent']."
              </td>
              <td>
                <a href='admin.php?delCat=".$row['id']."'>delete</a>
              </td>
            </tr>";
    }
  } else {
    echo "<p>There are no users yet.</p>";
  }
}


function deleteUser($id) {

  /* deleting is available only for administrator*/
  if (isset($_SESSION['super']) && $_SESSION['super'] > 0) {
    $db = new Database();
    $query = "SELECT * FROM users WHERE id = '$id'";
    $user = $db->select($query);

    if ($user) {
      $row = $user->fetch_assoc();
      if ($row['super'] > 0) {
        phpAlert('You cannot delete administrator!');
        header("refresh:0;url=admin.php?edit=users");
      } else {
        $query = "DELETE FROM users WHERE id = '$id'";
        $db->delete($query);
      }
    } else die('This user does not exists.');
  } else die('You are not administrator!');
}


function deleteCategory($id) {

  /* deleting is available only for administrator*/
  if (isset($_SESSION['super']) && $_SESSION['super'] > 0) {

    $db = new Database();

    /* selecting subcategories of deleted category */
    $query = "SELECT * FROM categories WHERE parent = '$id'";
    $cat = $db->select($query);

    /* if category includes subcategories it can not be deleted */
    if ($cat) {
      phpAlert('You cannot delete category which includes subcategories!');
      header("refresh:0;url=admin.php?edit=categories");
      exit();
    } else {

      /* selecting name of deleted category */
      $query = "SELECT * FROM categories WHERE id = '$id'";
      $cat = $db->select($query);
      $row = $cat->fetch_assoc();
      $name = $row['name'];

      /* selecting posts of deleted category */
      $query = "SELECT * FROM posts WHERE category = '$name'";
      $posts = $db->select($query);

      /* if there are posts in deleted category it must be deleted too */
      if ($posts) {
        $query = "DELETE FROM posts WHERE category = '$name'";
        $db->delete($query);
      }

      $query = "DELETE FROM categories WHERE id = '$id'";
      $db->delete($query);
      phpAlert('Sucessfully deleted!');
      header("refresh:0;url=admin.php?edit=categories");
    }
  } else die('You are not administrator!');
}


function getEditArticleById($id) {

  $db = new Database();
  $query = "SELECT * FROM posts WHERE id = '$id'";
  $posts = $db->select($query);

  if($posts) {
    $row = $posts->fetch_assoc();
    echo "<form class='edit-post' method='post'>
              <label for='category'>Category</label>
              <textarea class='in' rows='1' name='post-cat'>".$row['category']."</textarea>
              <label for='title'>Title</label>
              <textarea class='in' rows='1' name='post-title'>".$row['title']."</textarea>
              <label for='body'>Body</label>
              <textarea name='post-body'>".$row['body']."</textarea>
              <button type='submit' name='edit-button'>EDIT</button>
            </form>";
    if (isset($_POST['edit-button'])) {
      setUpdatedArticle($row['id'], $_POST['post-cat'], $_POST['post-title'], $_POST['post-body']);
    }
  } else {
    echo "Not found anything.";
  }
}


function setUpdatedArticle($id, $cat, $title, $body) {

  $db = new Database();

  $query = "UPDATE `posts` SET `category` = '$cat', `title` = '$title', `body` = '$body' WHERE `posts`.`id` = '$id';";

  $db->update($query);
}
