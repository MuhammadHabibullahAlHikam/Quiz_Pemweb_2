<?php include 'config.php';
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$photo = $_FILES['photo'];

$photo_name = uniqid() . "_" . $photo['name'];
move_uploaded_file($photo['tmp_name'], "uploads/$photo_name");

$stmt = $conn->prepare("INSERT INTO users (username, password, photo) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $password, $photo_name);
$stmt->execute();
header("Location: users.php");
