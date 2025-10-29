<?php
// update.php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id'] ?? 0);
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($id > 0 && $title !== '') {
        $stmt = $pdo->prepare("UPDATE tasks SET title = :title, description = :desc WHERE id = :id");
        $stmt->execute(['title' => $title, 'desc' => $description, 'id' => $id]);
    }
}
header('Location: index.php');
exit;
