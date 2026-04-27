<?php
include "../../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];

    $stmt = $conn->prepare("INSERT INTO products (name, price, stock) VALUES (?, ?, ?)");
    $stmt->bind_param("sdi", $name, $price, $stock);
    $stmt->execute();

    header("Location: index.php");
}
?>

<form method="POST">
    Tên: <input name="name"><br>
    Giá: <input name="price"><br>
    Kho: <input name="stock"><br>
    <button>Thêm</button>
</form>