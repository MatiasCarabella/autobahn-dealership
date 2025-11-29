<?php
require_once '../config/database.php';

header('Content-Type: application/json');

try {
    $database = new Database();
    $pdo = $database->getConnection();

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        echo json_encode(['error' => 'Missing or empty "id" parameter']);
        exit;
    }

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if (!$id) {
        echo json_encode(['error' => 'The "id" parameter must be a valid number']);
        exit;
    }

    $query = "SELECT * FROM inventory WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode($result);
    } else {
        echo json_encode(['error' => 'No vehicle found with the provided ID.']);
    }
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    echo json_encode(['error' => 'Database connection error']);
}
