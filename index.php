<?php
// index.php
require 'db.php';

// fetch tasks
$stmt = $pdo->query("SELECT * FROM tasks ORDER BY created_at DESC");
$tasks = $stmt->fetchAll();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>PHP To-Do List</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="container">
    <h1>To-Do List</h1>

    <!-- Add form -->
    <form action="add.php" method="post">
      <div class="form-row">
        <input type="text" name="title" placeholder="Task title" required>
        <button type="submit" class="add">Add</button>
      </div>
      <div class="form-row">
        <textarea name="description" rows="2" placeholder="Description (optional)"></textarea>
      </div>
    </form>

    <!-- Tasks -->
    <div class="tasks">
      <?php if(empty($tasks)): ?>
        <p>No tasks yet. Add one above.</p>
      <?php else: ?>
        <?php foreach($tasks as $task): ?>
          <div class="task <?php if($task['is_done']) echo 'done'; ?>">
            <div class="left">
              <div>
                <div class="title"><?= htmlspecialchars($task['title']) ?></div>
                <div class="small"><?= htmlspecialchars($task['description']) ?></div>
                <div class="small">Created: <?= $task['created_at'] ?></div>
              </div>
            </div>
            <div class="actions">
              <!-- Toggle complete -->
              <form action="toggle.php" method="post" style="display:inline">
                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                <button type="submit" class="toggle"><?= $task['is_done'] ? 'Undo' : 'Done' ?></button>
              </form>

              <!-- Edit -->
              <form action="edit.php" method="get" style="display:inline">
                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                <button type="submit" class="edit">Edit</button>
              </form>

              <!-- Delete -->
              <form action="delete.php" method="post" style="display:inline" onsubmit="return confirm('Are you sure?');">
                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                <button type="submit" class="delete">Delete</button>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
