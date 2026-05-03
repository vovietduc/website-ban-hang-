<?php 
include('../components/header.php');

$cart = $_SESSION['cart'] ?? [];

// tính tổng tiền
$total = 0;
foreach($cart as $item){
    $total += $item['price'] * $item['qty'];
}

// xử lý đặt hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $order = [
        'name' => $_POST['name'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address'],
        'date' => date('d/m/Y H:i'),
        'items' => $cart,
        'total' => $total // 🔥 thêm dòng này
    ];

    $_SESSION['orders'][] = $order;

    unset($_SESSION['cart']);

    echo "<script>alert('Đặt hàng thành công!'); window.location='orders.php';</script>";
}
?>

<div class="container mt-5">
    <div class="row">

        <!-- FORM -->
        <div class="col-md-7">
            <div class="card p-4 shadow-sm">
                <h3 class="mb-3">🧾 Thông tin đặt hàng</h3>

                <form method="POST">
                    <label>Họ tên</label>
                    <input name="name" class="form-control mb-3" required>

                    <label>Số điện thoại</label>
                    <input name="phone" class="form-control mb-3" required>

                    <label>Địa chỉ</label>
                    <input name="address" class="form-control mb-3" required>

                    <button class="btn btn-success w-100 mt-2">
                        Xác nhận đặt hàng
                    </button>
                </form>
            </div>
        </div>

        <!-- GIỎ HÀNG -->
        <div class="col-md-5">
            <div class="card p-4 shadow-sm">
                <h4 class="mb-3">🛒 Đơn hàng của bạn</h4>

                <?php if(empty($cart)){ ?>
                    <p>Giỏ hàng trống</p>
                <?php } else { ?>

                    <ul class="list-group mb-3">
                        <?php foreach($cart as $item){ ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><?= $item['name'] ?> (x<?= $item['qty'] ?>)</span>
                                <span>
                                    <?= number_format($item['price'] * $item['qty']) ?>đ
                                </span>
                            </li>
                        <?php } ?>
                    </ul>

                    <h5 class="text-end text-danger">
                        Tổng tiền: <?= number_format($total) ?>đ
                    </h5>

                <?php } ?>
            </div>
        </div>

    </div>
</div>