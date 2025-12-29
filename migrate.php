<?php
// Simple migration script to add images column
require_once 'system/core/CodeIgniter.php';

// Database connection
$db_config = array(
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'nine0_portfolio'
);

try {
    $pdo = new PDO(
        "mysql:host={$db_config['hostname']};dbname={$db_config['database']}", 
        $db_config['username'], 
        $db_config['password']
    );
    
    // Check if images column exists
    $stmt = $pdo->query("SHOW COLUMNS FROM portfolios LIKE 'images'");
    if ($stmt->rowCount() == 0) {
        // Add images column
        $pdo->exec("ALTER TABLE portfolios ADD COLUMN images TEXT AFTER image");
        echo "✅ Images column added successfully!\n";
        
        // Update existing records
        $pdo->exec("UPDATE portfolios SET images = CONCAT('[{\"image\":\"', COALESCE(image, ''), '\",\"caption\":\"\"}]') WHERE image IS NOT NULL AND image != ''");
        echo "✅ Existing records updated!\n";
    } else {
        echo "ℹ️ Images column already exists.\n";
    }
    
} catch(Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "\n📝 Manual Steps:\n";
    echo "1. Open phpMyAdmin\n";
    echo "2. Select 'nine0_portfolio' database\n";
    echo "3. Go to 'portfolios' table\n";
    echo "4. Run this SQL:\n";
    echo "   ALTER TABLE portfolios ADD COLUMN images TEXT AFTER image;\n";
}
?>
