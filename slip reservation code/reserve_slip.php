<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "MoffatBay");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form data
$userid = intval($_POST['userid']);
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];

// Verify dates
if (strtotime($enddate) <= strtotime($startdate)) {
    die("<div class='page-section'>Error: End date must be after start date.<br><a href='reservation.html'>Try Again</a></div>");
}

// Get user info
$userSql = "SELECT fname, lname, boatname, boatlength FROM user_account WHERE userid = $userid";
$userResult = $conn->query($userSql);

if ($userResult->num_rows == 0) {
    die("<div class='page-section'>Error: User not found.<br><a href='reservation.html'>Try Again</a></div>");    
}

$userData = $userResult->fetch_assoc();
$boatname = $userData['boatname'];
$boatlength = floatval($userData['boatlength']);
$fname = $userData['fname'];
$lname = $userData['lname'];

// Determine slip size
if ($boatlength <= 26) $slip_size = 'Small';
else if ($boatlength <= 40) $slip_size = 'Medium';
else $slip_size = 'Large';

// Check slip availability
$slipCheckSql = "SELECT slipid FROM slip WHERE size = '$slip_size' AND availability > 0 LIMIT 1";
$slipResult = $conn->query($slipCheckSql);

if ($slipResult->num_rows == 0) {
    echo "<link rel='stylesheet' href='frameworkstyle.css'>";
    echo "<div class='page-section'><h2>No slips available for this size.</h2><p><a href='waitlist.html'>Click here to join the waitlist</a></p></div>";
    exit;
}

$slipRow = $slipResult->fetch_assoc();
$slipid = $slipRow['slipid'];

// Duration and cost($10 per foot plus $10 electric power)
$duration = (strtotime($enddate) - strtotime($startdate)) / (60 * 60 * 24);
$monthly_cost = ($boatlength * 10) + 10; 
$daily_cost = $monthly_cost / 30;
$totalcost = round($daily_cost * $duration, 2);

// Insert reservation in DB
$reserveSql = $conn->prepare("INSERT INTO reservation (userid, slipid, startdate, enddate, totalcost) VALUES (?, ?, ?, ?, ?)");
$reserveSql->bind_param("iissd", $userid, $slipid, $startdate, $enddate, $totalcost);

// Update slip table
if ($reserveSql->execute()) {
    $updateAvailabilitySql = "UPDATE slip SET availability = availability - 1 WHERE slipid = $slipid";
    $conn->query($updateAvailabilitySql);

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
    echo "<p><a href='index.html'>Return Home</a></p>";
    echo "</section>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
