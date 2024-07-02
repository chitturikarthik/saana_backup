<?php
include('session_management.php');

// Clear all session data
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to the login page
header('Location: index.php');
exit();
?>
