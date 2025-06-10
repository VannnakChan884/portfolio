<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
  <form action="login_process.php" method="POST" class="bg-white p-6 rounded shadow-md w-full max-w-sm">
    <h2 class="text-xl font-bold mb-4">Admin Login</h2>

    <?php if (isset($_SESSION['error'])): ?>
      <p class="text-red-500 text-sm mb-3"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <input type="text" name="username" placeholder="Username" required class="w-full mb-3 px-3 py-2 border rounded">
    <input type="password" name="password" placeholder="Password" required class="w-full mb-3 px-3 py-2 border rounded">
    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Login</button>
  </form>
</body>
</html>
