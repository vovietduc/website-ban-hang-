const express = require("express");
const router = express.Router();
const User = require("../models/User");

// ======================
// 👤 XEM USER
// ======================
router.get("/", async (req, res) => {
    const users = await User.find();
    res.json(users);
});

// ======================
// ➕ THÊM USER
// ======================
router.post("/add", async (req, res) => {
    const user = new User(req.body);
    await user.save();
    res.send("Thêm user thành công");
});

// ======================
// ❌ XOÁ USER
// ======================
router.delete("/:id", async (req, res) => {
    await User.findByIdAndDelete(req.params.id);
    res.send("Xoá user thành công");
});

module.exports = router;