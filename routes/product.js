const express = require("express");
const router = express.Router();
const Product = require("../models/Product");

// Xem tất cả sản phẩm
router.get("/", async (req, res) => {
    const data = await Product.find();
    res.json(data);
});

// Thêm sản phẩm
router.post("/add", async (req, res) => {
    const p = new Product(req.body);
    await p.save();
    res.send("Đã thêm sản phẩm");
});

// Sửa sản phẩm
router.put("/:id", async (req, res) => {
    await Product.findByIdAndUpdate(req.params.id, req.body);
    res.send("Đã sửa sản phẩm");
});

// Xóa sản phẩm
router.delete("/:id", async (req, res) => {
    await Product.findByIdAndDelete(req.params.id);
    res.send("Đã xóa sản phẩm");
});

module.exports = router;