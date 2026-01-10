-- Script untuk menambahkan tabel deck_settings
-- Database: nine0_portfolio

USE nine0_portfolio;

-- Tabel untuk menyimpan setting password deck
CREATE TABLE IF NOT EXISTS deck_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    deck_url TEXT NOT NULL,
    expires_at DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert data default
INSERT INTO deck_settings (password, deck_url, expires_at) 
VALUES (
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
    'https://docs.google.com/presentation/d/e/2PACX-example/embed',
    DATE_ADD(NOW(), INTERVAL 7 DAY)
) ON DUPLICATE KEY UPDATE id=id;

-- Verifikasi
SELECT * FROM deck_settings;
