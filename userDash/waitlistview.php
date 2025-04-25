<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Connect to the database
require_once 'db_connect.php';

// Fetch all data from the waitlist table
$stmt = $conn->prepare("SELECT waitlistid, slipid, requesteddate, status FROM waitlist");
$stmt->execute();
$waitlistResult = $stmt->get_result();

// Check for errors in the query
if (!$waitlistResult) {
    die("Error fetching waitlist data: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Waitlist - Moffat Bay Marina</title>
    <link rel="stylesheet" href="dashboard.css" />
    <link rel="stylesheet" href="header.css">
</head>

<body>
    <?php include 'header.html'; ?>

    <main>
        <section class="dashboard">
            <?php include 'dashboard.html'; ?>
            <div class="welcomeDash">
                <h1>Waitlist Information</h1>
                <?php if ($waitlistResult->num_rows > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Waitlist ID</th>
                                <th>Slip ID</th>
                                <th>Date Requested</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $waitlistResult->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['waitlistid']); ?></td>
                                    <td><?php echo htmlspecialchars($row['slipid']); ?></td>
                                    <td><?php echo htmlspecialchars($row['requesteddate']); ?></td>
                                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No waitlist data found.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Moffat Bay Marina</p>
    </footer>
</body>

</html>
<?php
$conn->close(); // Close the database connection
?>