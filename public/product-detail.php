<?php include('../components/header.php'); ?>
<?php include('../config/db.php'); ?>

<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id = $id");
$product = $result->fetch_assoc();
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <img src="<?= $product['image'] ?>" class="img-fluid">
        </div>

        <div class="col-md-6">
            <h2><?= $product['name'] ?></h2>
            <h4><?= $product['price'] ?>đ</h4>

            <form action="add-to-cart.php" method="POST">
                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                <input type="number" name="qty" value="1" class="form-control w-25 mb-2">

                <button class="btn btn-success">Thêm vào giỏ</button>
            </form>
        </div>
    </div>
</div>