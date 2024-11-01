<?php
$host = 'localhost';
$dbName = 'apartment_booking'; 
$user = 'root';
$pass = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $pass); // Added charset=utf8 for better compatibility
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
