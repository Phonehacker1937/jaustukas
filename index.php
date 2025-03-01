<?php
// Database connection parameters
$servername = "localhost";
$username = "admin";
$password = "qwertyuiop";
$dbname = "jaustukas";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to UTF-8
$conn->set_charset("utf8mb4");

// Query to get the 10 latest rows from the table
$sql = "SELECT * FROM atsiliepimai ORDER BY data DESC LIMIT 10";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest Feedback Entries</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .feedback-list {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .feedback-list th, .feedback-list td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .feedback-list th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .feedback-list tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .feedback-list tr:hover {
            background-color: #f1f1f1;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #777;
        }
    </style>
</head>
<body>
    <h1>Latest Feedback Entries</h1>
    
    <?php if ($result && $result->num_rows > 0): ?>
        <table class="feedback-list">
            <thead>
                <tr>
                    <th>Rating ID</th>
                    <th>Rating</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row["ivertinimo_numeris"]) ?></td>
                    <td><?= htmlspecialchars($row["ivertinimas"]) ?></td>
                    <td><?= htmlspecialchars($row["vieta"]) ?></td>
                    <td><?= htmlspecialchars($row["data"]) ?></td>
                    <td><?= $row["komentaras"] ? htmlspecialchars($row["komentaras"]) : "<em>No comment</em>" ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-data">No feedback entries found.</p>
    <?php endif; ?>
    
    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>