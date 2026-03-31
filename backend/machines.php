<?php
include("connect.php");
header('Content-Type: application/json');

try {
    $stmt = $pdo->prepare("SELECT m.id AS machine_id, m.name, m.description, m.image, mr.start_date, mr.end_date 
    FROM `machines` AS m 
    LEFT JOIN `machine_rentals` AS mr 
    ON m.id = mr.machine_id 
    WHERE mr.end_date > CURRENT_DATE() 
    ORDER BY m.id");
    
    $success = $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $machines = [];
    foreach ($data as $entry) {
        $id = $entry["machine_id"];

        if (!isset($machines[$id])) {
            $machines[$id] = [
                'name' => $entry['name'],
                'image' => $entry['image'],
                'description' => $entry['description'],
                'rentals' => []
            ];
        }

        if ($entry["start_date"] != null && $entry["end_date"] != null) {
            array_push($machines[$id]['rentals'], [
                'startDate' => $entry["start_date"],
                'endDate' => $entry["end_date"]
            ]);
        }

    }

    echo json_encode($machines);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'SQL query error']);
    exit;
}