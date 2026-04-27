<?php
session_start();
include("../../config/db.php");

if (!isset($_SESSION["user"])) {
    header("Location: ../../auth/login.php");
    exit();
}

$result = $conn->query("SELECT id, email FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
</head>
<body>

<h2>Danh sách người dùng</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Email</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row["id"] ?></td>
            <td><?= $row["email"] ?></td>
        </tr>
    <?php } ?>

</table>

</body>
</html>