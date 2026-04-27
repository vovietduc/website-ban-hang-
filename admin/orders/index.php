<?php include "../../config/db.php";

$result = $conn->query("SELECT * FROM orders");
?>

<h2>Đơn hàng</h2>

<table class="table table-bordered bg-white">
<thead class="table-dark">
<tr>
    <th>ID</th>
    <th>Tổng tiền</th>
    <th>Trạng thái</th>
    <th>Cập nhật</th>
</tr>
</thead>

<tbody>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= number_format($row['total']) ?></td>
    <td>
        <span class="badge bg-info"><?= $row['status'] ?></span>
    </td>
    <td>
        <form action="update_status.php" method="POST" class="d-flex gap-2">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <select name="status" class="form-select">
                <option value="pending" <?= $row['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="processing" <?= $row['status'] === 'processing' ? 'selected' : '' ?>>Processing</option>
                <option value="completed" <?= $row['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                <option value="cancelled" <?= $row['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
            </select>
            <button class="btn btn-primary btn-sm">OK</button>
        </form>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>