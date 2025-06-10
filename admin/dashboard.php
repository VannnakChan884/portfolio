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
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body class="bg-gray-100 p-6">
  <div class="w-full mb-6 flex justify-between items-center">
    <a href="dashboard.php" class="text-2xl font-bold">Dashboard</a>
    <a href="auth/logout.php" class="bg-red-500 text-white px-3 py-1 rounded">Logout</a>
  </div>

  <nav class="w-1/5 py-4 px-3 bg-gray-800 text-white rounded-xl mb-6">
    <ul>
      <li>
        <a href="settings/profile.php" class="py-2 px-4 bg-green-300 hover:bg-green-300 block rounded-xl">Profiles</a>
      </li>
      <li>
        <a href="projects/" class="py-2 px-4 hover:bg-green-300 block rounded-xl">Projects</a>
      </li>
      <li>
        <a href="messages/" class="py-2 px-4 hover:bg-green-300 block rounded-xl">Messages</a>
      </li>
    </ul>
  </nav>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white shadow p-4 rounded">
      <h2 class="text-lg font-semibold">Total Projects</h2>
      <p class="text-3xl font-bold mt-2"><?= $project_count ?></p>
    </div>
    <!-- You can add more boxes for messages, users, etc. -->
  </div>
</body>
</html>
