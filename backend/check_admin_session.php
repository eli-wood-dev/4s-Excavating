<?php
require_once "admin_config.php";

header("Content-Type: application/json");

echo json_encode([
    "loggedIn" => isAdminLoggedIn()
]);
?>