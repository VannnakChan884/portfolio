<?php
require_once '../includes/auth_check.php';
require_once '../includes/db.php';

$id = 1; // Always the same profile

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $title = trim($_POST['title']);
    $bio = trim($_POST['bio']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    // Image upload
    $profile_image = $_POST['old_image'];
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['profile_image'];
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])) {
            $filename = 'profile_' . time() . '.' . $ext;
            move_uploaded_file($file['tmp_name'], '../uploads/' . $filename);
            $profile_image = $filename;
        } else {
            $_SESSION['error'] = 'Invalid image format.';
            header("Location: profile.php");
            exit();
        }
    }

    $stmt = $conn->prepare("UPDATE profile SET name=?, title=?, bio=?, email=?, phone=?, profile_image=? WHERE id=?");
    $stmt->bind_param("ssssssi", $name, $title, $bio, $email, $phone, $profile_image, $id);
    $stmt->execute();

    $_SESSION['success'] = "Profile updated successfully.";
    header("Location: profile.php");
    exit();
}

// Get profile data
$result = $conn->query("SELECT * FROM profile WHERE id = $id");
$profile = $result->fetch_assoc();
?>

<!-- Notifications -->
<?php if (isset($_SESSION['error'])): ?>
  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>
<?php if (isset($_SESSION['success'])): ?>
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>

<!-- Profile Edit Form -->
<form action="profile.php" method="POST" enctype="multipart/form-data" class="space-y-4">
  <div>
    <label>Name</label>
    <input type="text" name="name" value="<?= htmlspecialchars($profile['name']) ?>" class="border p-2 w-full rounded" required>
  </div>
  <div>
    <label>Title</label>
    <input type="text" name="title" value="<?= htmlspecialchars($profile['title']) ?>" class="border p-2 w-full rounded">
  </div>
  <div>
    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($profile['email']) ?>" class="border p-2 w-full rounded">
  </div>
  <div>
    <label>Phone</label>
    <input type="text" name="phone" value="<?= htmlspecialchars($profile['phone']) ?>" class="border p-2 w-full rounded">
  </div>
  <div>
    <label>Bio</label>
    <textarea name="bio" class="border p-2 w-full rounded"><?= htmlspecialchars($profile['bio']) ?></textarea>
  </div>
  <div>
    <label>Profile Image</label><br>
    <?php if ($profile['profile_image']): ?>
      <img src="../uploads/<?= $profile['profile_image'] ?>" class="h-20 rounded-full mb-2">
    <?php endif; ?>
    <input type="file" name="profile_image" accept="image/*" class="border p-2 w-full rounded">
    <input type="hidden" name="old_image" value="<?= $profile['profile_image'] ?>">
  </div>
  <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Profile</button>
</form>
