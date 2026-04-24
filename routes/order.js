const express = require("express");
const router = express.Router();

// 👉 DATA GIẢ (KHÔNG CẦN MONGODB)
let orders = [
    { id: 1, product: "Laptop", quantity: 2, status: "pending" },
    { id: 2, product: "Phone", quantity: 1, status: "pending" }
];

// Xem đơn hàng
router.get("/", (req, res) => {
    res.json(orders);
});

// Thêm đơn hàng
router.post("/add", (req, res) => {
    const newOrder = {
        id: Date.now(),
        ...req.body
    };
    orders.push(newOrder);
    res.send("Thêm đơn hàng OK");
});

// Cập nhật trạng thái
router.put("/:id", (req, res) => {
    const order = orders.find(o => o.id == req.params.id);
    if (order) {
        order.status = req.body.status;
    }
    res.send("Cập nhật OK");
});

// Xóa đơn hàng
router.delete("/:id", (req, res) => {
    orders = orders.filter(o => o.id != req.params.id);
    res.send("Đã xóa");
});

module.exports = router;