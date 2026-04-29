<?php
// Nhúng file kết nối database và kiểm tra đăng nhập
require 'config.php';
require 'auth.php';

// Lấy tất cả sản phẩm từ database
$sql    = "SELECT p.*, c.name AS ten_danh_muc 
           FROM products p 
           JOIN categories c ON p.category_id = c.id";
$result = mysqli_query($conn, $sql);

$sql_dm    = "SELECT * FROM categories";
$result_dm = mysqli_query($conn, $sql_dm);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Shop Thời Trang</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">👗 Shop Thời Trang</a>
    <div>
      <?php if(isLoggedIn()): ?>
        <span class="text-white me-3">Xin chào, <?= $_SESSION['name'] ?>!</span>
        <?php if(isAdmin()): ?>
          <a href="admin/index.php" class="btn btn-warning btn-sm me-2">Trang Admin</a>
        <?php endif; ?>
        <a href="user/cart.php" class="btn btn-outline-light btn-sm me-2">🛒 Giỏ hàng</a>
        <a href="logout.php" class="btn btn-danger btn-sm">Đăng xuất</a>
      <?php else: ?>
        <a href="login.php" class="btn btn-outline-light btn-sm me-2">Đăng nhập</a>
        <a href="register.php" class="btn btn-success btn-sm">Đăng ký</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<!-- BANNER -->
<div class="bg-dark text-white text-center py-4 mb-4">
  <h2>🛍️ Thời Trang Nam Nữ</h2>
  <p class="mb-0">Quần áo - Giày dép - Túi xách</p>
</div>

<!-- NỘI DUNG CHÍNH -->
<div class="container mb-5">

  <!-- DANH MỤC LỌC -->
  <div class="mb-4 d-flex flex-wrap gap-2">
    <a href="index.php" class="btn btn-dark btn-sm">Tất cả</a>
    <?php while($dm = mysqli_fetch_assoc($result_dm)): ?>
      <a href="index.php?danh_muc=<?= $dm['id'] ?>" class="btn btn-outline-dark btn-sm">
        <?= $dm['name'] ?>
      </a>
    <?php endwhile; ?>
  </div>

  <!-- DANH SÁCH SẢN PHẨM -->
  <div class="row">
    <?php while($sp = mysqli_fetch_assoc($result)): ?>
    <div class="col-6 col-md-3 mb-4">
      <div class="card h-100 shadow-sm">

        <!-- Hình sản phẩm -->
        <img src="assets/images/<?= $sp['image'] ?>"
             class="card-img-top"
             style="height:200px; object-fit:cover;"
             onerror="this.src='https://placehold.co/300x200?text=No+Image'">

        <div class="card-body">
          <!-- Danh mục -->
          <span class="badge bg-secondary mb-1"><?= $sp['ten_danh_muc'] ?></span>

          <!-- Tên sản phẩm -->
          <h6 class="card-title"><?= $sp['name'] ?></h6>

          <!-- Giá -->
          <p class="text-danger fw-bold mb-2">
            <?= number_format($sp['price']) ?> đ
          </p>

          <!-- Nút xem chi tiết -->
          <a href="user/product_detail.php?id=<?= $sp['id'] ?>"
             class="btn btn-dark btn-sm w-100">
            Xem chi tiết
          </a>
        </div>

      </div>
    </div>
    <?php endwhile; ?>
  </div>

</div>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-3">
  <p class="mb-0"> 2026 Shop Thời Trang - Nhóm thực hiện</p>
</footer>

</body>
</html>