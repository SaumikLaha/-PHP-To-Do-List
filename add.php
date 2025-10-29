<?php
// add.php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($title === '') {
        // Redirect back with error (simple)
        header('Location: index.php');
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO tasks (title, description) VALUES (:title, :description)");
    $stmt->execute(['title' => $title, 'description' => $description]);

    header('Location: index.php');
    exit;
}
header('Location: index.php');
exit;
