-- Xóa và tạo lại database
DROP DATABASE IF EXISTS website_ban_hang;
CREATE DATABASE website_ban_hang CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE website_ban_hang;

-- Bảng users (người dùng)
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  phone VARCHAR(20) DEFAULT NULL,
  address TEXT DEFAULT NULL,
  role ENUM('user','admin') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tài khoản admin mặc định: email=admin@shop.com | password=admin123
INSERT INTO users (name, email, password, role) VALUES
('Admin', 'admin@shop.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Bảng categories (danh mục)
CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description TEXT DEFAULT NULL
);

INSERT INTO categories (name, description) VALUES
('Áo nam',    'Các loại áo dành cho nam'),
('Áo nữ',    'Các loại áo dành cho nữ'),
('Quần nam',  'Các loại quần dành cho nam'),
('Quần nữ',  'Các loại quần dành cho nữ'),
('Giày dép',  'Giày, dép, sandal nam nữ'),
('Túi xách',  'Túi xách, balo, ví các loại');

-- Bảng products (sản phẩm)
CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_id INT NOT NULL,
  name VARCHAR(200) NOT NULL,
  price DECIMAL(15,0) NOT NULL,
  stock INT DEFAULT 0,
  image VARCHAR(255) DEFAULT 'default.jpg',
  description TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (category_id) REFERENCES categories(id)
);

INSERT INTO products (category_id, name, price, stock, description) VALUES
(1, 'Áo thun ',       150000, 100, 'Áo thun cổ tròn, chất cotton thoáng mát'),
(1, 'Áo sơ mi ',      250000,  50, 'Áo sơ mi nam công sở, dễ phối đồ'),
(1, 'Áo polo ',             220000,  60, 'Áo polo nam cổ bẻ, phong cách lịch lãm'),
(2, 'croptop',      120000,  80, 'Áo thun nữ ngắn, năng động trẻ trung'),
(2, 'Váy hoa nhí',      200000,  60, 'Áo kiểu nữ họa tiết hoa nhí dễ thương'),
(2, 'Áo dài tay nữ',           180000,  70, 'Áo dài tay nữ chất liệu mềm mại'),
(3, 'Quần jean nam ',       350000,  70, 'Quần jean nam form slim fit'),
(3, 'Quần short nam',          180000,  90, 'Quần short nam thể thao thoải mái'),
(4, 'Quần tây nữ ống rộng',    300000,  40, 'Quần tây nữ phong cách Hàn Quốc'),
(4, 'Quần jean nữ skinny',     320000,  55, 'Quần jean nữ ống bó, tôn dáng'),
(5, 'Giày sneaker ',      450000,  30, 'Giày sneaker unisex màu trắng basic'),
(5, 'Dép sandal nữ',           180000,  90, 'Dép sandal nữ quai ngang, đế bằng êm chân'),
(5, 'Giày lười nam',           380000,  45, 'Giày lười nam da PU lịch sự'),
(6, 'Túi xách nữ ',  420000,  35, 'Túi xách nữ da PU, nhiều ngăn tiện lợi'),
(6, 'Balo ',             350000,  50, 'Balo nam nữ chống nước, chứa laptop 15 inch'),
(6, 'Ví da',               220000,  60, 'Ví nam da bò thật, nhiều ngăn đựng thẻ');

-- Bảng carts (giỏ hàng)
CREATE TABLE carts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity INT DEFAULT 1,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Bảng orders (đơn hàng)
CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  name VARCHAR(100) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  address TEXT NOT NULL,
  total DECIMAL(15,0) NOT NULL,
  status ENUM('cho_xac_nhan','dang_giao','da_giao','da_huy') DEFAULT 'cho_xac_nhan',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Bảng order_items (chi tiết đơn hàng)
CREATE TABLE order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity INT NOT NULL,
  price DECIMAL(15,0) NOT NULL,
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
  FOREIGN KEY (product_id) REFERENCES products(id)
);
