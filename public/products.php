<?php include('../components/header.php'); ?>
<?php include('../config/db.php'); ?>

<?php
$keyword = $_GET['keyword'] ?? '';

$sql = "SELECT * FROM products WHERE name LIKE '%$keyword%'";
$result = $conn->query($sql);
?>

<div class="container mt-4">

    <form class="mb-3">
        <input name="keyword" class="form-control" placeholder="Tìm sản phẩm">
    </form>

    <div class="row">
        <?php while($row = $result->fetch_assoc()){ ?>
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