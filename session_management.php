<?php
session_start();

$inactiveTimeout = 15 * 60; // 15 minutes in seconds

if(isset($_SESSION['start']) ) {
    $session_life = time() - $_SESSION['start'];
    if($session_life > $inactiveTimeout){
        // $_SESSION['logged_out_due_to_inactivity'] = true;
        session_unset();
        // session_destroy();
        header("Location: away.php");
    // unset($_SESSION['logged_out_due_to_inactivity']);
    }
}

$_SESSION['start'] = time();


?>