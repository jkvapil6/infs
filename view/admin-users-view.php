
<?php include 'model/user.php'; ?>

<section class="admin-users">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Users</h1>
  </div>

  <?php
  if (isset($_GET['id'])) {

    getUserEditForm($_GET['id']);

  } else {
    echo "<h4>Add user</h4>";
    echo "<form class='edit-user-form' method='post'>
            <label>Username</label>
            <input type='text' name='user' value=''>
            <label>Email</label>
            <input type='email' name='email' value=''>
            <label>Password</label>
            <input type='password' name='pass' value=''>
            <label>Permissions (1 = admin, 0 = user)</label>
            <input type='text' name='super' value=''>
            <button type='submit' name='add-user-button'>Add</button>
          </form>";

    echo "<section class='admin-get-all'>";
    echo "<table class='edit-users'>
            <tr>
              <th>Username</th>
              <th>Email</th>
              <th>Admin?</th>
            </tr>";
    echoUsers();
    echo "</table>";
    echo "</section>";
  }
  ?>

</section>
