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

-- Insert sample data with realistic 2024/2025 pricing
INSERT INTO inventory (brand, model, year, price, `condition`, availability) VALUES
('Ferrari', '488 GTB', 2024, 280000.00, 'new', 'available'),
('Porsche', '911 Carrera', 2025, 122000.00, 'new', 'available'),
('Lamborghini', 'Huracan Performante', 2024, 310000.00, 'new', 'available'),
('Aston Martin', 'Vantage', 2025, 148000.00, 'new', 'available'),
('McLaren', '720S', 2024, 305000.00, 'new', 'available'),
('Bugatti', 'Chiron Sport', 2024, 3600000.00, 'new', 'available'),
('Rolls-Royce', 'Phantom', 2025, 485000.00, 'new', 'available'),
('BMW', 'M8 Competition', 2025, 152000.00, 'new', 'available'),
('Mercedes-Benz', 'AMG GT', 2025, 125000.00, 'new', 'available');
