<?php include 'model/edit.php'; ?>
<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/admin.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="admin.php">Admin section</a>
      <div></div>
      <ul class="navbar-nav px-3">

      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="index.php">
                  <span data-feather="home"></span>
                  Home<span class="sr-only">(current)</span>
                </a>
              </li>

              <?php
              if (isset($_SESSION['super']) && $_SESSION['super'] > 0) {
                echo "<li class='nav-item'>
                        <a class='nav-link' href='admin.php?add=post'>
                          <span data-feather='file'></span>
                          Add Post
                        </a>
                      </li>
                      <li class='nav-item'>
                        <a class='nav-link' href='admin.php?edit=posts'>
                          <span data-feather='file'></span>
                          Edit Posts
                        </a>
                      </li>
                      <li class='nav-item'>
                        <a class='nav-link' href='admin.php?edit=users'>
                          <span data-feather='file'></span>
                          Edit Users
                        </a>
                      </li>
                      <li class='nav-item'>
                        <a class='nav-link' href='admin.php?edit=categories'>
                          <span data-feather='file'></span>
                          Edit Categories
                        </a>
                      </li>";
              }
              ?>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <?php

          if (empty($_GET)) {
            echo "<div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>
                    <h1 class='h2'>Welcome in admin section!</h1>
                  </div>";
          }


          if (isset($_SESSION['super']) && $_SESSION['super'] > 0) {

            if(isset($_GET['msg'])) {
              echo "<h1>".$_GET['msg']."!</h1>";
              header( "refresh:3;url=admin.php" );
            }

            if (isset($_GET['delUser'])) {
              deleteUser($_GET['delUser']);
            }

            if (isset($_GET['delCat'])) {
              deleteCategory($_GET['delCat']);
            }

            if(isset($_GET['edit']) && $_GET['edit'] == 'posts') {
              include './view/admin-search-view.php';

              if (isset($_GET['id'])) {
                getEditArticleById($_GET['id']);
              }
            }

            if(isset($_GET['edit']) && $_GET['edit'] == 'users') {
              include './view/admin-users-view.php';
            }

            if(isset($_GET['add']) && $_GET['add'] == 'post') {
              include './view/admin-posts-add.php';
            }

            if(isset($_GET['edit']) && $_GET['edit'] == 'categories') {
              include './view/admin-categories-view.php';
            }
          }
          ?>

        </main>
      </div>
    </div>
  </body>
</html>
