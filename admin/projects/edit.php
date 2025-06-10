<?php
session_start();
require_once '../includes/auth_check.php';
require_once '../includes/db.php';

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
        move_uploaded_file($image_tmp, '../uploads/' . $image_name);

        if ($project['image'] && file_exists('../uploads/' . $project['image'])) {
            unlink('../uploads/' . $project['image']);
        }
    }

    $stmt = $conn->prepare("UPDATE projects SET title=?, description=?, project_link=?, image=? WHERE id=?");
    $stmt->bind_param("ssssi", $title, $description, $project_link, $image_name, $id);
    $stmt->execute();

    $_SESSION['success'] = "Project updated successfully!";
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

<h2 class="text-xl font-bold mb-4">Edit Project</h2>
<form method="POST" enctype="multipart/form-data" class="space-y-3">
  <input name="title" value="<?= $project['title'] ?>" required class="w-full border p-2 rounded">
  <textarea name="description" class="w-full border p-2 rounded"><?= $project['description'] ?></textarea>
  <input name="project_link" value="<?= $project['project_link'] ?>" class="w-full border p-2 rounded">
  <div>
    <label>Current Image:</label><br>
    <?php if ($project['image']): ?>
      <img src="../uploads/<?= $project['image'] ?>" class="w-32 h-32 object-cover mb-2">
    <?php endif; ?>
    <input type="file" name="image" accept="image/*" class="w-full border p-2 rounded">
  </div>
  <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
</form>