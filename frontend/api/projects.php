<?php
    header('Content-Type: application/json');
    require '../../admin/includes/db.php';

    try {
        $query = "SELECT * FROM projects ORDER BY created_at DESC";
        $result = $conn->query($query);

        if (!$result) {
            throw new Exception("Query error: " . $conn->error);
        }

        $projects = [];

        while ($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }

        echo json_encode($projects);

    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
?>
