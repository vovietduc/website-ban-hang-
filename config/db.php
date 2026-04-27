<?php
$conn = new mysqli("localhost", "root", "", "admin_system");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>