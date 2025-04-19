<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT userID, userPass FROM user_account WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['userPass'])) {
            $_SESSION['userID'] = $user['userID'];
            header("Location: dashboard.php"); // Redirect to a dashboard or home
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No account found with that email.";
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Moffat Bay Marina</title>
    <style>
        body {
            background-image: url('images/background.jpg');
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

        h1,
        h2 {
            color: white;
        }

        form {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 5px;
            display: inline-block;
        }

        label,
        input {
            display: block;
            margin: 10px 0;
            color: white;
        }

        input[type="text"],
        input[type="password"] {
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
        <h2>Login</h2>
        <?php if (isset($error))
            echo "<p style='color: red;'>$error</p>"; ?>
        <form method="POST" action="login.php">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login">
        </form>
    </main>
    <footer>
        <p>© 2025 Moffat Bay Marina. All rights reserved.</p>
    </footer>
</body>

</html>