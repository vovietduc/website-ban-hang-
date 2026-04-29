c   <?php
require 'config.php';
require 'auth.php';

$error = $success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    $check = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
    mysqli_stmt_bind_param($check, "s", $email);
    mysqli_stmt_execute($check);
    mysqli_stmt_store_result($check);

    if (mysqli_stmt_num_rows($check) > 0) {
        $error = "Email này đã được dùng rồi!";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt   = mysqli_prepare($conn, "INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashed);
        mysqli_stmt_execute($stmt);
        $success = "Đăng ký thành công!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng ký</title>
</head>
<body class="bg-light">
    <h4 class="text-center mb-3"> Đăng ký tài khoản</h4>
    <?php if($error): ?>
      <div class="alert alert-dangebody class="bg-light">
      <div class="container" style="max-width:400px; margin-top:80px">
  <div class="card p-4 shadow">r"><?= $error ?></div>
    <?php endif; ?>
    <?php if($success): ?>
      <div class="alert alert-success"><?= $success ?> <a href="login.php">Đăng nhập ngay</a></div>
    <?php endif; ?>
    <form method="POST">
      <div class="mb-3">
        <label>Họ tên</label>
        <input type="text" name="name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Mật khẩu</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button class="btn btn-success w-100">Đăng ký</button>
    </form>
    <p class="text-center mt-3">Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
  </div>
</div>
</body>
</html>