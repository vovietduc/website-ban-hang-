<?php
session_start();
include("../../config/db.php");

if (!isset($_SESSION["user"])) {
    header("Location: ../../auth/login.php");
    exit();
}

$result = $conn->query("SELECT * FROM orders");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đơn hàng</title>
</head>
<body>

<h2>Đơn hàng</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Tổng tiền</th>
        <th>Trạng thái</th>
        <th>Cập nhật</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row["id"] ?></td>
            <td><?= $row["total_price"] ?></td>
            <td><?= $row["status"] ?></td>
            <td>
                <a href="update_status.php?id=<?= $row["id"] ?>&status=processing">Processing</a> |
                <a href="update_status.php?id=<?= $row["id"] ?>&status=done">Done</a>
            </td>
        </tr>
    <?php } ?>

</table>

</body>
</html>