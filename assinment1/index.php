<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travel_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT * FROM destinations ORDER BY rating DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>World Travel Destinations</title>
  <style>
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background: linear-gradient(to right, #c9d6ff, #e2e2e2);
      margin: 0;
      padding: 20px;
    }
    h1 {
      text-align: center;
      color: #2c3e50;
    }
    .destination {
      background: white;
      border-radius: 15px;
      padding: 20px;
      margin: 15px auto;
      max-width: 600px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .destination img {
      width: 100%;
      border-radius: 10px;
      height: 300px;
      object-fit: cover;
    }
    .info {
      margin-top: 10px;
    }
    .rating {
      color: #e67e22;
      font-weight: bold;
    }
    .high {
      background-color: #dfffd8;
      padding: 5px;
      border-radius: 5px;
    }
    .low {
      background-color: #ffe3e3;
      padding: 5px;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <h1>🌍 Top Travel Destinations</h1>

  <?php
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<div class='destination'>";
      echo "<img src='images/" . htmlspecialchars($row['photo_url']) . "' alt='" . htmlspecialchars($row['city']) . "'>";
      echo "<div class='info'>";
      echo "<h2>" . htmlspecialchars($row['city']) . ", " . htmlspecialchars($row['country']) . "</h2>";
      echo "<p><strong>Attraction:</strong> " . htmlspecialchars($row['attraction']) . "</p>";
      echo "<p><strong>Best Season:</strong> " . htmlspecialchars($row['best_season']) . "</p>";
      echo "<p><strong>Average Cost:</strong> $" . htmlspecialchars($row['cost']) . "</p>";
      echo "<p class='rating'>⭐ Rating: " . htmlspecialchars($row['rating']) . "</p>";

      // Example of If/Else conditional formatting
      if ($row['rating'] >= 9) {
        echo "<p class='high'>Highly Recommended Destination!</p>";
      } else {
        echo "<p class='low'>Good but could be improved.</p>";
      }

      echo "</div>";
      echo "</div>";
    }
  } else {
    echo "<p>No destinations found.</p>";
  }

  $conn->close();
  ?>
</body>
</html>
