<!DOCTYPE html>
<html>
<head>
    <title>Slip & Reservation Management - Prototype</title>
</head>
<body>
    <h2>Search Slip by Customer Name</h2>
    <form method="post">
        <input type="text" name="search_name" placeholder="Enter customer name" required>
        <input type="submit" value="Search">
    </form>

    <?php if (!empty($_POST['search_name'])): ?>
        <h3>Search Results:</h3>
        <ul>
            <li>Reservation ID: 101, Boat Name: "Sea Breeze"</li>            
        </ul>
    <?php endif; ?>

    <h2>Filter Slips by Size</h2>
    <form method="post">
        <select name="filter_size">
            <option value="10">10 ft</option>
            <option value="25">25 ft</option>
            <option value="50">50 ft</option>
        </select>
        <input type="submit" value="Filter">
    </form>

    <?php if (!empty($_POST['filter_size'])): ?>
        <h3>Available Slips:</h3>
        <ul>
            <li>Slip Length: <?= $_POST['filter_size'] ?> ft, Vacancies: 3</li>            
        </ul>
    <?php endif; ?>

    <h2>Manage Customer Services</h2>
    <form method="post">
        <input type="number" name="user_id" placeholder="User ID" required>
        <input type="text" name="service_type" placeholder="Service Name" required>
        <input type="submit" value="Add Service">
    </form>

    <?php if (!empty($_POST['user_id']) && !empty($_POST['service_type'])): ?>
        <p>Service "<?= $_POST['service_type'] ?>" added for User ID <?= $_POST['user_id'] ?>.</p>
    <?php endif; ?>

    <form method="post">
        <input type="number" name="service_id" placeholder="Service ID" required>
        <input type="submit" value="Remove Service">
    </form>

    <?php if (!empty($_POST['service_id'])): ?>
        <p>Service ID <?= $_POST['service_id'] ?> removed.</p>
    <?php endif; ?>
</body>
</html>
