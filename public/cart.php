<?php include('../components/header.php'); ?>

<?php $cart = $_SESSION['cart'] ?? []; ?>

<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h3 class="mb-4">🛒 Giỏ hàng</h3>

        <?php if(empty($cart)){ ?>
            <p>Giỏ hàng trống</p>
        <?php } else { ?>

        <table class="table align-middle">
            <tr>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>SL</th>
                <th>Thành tiền</th>
                <th></th>
            </tr>

            <?php 
            $total = 0;
            foreach($cart as $index => $item){ 
                $subtotal = $item['price'] * $item['qty'];
                $total += $subtotal;
            ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= number_format($item['price']) ?>đ</td>
                <td><?= $item['qty'] ?></td>
                <td><?= number_format($subtotal) ?>đ</td>

                <td>
                    <a href="remove-cart.php?index=<?= $index ?>" 
                       class="btn btn-danger btn-sm">
                       Xóa
                    </a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <h4 class="text-end">
            Tổng tiền: <span class="text-danger"><?= number_format($total) ?>đ</span>
        </h4>

        <a href="checkout.php" class="btn btn-success float-end mt-3">
            Thanh toán
        </a>

        <?php } ?>
    </div>
</div>