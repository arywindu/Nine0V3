-- 1. PEMBUATAN DATABASE DAN TABEL AWAL
CREATE DATABASE IF NOT EXISTS nine0_portfolio;
USE nine0_portfolio;

-- Tabel Admins
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL -- Menghapus keyword AFTER karena urutan sudah benar di sini
);

-- Tabel Portfolios
CREATE TABLE IF NOT EXISTS portfolios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    images TEXT, -- Menghapus keyword AFTER karena posisi sudah tepat di sini
    category VARCHAR(100),
    client VARCHAR(100),
    year YEAR,
    url VARCHAR(255),
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 2. PENGISIAN DATA AWAL (SEEDER)
-- Admin Default (Password: password)
INSERT INTO admins (username, password, email) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@nine0.com')
ON DUPLICATE KEY UPDATE password = VALUES(password);

-- Data Portfolio Awal
INSERT INTO portfolios (title, description, image, category, client, year, url) VALUES 
('Brand Identity Design', 'Complete brand identity package including logo, colors, and guidelines', 'brand1.jpg', 'Branding', 'PT ABC', 2024, 'https://example.com'),
('Digital Marketing Campaign', 'Social media and digital marketing strategy implementation', 'digital1.jpg', 'Digital Marketing', 'PT XYZ', 2024, 'https://example2.com'),
('Website Development', 'Modern responsive website with CMS integration', 'web1.jpg', 'Web Development', 'PT DEF', 2023, 'https://example3.com');

-- 3. MIGRASI DATA (MENGISI KOLOM IMAGES)
-- Mengonversi data dari kolom 'image' ke format JSON di kolom 'images'
UPDATE portfolios 
SET images = CONCAT('[{"image":"', COALESCE(image, ''), '","caption":""}]') 
WHERE image IS NOT NULL AND image != '';

-- 4. VERIFIKASI STRUKTUR
DESCRIBE admins;
DESCRIBE portfolios;