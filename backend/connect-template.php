<?php
/**
 * Include this to connect. Change the dbname to match your database,
 * and make sure your login information is correct after you upload 
 * to csunix or your app will stop working.
 * 
 * Sam Scott, McMaster University, 2025
 */
try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=<db name>",
        "<db user>",
        "<password>"
    );
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'SQL connection error']);
    exit;
}