<?php
$conn = new mysqli("localhost", "root", "", "crud_login");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
?>
