<?php include 'config.php';
$result = $conn->query("SELECT * FROM users");
?>
<a href="user_create.php">Tambah User</a>
<table border="1">
  <tr><th>Foto</th><th>Username</th><th>Aksi</th></tr>
  <?php while ($row = $result->fetch_assoc()): ?>
  <tr>
    <td><img src="uploads/<?= $row['photo'] ?>" width="50"></td>
    <td><?= $row['username'] ?></td>
    <td>
      <a href="user_edit.php?id=<?= $row['id'] ?>">Edit</a> |
      <a href="user_delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
    </td>
  </tr>
  <?php endwhile; ?>
</table>
