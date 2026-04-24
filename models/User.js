const mongoose = require("mongoose");

const userSchema = new mongoose.Schema({
    username: {
        type: String,
        required: true
    },
    password: {
        type: String,
        required: true
    },
    role: {
        type: String,
        default: "user"
    }
});

// tránh lỗi trùng model
module.exports = mongoose.models.User || mongoose.model("User", userSchema);