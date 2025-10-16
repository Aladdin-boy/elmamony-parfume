-- Database schema for Elmamony starter
CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  price DECIMAL(10,2) NOT NULL,
  stock INT NOT NULL DEFAULT 0,
  image VARCHAR(255) DEFAULT 'assets/placeholder.png'
);

CREATE TABLE IF NOT EXISTS orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_name VARCHAR(255),
  phone VARCHAR(50),
  address TEXT,
  total DECIMAL(10,2),
  status VARCHAR(50) DEFAULT 'Pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT,
  product_id INT,
  qty INT,
  price DECIMAL(10,2),
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

-- sample product
INSERT INTO products (name, description, price, stock, image) VALUES
('Elmamony Signature', 'A luxurious woody-floral perfume.', 49.99, 20, 'assets/placeholder.png'),
('Elmamony Rose', 'Soft rose fragrance for daily wear.', 39.50, 15, 'assets/placeholder.png');
