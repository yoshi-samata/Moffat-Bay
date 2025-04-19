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
$stmt = $conn->prepare("SELECT fname, email FROM user_account WHERE userID = ?");
$stmt->bind_param("i", $_SESSION['userID']);
$stmt->execute();
$userResult = $stmt->get_result();
$user = $userResult->fetch_assoc();

// Fetch reservation details from the reservations table
$reservationStmt = $conn->prepare("SELECT * FROM reservation WHERE userID = ?");
$reservationStmt->bind_param("i", $_SESSION['userID']);
$reservationStmt->execute();
$reservationResult = $reservationStmt->get_result();
$reservation = $reservationResult->fetch_assoc();
if (!$reservation) {

    $reservation = [];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard - Moffat Bay</title>
    <link rel="stylesheet" href="dashboard.css" />
</head>

<body>
    <header>
        <div class="logo">
            <img src="images/Logo.png" alt="Moffat Bay Logo" />
        </div>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="register.html">Register</a></li>
                <li><a href="login.html">Login</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard">
            <h1>Welcome to Your Dashboard, <?php echo htmlspecialchars($user['fname']); ?>!</h1>
            <p>Username: <?php echo htmlspecialchars($user['email']); ?></p>

            <?php if ($reservation && is_array($reservation)): ?>
                <h2>Your Reservation</h2>
                <p>Reservation ID: <?php echo htmlspecialchars($reservation['reservationid']); ?></p>
                <p>Reservation Start Date: <?php echo htmlspecialchars($reservation['startdate']); ?></p>
                <p>Reservation End Date: <?php echo htmlspecialchars($reservation['enddate']); ?></p>
            <?php else: ?>
                <h2>No Reservations Found</h2>
                <p>You don't have any reservations at the moment.</p>
            <?php endif; ?>

            <div class="dashboard-options">
                <button onclick="window.location.href='reservation.html';">Make a Reservation</button>
                <button onclick="window.location.href='view-reservation.html';">View Reservation</button>
                <button onclick="window.location.href='view-waitlist.html';">View Waitlist</button>
                <button onclick="window.location.href='join-waitlist.html';">Join Waitlist</button>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Moffat Bay Marina</p>
    </footer>
</body>

</html>