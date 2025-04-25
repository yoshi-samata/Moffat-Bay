<?php
$host = 'localhost'; // Adjust if using a different host
$dbname = 'MoffatBay';
$username = 'root'; // Your MySQL username
$password = ''; // Your MySQL password

try {
    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Connection error: " . $e->getMessage());
}
?>