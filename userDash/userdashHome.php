<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Connect to the database
require_once 'db_connect.php';

// Fetch user details from the user_account table
$stmt = $conn->prepare("SELECT fname, lname, email, boatname FROM user_account WHERE userID = ?");
$stmt->bind_param("i", $_SESSION['userID']);
$stmt->execute();
$userResult = $stmt->get_result();
$user = $userResult->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard - Moffat Bay</title>
    <link rel="stylesheet" href="dashboard.css" />
    <link rel="stylesheet" href="header.css">
</head>

<body>
    <?php include 'header.html'; ?>

    <main>
        <section class="dashboard">
            <?php include 'dashboard.html'; ?>
            <div class="welcomeDash">
                <h1>Welcome to Your Dashboard, <?php echo htmlspecialchars($user['fname']); ?>!</h1>
                <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['fname']); ?></p>
                <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['lname']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Boat Name:</strong> <?php echo htmlspecialchars($user['boatname']); ?></p>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Moffat Bay Marina</p>
    </footer>
</body>

</html>