<?php
require_once '../includes/auth_check.php';
require_once '../includes/db.php';

$result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
?>

<h1 class="text-2xl font-bold mb-4">Projects</h1>
<a href="create.php" class="bg-blue-500 text-white px-3 py-1 rounded mb-3 inline-block">+ Add Project</a>

<table class="w-full bg-white shadow rounded">
  <thead>
    <tr class="bg-gray-200">
      <th class="p-2">Title</th>
      <th class="p-2">Link</th>
      <th class="p-2">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr class="border-t">
      <td class="p-2"><?= htmlspecialchars($row['title']) ?></td>
      <td class="p-2"><a href="<?= $row['project_link'] ?>" target="_blank" class="text-blue-500">View</a></td>
      <td class="p-2">
        <a href="edit.php?id=<?= $row['id'] ?>" class="text-yellow-500">Edit</a> |
        <a href="delete.php?id=<?= $row['id'] ?>" class="text-red-500" onclick="return confirm('Delete this project?')">Delete</a>
      </td>
      <td>
        <img src="../uploads/<?= $row['image'] ?>" class="w-20 h-20 object-cover rounded" alt="<?= $row['title'] ?>">
      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
