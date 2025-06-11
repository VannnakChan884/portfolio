<?php
session_start();
require_once '../../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $project_link = $_POST['project_link'];

    $image_name = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 2 * 1024 * 1024; // 2 MB

        $image_type = $_FILES['image']['type'];
        $image_size = $_FILES['image']['size'];
        $image_tmp = $_FILES['image']['tmp_name'];

        if (!in_array($image_type, $allowed_types)) {
            $_SESSION['error'] = "Only JPG, PNG, and GIF files are allowed.";
            header("Location: create.php");
            exit();
        }

        if ($image_size > $max_size) {
            $_SESSION['error'] = "Image must be smaller than 2MB.";
            header("Location: create.php");
            exit();
        }

        $image_name = uniqid() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($image_tmp, '../../uploads/' . $image_name);
    }

    $stmt = $conn->prepare("INSERT INTO projects (title, description, project_link, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $project_link, $image_name);
    $stmt->execute();

    $_SESSION['success'] = "Project created successfully!";
    header("Location: ../../");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body class="flex items-center justify-center h-screen bg-gray-100">
  <form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md w-full max-w-lg">
    <div class="w-full mb-6 flex justify-between items-center">
        <a href="../../" class="w-8 h-8 flex items-center justify-center border-2 border-gray-400 hover:border-white bg-white hover:bg-gray-400 text-gray-500 hover:text-white p-1 rounded-full">
          <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h2 class="text-xl font-bold mb-4">Add Project</h2>
    </div>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <?= $_SESSION['error'] ?>
      </div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        <?= $_SESSION['success'] ?>
      </div>
      <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <input type="text" name="title" placeholder="Title" required class="w-full mb-3 px-3 py-2 border rounded">
    <textarea name="description" placeholder="Description" required class="w-full border p-2 rounded"></textarea>
    <input type="text" name="project_link" placeholder="Project Link" class="w-full mb-3 px-3 py-2 border rounded">
    <input type="file" name="image" accept="image/*" class="w-full border mb-3 py-2 rounded">
    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
  </form>
</body>
</html>