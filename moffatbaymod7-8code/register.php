<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Moffat Bay Marina</title>
    <style>
        body {
            background-image: url('img/photo.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #0a0a0a;
            color: white;
            padding: 10px 20px;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
        }
        nav ul li {
            margin: 0 15px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
        }
        main {
            margin-bottom: 50px;
            text-align: center;
            padding: 20px;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        h1, h2 {
            color: white;
        }
        form {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 5px;
            display: inline-block;
        }
        label, input {
            display: block;
            margin: 10px 0;
            color: white;
        }
        input[type="text"], input[type="password"], input[type="number"] {
            padding: 5px;
            width: 200px;
        }
        input[type="submit"] {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
    <div style="display: flex; align-items: center; justify-content: space-between;">
        <img src="images/logo.png" alt="Moffat Bay Marina Logo" style="height: 50px;">
        <h1>Moffat Bay Marina</h1>
    </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Register</h2>
        <?php if (isset($message)) echo "<p style='color: white;'>$message</p>"; ?>
        <form method="POST" action="register.php">
            <label for="fName">First Name:</label>
            <input type="text" id="fName" name="fName" required>
            <label for="lName">Last Name:</label>
            <input type="text" id="lName" name="lName" required>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="boatName">Boat Name (optional):</label>
            <input type="text" id="boatName" name="boatName">
            <label for="boatLength">Boat Length (optional):</label>
            <input type="number" id="boatLength" name="boatLength" step="0.1">
            <label for="phone">Phone (optional):</label>
            <input type="text" id="phone" name="phone">
            <input type="submit" value="Register">
        </form>
    </main>
    <footer>
        <p>© 2025 Moffat Bay Marina. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $boatName = $_POST['boatName'] ?: NULL;
    $boatLength = $_POST['boatLength'] ?: NULL;
    $phone = $_POST['phone'] ?: NULL;

    $stmt = $conn->prepare("INSERT INTO user_account (fName, lName, email, userPass, boatName, boatLength, phone) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssds", $fName, $lName, $email, $password, $boatName, $boatLength, $phone);

    if ($stmt->execute()) {
        $message = "Registration successful! Please log in.";
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
