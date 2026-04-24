const express = require("express");
const mongoose = require("mongoose");
const bodyParser = require("body-parser");
const cors = require("cors");

const app = express();

// ======================
// 🔧 MIDDLEWARE
// ======================
app.use(cors());
app.use(bodyParser.json());
app.use(express.static("public"));

// ======================
// 🔌 KẾT NỐI MONGODB
// ======================
mongoose.connect("mongodb://127.0.0.1:27017/admin-system")
.then(() => console.log("✅ MongoDB connected"))
.catch(err => console.log("❌ MongoDB error:", err));

// ======================
// 📦 ROUTES
// ======================
const productRoute = require("./routes/product");
const userRoute = require("./routes/user");
const orderRoute = require("./routes/order");
const statsRoute = require("./routes/stats");

// ======================
// 🚀 USE ROUTES
// ======================
app.use("/products", productRoute);
app.use("/users", userRoute);
app.use("/orders", orderRoute);
app.use("/stats", statsRoute);

// ======================
// 🌐 TEST SERVER
// ======================
app.get("/", (req, res) => {
    res.send("🚀 Admin System Running...");
});

// ======================
// 🚀 START SERVER
// ======================
app.listen(3000, () => {
    console.log("🔥 Server chạy tại: http://localhost:3000");
});