<?php

/**
 * Eli Wood, Aaryn Gill, Gurbaz Sogi
 * 2026-04-07
 * Handles user logout and removes session
 */

require_once "admin_config.php";

$_SESSION = [];
session_destroy();

header("Location: ../index.html");
exit();
?>
