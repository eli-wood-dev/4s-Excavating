<?php
require_once "admin_config.php";
require_once "connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $email = $data["email"];
    $password = $data["password"];

    //should trigger on empty string
    if(!$email || !$password){
        http_response_code(401);
        echo json_encode(['error' => 'Invalid Login']);
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM 4susers WHERE email = ? LIMIT 1");
    $success = $stmt->execute([$email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($success && $result && password_verify($password, $result["password"])) {
        $_SESSION["admin_logged_in"] = true;
        $_SESSION["admin_username"] = $result["name"];
        echo json_encode(['message' => 'success']);
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'Invalid Login']);
    }
}