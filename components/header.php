<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// tính tổng số lượng trong giỏ
$cart = $_SESSION['cart'] ?? [];
$count = 0;

foreach ($cart as $item) {
    $count += $item['qty'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shop</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="index.php">🛍 Shop</a>

        <!-- Menu -->
        <div class="d-flex gap-2">

            <a href="products.php" class="btn btn-outline-light">
                Sản phẩm
            </a>

            <a href="orders.php" class="btn btn-outline-light">
                📦 Đơn hàng
            </a>

            <!-- Giỏ hàng + badge -->
            <a href="cart.php" class="btn btn-light position-relative">
                🛒 Giỏ hàng

                <?php if ($count > 0) { ?>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?= $count ?>
                    </span>
                <?php } ?>
            </a>

        </div>

    </div>
</nav>