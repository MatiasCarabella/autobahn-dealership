-- Create database if not exists
CREATE DATABASE IF NOT EXISTS autobahn;
USE autobahn;

-- Create inventory table (vehicles)
CREATE TABLE IF NOT EXISTS inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(100) NOT NULL,
    model VARCHAR(100) NOT NULL,
    year INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    `condition` ENUM('new', 'used') NOT NULL,
    availability ENUM('available', 'unavailable') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create test_drives table
CREATE TABLE IF NOT EXISTS test_drives (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    vehicle_model VARCHAR(100) NOT NULL,
    scheduled_date DATE NOT NULL,
    status ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data
INSERT INTO inventory (brand, model, year, price, `condition`, availability) VALUES
('Ferrari', '488 GTB', 2023, 330000.00, 'new', 'available'),
('Porsche', '911 Carrera', 2023, 115000.00, 'new', 'available'),
('Lamborghini', 'Huracan Performante', 2023, 274000.00, 'new', 'available'),
('Aston Martin', 'Vantage', 2023, 142000.00, 'new', 'available'),
('McLaren', '720S', 2023, 310000.00, 'new', 'available'),
('Bugatti', 'Chiron Sport', 2023, 3300000.00, 'new', 'available'),
('Rolls-Royce', 'Phantom', 2023, 460000.00, 'new', 'available'),
('BMW', 'M8 Competition', 2023, 146000.00, 'new', 'available'),
('Mercedes-Benz', 'AMG GT', 2023, 118000.00, 'new', 'available');
