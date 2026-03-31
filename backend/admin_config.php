<?php
session_start();

define("ADMIN_USERNAME", "admin");
define("ADMIN_PASSWORD", "\$2y\$10\$Z2KDRWdPOW6bw7Jy/USy8OUegKiAoJ67XPHnYpPLKOBKVsXmt80wK");

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