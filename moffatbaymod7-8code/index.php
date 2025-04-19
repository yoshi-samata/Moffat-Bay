<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moffat Bay Marina</title>
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
        h1, h2 {
            color: white;
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
        <h2>Welcome to Moffat Bay Marina</h2>
        <p>Reserve your slip today and enjoy the best marina experience!</p>
    </main>
    <footer>
        <p>© 2025 Moffat Bay Marina. All rights reserved.</p>
    </footer>
</body>
</html>
