<?php
require_once "connect.php";
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if ($data === null || !isset($data["content"]) || !isset($data["email"]) || !isset($data["name"]) || !isset($data["category"])) {
        echo json_encode(["error" => "Invalid JSON data received"]);
        exit;
    }

    try {
        $content = htmlspecialchars($data["content"] ?? "");
        $email = htmlspecialchars($data["email"] ?? "");
        $name = htmlspecialchars($data["name"] ?? "");
        $phone = htmlspecialchars($data["phone_number"] ?? "");
        $category = htmlspecialchars($data["category"] ?? "");

        $stmt = $pdo->prepare("INSERT INTO `messages`
        (`content`, `email`, `name`, `phone_number`, `category`)
        VALUES (?, ?, ?, ?, ?)");

        $success = $stmt->execute([$content, $email, $name, $phone, $category]);

        echo json_encode(['message' => 'Content created successfully']);

    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'SQL query error']);
        exit;
    }
}