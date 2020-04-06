<?php

class Database {

  public $host = DB_HOST;
  public $username = DB_USER;
  public $password = DB_PASS;
  public $db_name = DB_NAME;

  public $link;
  public $error;

  public function __construct() {
    $this->connect();
  }

  /* db connect function */
  private function connect() {
    $this->link = new mysqli($this->host, $this->username, $this->password, $this->db_name);

    if (!$this->link) {
      $this->error = "Connection failed" . $this->link->connect_error;
      return false;
    }
  }

  /* db select function */
  public function select($query) {
    $result = $this->link->query($query) or die($this->link->error.__LINE__);

    if ($result->num_rows > 0) {
      return $result;
    } else {
      return false;
    }
  }

  /* db insert function */
  public function insert($query) {
    $insert_row = $this->link->query($query) or die($this->link->error.__LINE__);

    if (!$insert_row) {
      die('Error: ('. $this->link->errno .') '. $this->link->error); // errno = cislo chyby
    }
  }

  /* db update function */
  public function update($query) {
    $update_row = $this->link->query($query) or die($this->link->error.__LINE__);

    if ($update_row) {
      phpAlert("Sucessfully updated!");
      //header("Location: admin.php?msg= ".urlencode('successfully-updated'));
      //exit();
    } else {
      die('Error: ('. $this->link->errno .') '. $this->link->error); // errno = cislo chyby
    }
  }

  /* db delete function */
  public function delete($query) {
    $delete_row = $this->link->query($query) or die($this->link->error.__LINE__);

    if ($delete_row) {
      //header("Location: admin.php?msg= ".urlencode('successfully-deleted'));
      //exit();
    } else {
      die('Error: ('. $this->link->errno .') '. $this->link->error); // errno = cislo chyby
    }
  }

  public function multiDelete($query) {
  $delete_row = $this->link->multi_query($query) or die($this->link->error.__LINE__);

    if ($delete_row) {
      header("Location: admin.php?msg= ".urlencode('successfully-deleted'));
      exit();
    } else {
      die('Error: ('. $this->link->errno .') '. $this->link->error); // errno = cislo chyby
    }
  }

}
