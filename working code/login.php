<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Moffatbay";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get input from form
$email = $_POST['email'];
$password = $_POST['password'];

// Retrieve user details from database
$sql = "SELECT userpass FROM user_account WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    // Verify password
    if (password_verify($password, $row['userpass'])) {
        echo "Login successful. Welcome back!";
    } else {
        echo "Invalid password. Please try again.";
    }
} else {
    echo "No account found with that email address.";
}

$stmt->close();
$conn->close();
?>