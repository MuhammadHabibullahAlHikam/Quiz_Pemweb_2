<?php include 'config.php'; 
if (!isset($_SESSION['user_id'])) header("Location: login.php");
?>
<h1>Dashboard</h1>
<a href="users.php">Kelola User</a> | <a href="logout.php">Logout</a>
