<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>Database Connection Test</h2>";

$hostname = 'localhost';
$username = 'u389576778_Nine0';
$password = 'DB-Nin3-!@bali-jakarta!!';
$database = 'u389576778_Nine0';

echo "Trying to connect to:<br>";
echo "Host: $hostname<br>";
echo "User: $username<br>";
echo "DB: $database<br><br>";

$mysqli = new mysqli($hostname, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "<h3 style='color:green'>Connected successfully!</h3>";
echo "Server info: " . $mysqli->server_info;

$mysqli->close();
