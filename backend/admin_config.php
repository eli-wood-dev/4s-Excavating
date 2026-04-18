<?php
/*
    Description: Configuration file for admin session handling and access control.
*/

session_start();

/*
    Purpose: Check whether an admin user is currently logged in.
    Parameters: None.
    Returns: True if the admin is logged in, false otherwise.
*/
function isAdminLoggedIn() {
    return isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"] === true;
}

/*
    Purpose: Restrict access to admin-only pages.
    Parameters: None.
    Returns: Nothing. Redirects the user to the login page if not logged in.
*/
function requireAdmin() {
    if (!isAdminLoggedIn()) {
        header("Location: ../login.html");
        exit();
    }
}
?>