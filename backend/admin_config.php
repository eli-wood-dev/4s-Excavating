<?php
/**
 * Aaryn Gill
 * 2026-03-30
 * creates functions used in multiple parts of the admin process
 */

session_start();

/**
 * checks if a user is currently logged in based on the session
 * @return bool true if the user is currently logged in
 */
function isAdminLoggedIn() {
    return isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"] === true;
}

/**
 * Ensures that the user is logged in, and redirects to the login page if they are not
 */
function requireAdmin() {
    if (!isAdminLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}