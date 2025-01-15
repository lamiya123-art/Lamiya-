<?php
session_start();

// Destroy all session variables
session_unset(); 

// Destroy the session itself
session_destroy();

// Redirect to login page and stop further execution
header("Location: login.php");
exit();
?>
