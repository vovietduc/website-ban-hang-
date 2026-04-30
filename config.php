<?php
$conn = mysqli_connect('localhost', 'root', '', 'website_ban_hang');
mysqli_set_charset($conn, 'utf8mb4');
if (!$conn) {
    die("loi ket noi database!");
}
?>