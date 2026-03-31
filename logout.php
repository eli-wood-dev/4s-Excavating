<?php
require_once "backend/admin_config.php";

$_SESSION = [];
session_destroy();

header("Location: login.php");
exit();
?>