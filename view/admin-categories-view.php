
<?php include 'model/category.php'; ?>

<section class="admin-users">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Categories</h1>
  </div>

  <?php
  if (isset($_GET['id'])) {
    getCategoryEditForm($_GET['id']);

  } else {
    echo "<h4>Add category</h4>";
    echo "<form class='edit-user-form' method='post'>
            <label>Name</label>
            <input type='text' name='cat-name' value=''>
            <label>Parent-id</label>
            <input type='text' name='cat-parent' value=''>
            <button type='submit' name='add-cat-button'>Add</button>
          </form>";

    echo "<section class='admin-get-all'>";
    echo "<table class='edit-users'>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Parent-id</th>
            </tr>";
    echoCategories();
    echo "</table>";
    echo "</section>";
  }
  ?>

</section>
