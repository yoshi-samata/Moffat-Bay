<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: login.php"); // Redirect to login if user is not logged in
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "MoffatBay");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user ID from session
$userID = $_SESSION['userID'];

// Form data
$email = $_POST['email'] ?? null;
$startdate = $_POST['startdate'] ?? null;
$enddate = $_POST['enddate'] ?? null;

// Validate form data
if (empty($email) || empty($startdate) || empty($enddate)) {
    die("<div class='page-section'>Error: All fields are required.<br><a href='reservation.html'>Try Again</a></div>");
}

// Verify date logic
if (strtotime($enddate) <= strtotime($startdate)) {
    die("<div class='page-section'>Error: End date must be after start date.<br><a href='reservation.html'>Try Again</a></div>");
}

// Get user info
$userSql = "SELECT fname, lname, boatname, boatlength FROM user_account WHERE email = ?";
$stmt = $conn->prepare($userSql);
$stmt->bind_param("s", $email);
$stmt->execute();
$userResult = $stmt->get_result();

if ($userResult->num_rows === 0) {
    die("<div class='page-section'>Error: User not found.<br><a href='reservation.html'>Try Again</a></div>");
}

$userData = $userResult->fetch_assoc();
$fname = $userData['fname'];
$lname = $userData['lname'];
$boatname = $userData['boatname'];
$boatlength = (float) $userData['boatlength'];

// Determine slip size
if ($boatlength <= 26) {
    $slip_size = 'Small';
} elseif ($boatlength <= 40) {
    $slip_size = 'Medium';
} else {
    $slip_size = 'Large';
}

// Check slip availability
$slipCheckSql = "SELECT slipid FROM slip WHERE size = ? AND availability > 0 LIMIT 1";
$slipStmt = $conn->prepare($slipCheckSql);
$slipStmt->bind_param("s", $slip_size);
$slipStmt->execute();
$slipResult = $slipStmt->get_result();

if ($slipResult->num_rows === 0) {
    echo "<link rel='stylesheet' href='frameworkstyle.css'>";
    echo "<div class='page-section'><h2>No slips available for this size.</h2><p><a href='waitlist.html'>Click here to join the waitlist</a></p></div>";
    exit;
}

$slipRow = $slipResult->fetch_assoc();
$slipid = $slipRow['slipid'];

// Calculate cost and duration
$duration = (strtotime($enddate) - strtotime($startdate)) / (60 * 60 * 24);
$monthly_cost = ($boatlength * 10) + 10;
$daily_cost = $monthly_cost / 30;
$totalcost = round($daily_cost * $duration, 2);

// Insert reservation into database
$reserveSql = "INSERT INTO reservation (userID, slipid, startdate, enddate, totalcost) VALUES (?, ?, ?, ?, ?)";
$reserveStmt = $conn->prepare($reserveSql);
$reserveStmt->bind_param("iissd", $userID, $slipid, $startdate, $enddate, $totalcost);

if ($reserveStmt->execute()) {
    // Update slip availability
    $updateAvailabilitySql = "UPDATE slip SET availability = availability - 1 WHERE slipid = ?";
    $updateStmt = $conn->prepare($updateAvailabilitySql);
    $updateStmt->bind_param("i", $slipid);
    $updateStmt->execute();

    // Display reservation confirmation
    echo "<link rel='stylesheet' href='frameworkstyle.css'>";
    echo "<section class='page-section'>";
    echo "<h2>Reservation for $boatname Confirmed!</h2>";
    echo "<p><strong>Name:</strong> $fname $lname</p>";
    echo "<p><strong>Boat Name:</strong> $boatname</p>";
    echo "<p><strong>Boat Length:</strong> $boatlength ft</p>";
    echo "<p><strong>Slip Size:</strong> $slip_size</p>";
    echo "<p><strong>Start Date:</strong> $startdate</p>";
    echo "<p><strong>End Date:</strong> $enddate</p>";
    echo "<p><strong>Total Cost:</strong> $$totalcost</p>";
    echo "<p><a href='dashboard.php'>User Dashboard Home</a></p>";
    echo "</section>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>