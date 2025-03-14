<?php

$servername = "localhost";
$username = "admin";
$password = "qwertyuiop";
$dbname = "jaustukas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

$sql = "SELECT * FROM atsiliepimai ORDER BY data DESC LIMIT 10";
$result = $conn->query($sql);
?>

<!--   Arijus Dambrauskas EIF-23   -->
<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="atsiliepimai">
    <meta name="author" content="Arijus Dambrauskis">
    <title>jaustukas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header id="virsutine linija" class="top-strip">
        <div class="logo">
            <a href="#">
                <img src="jaustukas\vaizdai\logo.jpg"
                    alt="Icon">
            </a>
        </div>
        <nav class="social-links">
            <a href="https://facebook.com" target="_blank" title="Facebook">
                <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook" width="30">
            </a>
            <a href="https://instagram.com" target="_blank" title="Instagram">
                <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram" width="30">
            </a>
            <a href="https://twitter.com" target="_blank" title="Twitter">
                <img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter" width="30">
            </a>
        </nav>
    </header>
    <header class="content" id="atstumo palaikymas">
    </header>
    <div id="clock">--:--:--</div>
    <script>
        function updateClock() {
            const now = new Date();

            let hours = now.getHours().toString().padStart(2, '0');
            let minutes = now.getMinutes().toString().padStart(2, '0');
            let seconds = now.getSeconds().toString().padStart(2, '0');

            const timeString = `${hours}:${minutes}:${seconds}`;

            document.getElementById("clock").textContent = timeString;
        }

        setInterval(updateClock, 1000);

        updateClock();
    </script>
    <section id="apie">
        <h1>Apie muziejų</h1>
        <p>svetainės aprašymas</p>
    </section>
    <section style="text-align: center;" id="theme-button">
        <button  id="toggle-theme" class="theme-button">Šviesus/Tamsus režimas</button>
    </section>
    <?php if ($result && $result->num_rows > 0): ?>
        <section id="atsiliepimu informcija" class="grid-container">
            <section>
                <h2>atsiliepimai</h2>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <ul><?= htmlspecialchars($row["ivertinimas"]) ?></ul>
                </tr>
                <?php endwhile; ?>
            </section>
            <?php $result->data_seek(0); ?> 
            <!--   duomenų bazę pradeda nuo nulio   -->
            <section>
                <h2>laikas</h2>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <ul><?= htmlspecialchars($row["data"]) ?></ul>
                </tr>
                <?php endwhile; ?>
            </section>
        </section>
    <?php else: ?>
    <p class="no-data">No feedback entries found.</p>
    <?php endif; ?>
    <?php
    $conn->close();
    ?>
    <footer id="galas">
        <nav class="social-links" style="text-align: center;">
            <a href="https://facebook.com" target="_blank" title="Facebook" style="padding-left: 10px;">
                <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook" width="30">
            </a>
            <a href="https://instagram.com" target="_blank" title="Instagram">
                <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram" width="30">
            </a>
            <a href="https://twitter.com" target="_blank" title="Twitter">
                <img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter" width="30">
            </a>
        </nav>
        <p>&copy; 2024 Arijus Dambrauskas. Visos teisės saugomos. <button onclick="window.location.href='jaustukas/forma.html';">forma</button>
        </p>    
    </footer>
    <script src="js/script.js"></script>
        

    
    

</body>

