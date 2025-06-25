<?php
include 'config.php';
$id = $_GET['id'];

// Hapus file foto dulu (opsional tapi baik dilakukan)
$result = $conn->query("SELECT photo FROM users WHERE id = $id");
if ($row = $result->fetch_assoc()) {
    $photo_path = "uploads/" . $row['photo'];
    if (file_exists($photo_path)) {
        unlink($photo_path);
    }
}

// Hapus user dari database
$conn->query("DELETE FROM users WHERE id = $id");

header("Location: users.php");
