<?php
session_start();
require_once '../includes/auth_check.php';
require_once '../includes/db.php';

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
        move_uploaded_file($image_tmp, '../uploads/' . $image_name);
    }

    $stmt = $conn->prepare("INSERT INTO projects (title, description, project_link, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $project_link, $image_name);
    $stmt->execute();

    $_SESSION['success'] = "Project created successfully!";
    header("Location: index.php");
    exit();
}
?>

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

<h2 class="text-xl font-bold mb-4">Add Project</h2>
<form method="POST" enctype="multipart/form-data" class="space-y-3">
  <input name="title" placeholder="Title" required class="w-full border p-2 rounded">
  <textarea name="description" placeholder="Description" required class="w-full border p-2 rounded"></textarea>
  <input name="project_link" placeholder="Project Link" class="w-full border p-2 rounded">
  <input type="file" name="image" accept="image/*" class="w-full border p-2 rounded">
  <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
</form>