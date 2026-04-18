<?php
/*
    Description: Toggles a message between resolved and unresolved and returns the updated status as JSON.
*/

require_once "admin_config.php";
require_once "connect.php";

header("Content-Type: application/json");

if (!isAdminLoggedIn()) {
    echo json_encode([
        "success" => false,
        "message" => "Unauthorized."
    ]);
    exit();
}

$id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;

if ($id <= 0) {
    echo json_encode([
        "success" => false,
        "message" => "Invalid message id."
    ]);
    exit();
}

$getStmt = $pdo->prepare("SELECT resolved FROM messages WHERE id = ?");
$getStmt->execute([$id]);
$current = $getStmt->fetch(PDO::FETCH_ASSOC);

if (!$current) {
    echo json_encode([
        "success" => false,
        "message" => "Message not found."
    ]);
    exit();
}

$newResolved = ((int)$current["resolved"] === 1) ? 0 : 1;
$resolvedAt = ($newResolved === 1) ? date("Y-m-d H:i:s") : null;

$updateStmt = $pdo->prepare("UPDATE messages SET resolved = ?, resolved_at = ? WHERE id = ?");
$updateStmt->execute([$newResolved, $resolvedAt, $id]);

echo json_encode([
    "success" => true,
    "resolved" => $newResolved
]);
?>