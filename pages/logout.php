<?php
session_start();
session_unset();    // Clear session variables
session_destroy();  // End the session

// Redirect to login page
header("Location: login.php");
exit();
?>
