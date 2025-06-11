<?php
require_once '../../includes/auth_check.php';
require_once '../../includes/db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ../../");
exit();
