<?php
require_once '../includes/auth_check.php';
require_once '../includes/db.php';

$result = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
?>

<h2 class="text-xl font-bold mb-4">Contact Messages</h2>
<table class="w-full table-auto border-collapse">
  <thead>
    <tr class="bg-gray-200 text-left">
      <th class="p-2 border">Name</th>
      <th class="p-2 border">Email</th>
      <th class="p-2 border">Subject</th>
      <th class="p-2 border">Message</th>
      <th class="p-2 border">Date</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr class="border-t">
        <td class="p-2"><?= htmlspecialchars($row['name']) ?></td>
        <td class="p-2"><?= htmlspecialchars($row['email']) ?></td>
        <td class="p-2"><?= htmlspecialchars($row['subject']) ?></td>
        <td class="p-2"><?= nl2br(htmlspecialchars($row['message'])) ?></td>
        <td class="p-2"><?= $row['created_at'] ?></td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>
