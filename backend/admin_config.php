<?php
session_start();

define("ADMIN_USERNAME", "admin");
define("ADMIN_PASSWORD", "4sadmin");

function isAdminLoggedIn() {
    return isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"] === true;
}

function requireAdmin() {
    if (!isAdminLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}
?>