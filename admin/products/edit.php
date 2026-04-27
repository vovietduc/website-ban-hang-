<?php
include "../../config/db.php";

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id=$id");
$product = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];

    $stmt = $conn->prepare("UPDATE products SET name=?, price=?, stock=? WHERE id=?");
    $stmt->bind_param("sdii", $name, $price, $stock, $id);
    $stmt->execute();

    header("Location: index.php");
}
?>

<form method="POST">
    Tên: <input name="name" value="<?= $product['name'] ?>"><br>
    Giá: <input name="price" value="<?= $product['price'] ?>"><br>
    Kho: <input name="stock" value="<?= $product['stock'] ?>"><br>
    <button>Lưu</button>
</form>