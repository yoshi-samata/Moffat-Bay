<header>
    <div class="logo">
        <img src="images/Logo.png" alt="Moffat Bay Logo">
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="userdashHome.php">Account Home</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <?php if (isset($_SESSION['userID'])): ?>
                <li><a href="logout.php">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
