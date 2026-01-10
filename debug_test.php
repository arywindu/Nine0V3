<?php
// Test file untuk debug CodeIgniter
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>CodeIgniter Debug Test</h2>";

// Check index.php exists
echo "1. index.php exists: " . (file_exists('index.php') ? 'YES' : 'NO') . "<br>";

// Check system folder
echo "2. system/ folder exists: " . (file_exists('system') ? 'YES' : 'NO') . "<br>";

// Check application folder
echo "3. application/ folder exists: " . (file_exists('application') ? 'YES' : 'NO') . "<br>";

// Check CodeIgniter core
echo "4. system/core/CodeIgniter.php exists: " . (file_exists('system/core/CodeIgniter.php') ? 'YES' : 'NO') . "<br>";

// Check config files
echo "5. application/config/config.php exists: " . (file_exists('application/config/config.php') ? 'YES' : 'NO') . "<br>";
echo "6. application/config/database.php exists: " . (file_exists('application/config/database.php') ? 'YES' : 'NO') . "<br>";

// Check session folder
$session_path = 'application/sessions';
echo "7. Session folder exists: " . (file_exists($session_path) ? 'YES' : 'NO') . "<br>";
if (file_exists($session_path)) {
    echo "   - Session folder writable: " . (is_writable($session_path) ? 'YES' : 'NO') . "<br>";
}

// Check PHP version
echo "<br><strong>PHP Version:</strong> " . phpversion() . "<br>";

// Try to include index.php and catch error
echo "<br><h3>Attempting to load CodeIgniter...</h3>";
try {
    // Just test if config can be loaded
    define('BASEPATH', 'system/');
    define('APPPATH', 'application/');
    
    if (file_exists('application/config/config.php')) {
        include 'application/config/config.php';
        echo "Config loaded successfully!<br>";
        echo "Base URL: " . (isset($config['base_url']) ? $config['base_url'] : 'NOT SET') . "<br>";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
