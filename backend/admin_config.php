<?php
session_start();

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