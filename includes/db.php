<?php
// Database connection configuration
$host = 'localhost';       // The hostname or IP address of the database server (localhost for local development)
$dbName = 'apartment_booking';  // The name of the database you are connecting to (in this case, 'apartment_booking')
$user = 'root';            // The username used to authenticate with the database (root is the default for MySQL on local setups)
$pass = '';                // The password for the MySQL user (blank for the default 'root' user on a local setup, but should be set in production)

// Using a try-catch block to handle errors during the database connection
try {
    // Creating a new PDO instance and setting up the database connection
    // The DSN (Data Source Name) is a string that contains the information required to connect to the database.
    // "mysql:host=$host;dbname=$dbName;charset=utf8" specifies the database type (MySQL), the host, the database name, and the character set to use.
    // We use UTF-8 for better character encoding support.
    $db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $pass);
    
    // Set the PDO error mode to exceptions so that PDO will throw exceptions in case of errors.
    // This is useful for debugging and handling issues cleanly.
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If the connection fails, an exception will be thrown and this block will catch it.
    // The message from the exception is displayed, which can help with debugging the connection issue.
    die("Connection failed: " . $e->getMessage());
}
?>
