<?php
/*
    Description: Logs the admin user out by clearing the session and redirecting to the home page.
*/

require_once "admin_config.php";

$_SESSION = [];
session_destroy();

header("Location: ../index.html");
exit();
?>