<?php
session_start();
include('../config/db.php');

$id = $_POST['id'];
$qty = $_POST['qty'];

$result = $conn->query("SELECT * FROM products WHERE id = $id");
$product = $result->fetch_assoc();

$_SESSION['cart'][] = [
    'id' => $id,
    'name' => $product['name'],
    'price' => $product['price'],
    'qty' => $qty
];

header("Location: " . $_SERVER['HTTP_REFERER']);