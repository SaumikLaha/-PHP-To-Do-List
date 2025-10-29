<?php
// edit.php
require 'db.php';
$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: index.php'); exit;
}
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
$stmt->execute(['id' => $id]);
$task = $stmt->fetch();
if (!$task) {
    header('Location: index.php'); exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Task</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="container">
    <h1>Edit Task</h1>
    <form action="update.php" method="post">
      <input type="hidden" name="id" value="<?= $task['id'] ?>">
      <div class="form-row">
        <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
        <button type="submit" class="edit">Update</button>
      </div>
      <div class="form-row">
        <textarea name="description" rows="4"><?= htmlspecialchars($task['description']) ?></textarea>
      </div>
    </form>
    <p><a href="index.php">← Back</a></p>
  </div>
</body>
</html>
