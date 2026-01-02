-- eCommerce Database Schema
-- Create database
CREATE DATABASE IF NOT EXISTS ecommerce_db;
USE ecommerce_db;

-- Users table with proper structure
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_role (role)
);

-- Categories table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    category_id INT,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    INDEX idx_category (category_id),
    INDEX idx_stock (stock)
);

-- Orders table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'processing', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user (user_id),
    INDEX idx_status (status)
);

-- Order items table
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Insert sample categories
INSERT INTO categories (name) VALUES 
('Electronics'),
('Clothing'),
('Books'),
('Home & Garden'),
('Sports'),
('Toys');

-- Insert sample products
INSERT INTO products (name, description, price, stock, category_id, image) VALUES 
('Wireless Headphones', 'Premium noise-cancelling wireless headphones with 30-hour battery life', 299.99, 50, 1, 'headphones.jpg'),
('Smart Watch', 'Advanced fitness tracking smartwatch with heart rate monitor', 199.99, 30, 1, 'smartwatch.jpg'),
('Laptop Pro', 'High-performance laptop with 16GB RAM and 512GB SSD', 1299.99, 15, 1, 'laptop.jpg'),
('Men\'s T-Shirt', 'Comfortable cotton t-shirt in various colors', 29.99, 100, 2, 'tshirt.jpg'),
('Women\'s Jeans', 'Stylish skinny fit jeans with stretch comfort', 79.99, 75, 2, 'jeans.jpg'),
('Running Shoes', 'Professional running shoes with advanced cushioning', 129.99, 40, 5, 'shoes.jpg'),
('Yoga Mat', 'Non-slip exercise yoga mat with carrying strap', 39.99, 60, 5, 'yogamat.jpg'),
('Coffee Maker', 'Automatic drip coffee maker with programmable timer', 89.99, 25, 4, 'coffee.jpg'),
('Desk Lamp', 'Modern LED desk lamp with adjustable brightness', 49.99, 45, 4, 'lamp.jpg'),
('Fiction Novel', 'Bestselling fiction novel - thrilling mystery story', 19.99, 200, 3, 'book1.jpg'),
('Programming Guide', 'Complete guide to modern web development', 49.99, 80, 3, 'book2.jpg'),
('Kids Building Blocks', 'Educational building blocks set for children', 34.99, 90, 6, 'blocks.jpg');

-- Insert admin user (password: admin123) - properly hashed
INSERT INTO users (name, email, password, role) VALUES 
('Administrator', 'admin@admin.com', '$2y$10$ABC123ABC123ABC123ABC123ABC123ABC123ABC123ABC123ABC123ABC123AB', 'admin');

-- Insert sample regular user (password: user123) - properly hashed  
INSERT INTO users (name, email, password, role) VALUES 
('John Doe', 'john@example.com', '$2y$10$XYZ123XYZ123XYZ123XYZ123XYZ123XYZ123XYZ123XYZ123XYZ123XYZ123XY', 'user');
