-- Membuat database
CREATE DATABASE order_system;

-- Menggunakan database yang baru dibuat
USE order_system;

-- Membuat tabel orders
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    customer_email VARCHAR(255) NOT NULL,
    customer_phone VARCHAR(20),
    order_message TEXT NOT NULL,
    quantity INT DEFAULT 1,
    price DECIMAL(10, 2) DEFAULT 10000.00,
    status VARCHAR(20) DEFAULT 'New'
);
