<?php
session_start();

$index = $_GET['index'];

if (isset($_SESSION['cart'][$index])) {
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // re-index
}

header("Location: cart.php");