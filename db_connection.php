<?php
// Database credentials
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "moffatbay";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
