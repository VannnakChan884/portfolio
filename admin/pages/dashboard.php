<?php
  require_once '../includes/db.php';

  // Count Users
  $user_count = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];

  // Count projects
  $project_count = $conn->query("SELECT COUNT(*) AS total FROM projects")->fetch_assoc()['total'];

  // Count Messages
  $message_count = $conn->query("SELECT COUNT(*) AS total FROM messages")->fetch_assoc()['total'];

  // Count Messages
  $skill_count = $conn->query("SELECT COUNT(*) AS total FROM skills")->fetch_assoc()['total'];
?>
        <div class="w-full p-6">
            <div class="w-full mb-6 flex justify-between items-center">
                <a href="dashboard.php" class="text-2xl font-bold">Dashboard</a>
                <a href="auth/logout.php" class="w-8 h-8 flex items-center justify-center border-2 border-red-400 hover:border-white bg-white hover:bg-red-400 text-red-500 hover:text-white p-1 rounded-full">
                    <i class="fa-solid fa-power-off"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-5 gap-4">
                <div class="bg-white shadow-md p-4 rounded-xl">
                    <h2 class="text-lg font-semibold">Total Projects</h2>
                    <p class="text-3xl font-bold mt-2"><?= $project_count ?></p>
                </div>

                <div class="bg-white shadow-md p-4 rounded-xl">
                    <h2 class="text-lg font-semibold">Total Users</h2>
                    <p class="text-3xl font-bold mt-2"><?= $user_count ?></p>
                </div>

                <div class="bg-white shadow-md p-4 rounded-xl">
                    <h2 class="text-lg font-semibold">Total Messages</h2>
                    <p class="text-3xl font-bold mt-2"><?= $message_count ?></p>
                </div>

                <div class="bg-white shadow-md p-4 rounded-xl">
                    <h2 class="text-lg font-semibold">Total Skills</h2>
                    <p class="text-3xl font-bold mt-2"><?= $skill_count ?></p>
                </div>
            </div>
        </div>