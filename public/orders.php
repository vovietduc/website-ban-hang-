<?php 
include('../components/header.php');

$orders = $_SESSION['orders'] ?? [];
?>

<div class="container mt-5">
    <h2 class="mb-4">📦 Lịch sử đơn hàng</h2>

    <?php if(empty($orders)){ ?>
        <p>Chưa có đơn hàng</p>
    <?php } else { ?>

        <?php foreach($orders as $order){ ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <h5>🧾 Đơn hàng</h5>
                        <small><?= $order['date'] ?></small>
                    </div>

                    <hr>

                    <p><strong>👤 <?= $order['name'] ?></strong></p>
                    <p>📞 <?= $order['phone'] ?></p>
                    <p>📍 <?= $order['address'] ?></p>

                    <ul class="list-group mb-3">
                        <?php foreach($order['items'] as $item){ ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><?= $item['name'] ?> (x<?= $item['qty'] ?>)</span>
                                <span><?= number_format($item['price'] * $item['qty']) ?>đ</span>
                            </li>
                        <?php } ?>
                    </ul>

                    <h5 class="text-end text-danger">
                        Tổng: <?= number_format($order['total']) ?>đ
                    </h5>

                </div>
            </div>
        <?php } ?>

    <?php } ?>
</div>