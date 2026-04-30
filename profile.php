<?php
// Nhúng file kết nối và kiểm tra đăng nhập
require 'config.php';
require 'auth.php';

// Nếu chưa đăng nhập thì chuyển về trang login
requireLogin();

// Lấy thông tin người dùng hiện tại
$id  = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);
$user   = mysqli_fetch_assoc($result);

$success = $error = '';

// Khi người dùng bấm lưu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']);
    $phone   = trim($_POST['phone']);
    $address = trim($_POST['address']);

    // Cập nhật thông tin vào database
    $sql = "UPDATE users SET name='$name', phone='$phone', address='$address' WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['name'] = $name; // Cập nhật tên trên session
        $success = "Cập nhật thông tin thành công!";
    } else {
        $error = "Có lỗi xảy ra, vui lòng thử lại!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Hồ sơ cá nhân</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<!-- THANH MENU -->
<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php"> Shop Thời Trang</a>
    <div>
      <span class="text-white me-3"><?= $_SESSION['name'] ?></span>
      <a href="logout.php" class="btn btn-danger btn-sm">Đăng xuất</a>
    </div>
  </div>
</nav>

<!-- NỘI DUNG -->
<div class="container mt-4" style="max-width: 500px">
  <div class="card shadow-sm p-4">
    <h5 class="mb-3"> Hồ sơ cá nhân</h5>

    <?php if($success): ?>
      <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <?php if($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <!-- Họ tên -->
      <div class="mb-3">
        <label>Họ tên</label>
        <input type="text" name="name" class="form-control"
               value="<?= $user['name'] ?>" required>
      </div>

      <!-- Email (không cho sửa) -->
      <div class="mb-3">
        <label>Email</label>
        <input type="email" class="form-control"
               value="<?= $user['email'] ?>" disabled>
      </div>

      <!-- Số điện thoại -->
      <div class="mb-3">
        <label>Số điện thoại</label>
        <input type="text" name="phone" class="form-control"
               value="<?= $user['phone'] ?>">
      </div>

      <!-- Địa chỉ -->
      <div class="mb-3">
        <label>Địa chỉ</label>
        <textarea name="address" class="form-control" rows="2"><?= $user['address'] ?></textarea>
      </div>

      <button class="btn btn-dark w-100">Lưu thông tin</button>
    </form>

  </div>
</div>

</body>
</html>