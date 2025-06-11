<?php
require_once '../../includes/auth_check.php';
require_once '../../includes/db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$project = $stmt->get_result()->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $project_link = $_POST['project_link'];
    $image_name = $project['image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 2 * 1024 * 1024;

        $image_type = $_FILES['image']['type'];
        $image_size = $_FILES['image']['size'];
        $image_tmp = $_FILES['image']['tmp_name'];

        if (!in_array($image_type, $allowed_types)) {
            $_SESSION['error'] = "Only JPG, PNG, and GIF files are allowed.";
            header("Location: edit.php?id=$id");
            exit();
        }

        if ($image_size > $max_size) {
            $_SESSION['error'] = "Image must be smaller than 2MB.";
            header("Location: edit.php?id=$id");
            exit();
        }

        $image_name = uniqid() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($image_tmp, '../../uploads/' . $image_name);

        if ($project['image'] && file_exists('../../uploads/' . $project['image'])) {
            unlink('../../uploads/' . $project['image']);
        }
    }

    $stmt = $conn->prepare("UPDATE projects SET title=?, description=?, project_link=?, image=? WHERE id=?");
    $stmt->bind_param("ssssi", $title, $description, $project_link, $image_name, $id);
    $stmt->execute();

    $_SESSION['success'] = "Project updated successfully!";
    header("Location: ../../");
    exit();
}
?>

<?php if (isset($_SESSION['error'])): ?>
  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
    <?= $_SESSION['error'] ?>
  </div>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>

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
        <h2 class="text-xl font-bold mb-4">Edit Project</h2>
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

    <input type="text" name="title" value="<?= $project['title'] ?>" required class="w-full mb-3 px-3 py-2 border rounded">
    <textarea name="description" placeholder="Description" required class="w-full border p-2 rounded"><?= $project['description'] ?></textarea>
    <input type="text" name="project_link" value="<?= $project['project_link'] ?>" class="w-full mb-3 px-3 py-2 border rounded">
    <div>
      <label>Current Image:</label><br>
      <?php if ($project['image']): ?>
        <img src="../../uploads/<?= $project['image'] ?>" class="w-32 h-32 object-cover mb-2">
      <?php endif; ?>
      <input type="file" name="image" accept="image/*" class="w-full border mb-3 py-2 rounded">
    </div>
    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
  </form>
</body>
</html>