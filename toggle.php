<?php
// toggle.php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id'] ?? 0);
    if ($id > 0) {
        // get current value
        $stmt = $pdo->prepare("SELECT is_done FROM tasks WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $task = $stmt->fetch();
        if ($task) {
            $new = $task['is_done'] ? 0 : 1;
            $upd = $pdo->prepare("UPDATE tasks SET is_done = :new WHERE id = :id");
            $upd->execute(['new' => $new, 'id' => $id]);
        }
    }
}
header('Location: index.php');
exit;
