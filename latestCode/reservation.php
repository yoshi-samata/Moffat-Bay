<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Slip Reservation</title>
  <link rel="stylesheet" href="frameworkstyle.css">
</head>

<body>
  <?php include 'header.html'; ?>

  <main>
    <section class="page-section">
      <h1>Slip Reservation</h1>
      <form action="reserve_slip.php" method="POST">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="startdate">Start Date</label>
        <input type="date" id="startdate" name="startdate" required>

        <label for="enddate">End Date</label>
        <input type="date" id="enddate" name="enddate" required>

        <input type="submit" value="Check Availability">
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Moffat Bay Marina</p>
  </footer>
</body>

</html>