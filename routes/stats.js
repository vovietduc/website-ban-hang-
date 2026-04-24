const express = require("express");
const router = express.Router();
const Order = require("../models/Order");

// ======================
// 📊 THỐNG KÊ
// ======================
router.get("/", async (req, res) => {
    try {
        const totalOrders = await Order.countDocuments();

        const orders = await Order.find();

        // giả lập doanh thu (mỗi đơn 100k)
        let revenue = 0;
        orders.forEach(o => {
            revenue += (o.quantity || 0) * 100000;
        });

        res.json({
            totalOrders,
            revenue
        });

    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

module.exports = router;