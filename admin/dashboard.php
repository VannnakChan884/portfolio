<?php
require_once 'includes/auth_check.php';
require_once 'includes/db.php';

// Count projects
$project_count = $conn->query("SELECT COUNT(*) AS total FROM projects")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
  <div class="mb-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold">Dashboard</h1>
    <a href="auth/logout.php" class="bg-red-500 text-white px-3 py-1 rounded">Logout</a>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white shadow p-4 rounded">
      <h2 class="text-lg font-semibold">Total Projects</h2>
      <p class="text-3xl font-bold mt-2"><?= $project_count ?></p>
    </div>
    <!-- You can add more boxes for messages, users, etc. -->
  </div>
</body>
</html>
