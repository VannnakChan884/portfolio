<?php
header('Content-Type: application/json');
require '../config/db.php';

try {
    $stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC");
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($projects);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>