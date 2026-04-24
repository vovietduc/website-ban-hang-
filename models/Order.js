const mongoose = require("mongoose");

const orderSchema = new mongoose.Schema({
    product: {
        type: String,
        required: true
    },
    quantity: {
        type: Number,
        default: 1
    },
    status: {
        type: String,
        default: "pending" // pending | done | cancel
    }
}, {
    timestamps: true
});

// tránh lỗi trùng model (QUAN TRỌNG)
module.exports = mongoose.models.Order || mongoose.model("Order", orderSchema);