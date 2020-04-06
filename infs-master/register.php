<?php include 'model/register.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="" method="POST">
      <h1 class="h3 mb-3 font-weight-normal">Sign up</h1>
      <label for="inputUsername" class="sr-only">Username</label>
      <input name="signin-name" type="Username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input name="signin-email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input name="signin-pass" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-primary btn-block" name='signin-submit' type="submit">Register</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
  </body>
</html>
