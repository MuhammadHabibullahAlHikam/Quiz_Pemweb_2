<?php
include 'config.php';
$id = $_GET['id'];

$result = $conn->query("SELECT * FROM users WHERE id = $id");
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $photo_name = $user['photo'];

    // Jika ada file baru diupload
    if ($_FILES['photo']['name']) {
        $photo = $_FILES['photo'];
        $photo_name = uniqid() . "_" . $photo['name'];
        move_uploaded_file($photo['tmp_name'], "uploads/$photo_name");
    }

    // Jika password diisi, hash ulang
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET username=?, password=?, photo=? WHERE id=?");
        $stmt->bind_param("sssi", $username, $password, $photo_name, $id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET username=?, photo=? WHERE id=?");
        $stmt->bind_param("ssi", $username, $photo_name, $id);
    }

    $stmt->execute();
    header("Location: users.php");
    exit;
}
?>

<h2>Edit User</h2>
<form method="POST" enctype="multipart/form-data">
  <input name="username" value="<?= $user['username'] ?>" required>
  <input name="password" type="password" placeholder="Kosongkan jika tidak diganti">
  <p>Foto saat ini:</p>
  <img src="uploads/<?= $user['photo'] ?>" width="100">
  <br><br>
  <input type="file" name="photo">
  <br><br>
  <button type="submit">Simpan Perubahan</button>
</form>
