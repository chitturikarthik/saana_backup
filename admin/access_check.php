<?php

  session_start();
  if (isset($_POST['accesscheck'])) {
    $pin = $_POST['pwd'];

    include "../connect.php";
    if ($pin == "2023") {
      $_SESSION["access"] = "Saana";
      header("Location:dashboard.php");
    } else {
      header("Location:index.php");
    }
  } else {
    //clear session from globals
    $_SESSION = array();
    //clear session from disk  
    session_destroy();
    header("Location:index.php");
    exit;
  }