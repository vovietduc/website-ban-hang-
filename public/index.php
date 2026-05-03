<?php
include('../config/db.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<?php include('../components/header.php'); ?>

<div class="container mt-4">
    <h2>Sản phẩm</h2>

    <div class="row">
        <?php
        $result = $conn->query("SELECT * FROM products");

        while($row = $result->fetch_assoc()){
        ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?= $row['image'] ?>" class="card-img-top">

                    <div class="card-body">
                        <h5><?= $row['name'] ?></h5>
                        <p><?= $row['price'] ?>đ</p>

                        <a href="product-detail.php?id=<?= $row['id'] ?>" class="btn btn-primary">
                            Xem
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>