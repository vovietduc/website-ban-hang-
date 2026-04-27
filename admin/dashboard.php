<?php
session_start();
include("../config/db.php");

// Kiểm tra đăng nhập
if (!isset($_SESSION["user"])) {
    header("Location: ../auth/login.php");
    exit();
}

// Thống kê
$totalUsers = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()["total"];
$totalProducts = $conn->query("SELECT COUNT(*) as total FROM products")->fetch_assoc()["total"];
$totalOrders = $conn->query("SELECT COUNT(*) as total FROM orders")->fetch_assoc()["total"];

// Doanh thu (giả sử bảng orders có cột total_price)
$revenue = $conn->query("SELECT SUM(total_price) as total FROM orders")->fetch_assoc()["total"];
if ($revenue == null) $revenue = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            margin: 0;
        }
        .header {
            background: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .container {
            padding: 20px;
        }
        .cards {
            display: flex;
            gap: 20px;
        }
        .card {
            flex: 1;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ddd;
            text-align: center;
        }
        .card h2 {
            margin: 0;
            color: #007bff;
        }
        .menu {
            margin-top: 20px;
        }
        .menu a {
            display: inline-block;
            margin: 10px;
            padding: 10px 15px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout {
            float: right;
            background: red;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Dashboard Admin</h1>
    <a class="logout" href="../auth/logout.php">Đăng xuất</a>
</div>

<div class="container">

    <div class="cards">
        <div class="card">
            <h3>Users</h3>
            <h2><?php echo $totalUsers; ?></h2>
        </div>

        <div class="card">
            <h3>Sản phẩm</h3>
            <h2><?php echo $totalProducts; ?></h2>
        </div>

        <div class="card">
            <h3>Đơn hàng</h3>
            <h2><?php echo $totalOrders; ?></h2>
        </div>

        <div class="card">
            <h3>Doanh thu</h3>
            <h2><?php echo number_format($revenue); ?> VND</h2>
        </div>
    </div>

    <div class="menu">
        <a href="products/index.php">Quản lý sản phẩm</a>
        <a href="orders/index.php">Quản lý đơn hàng</a>
        <a href="users/index.php">Quản lý người dùng</a>
    </div>

</div>

</body>
</html>