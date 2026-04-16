<?php
require_once "admin_config.php";

$_SESSION = [];
session_destroy();

header("Location: ../index.html");//change this
exit();
?>