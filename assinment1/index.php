<?php
require('connect.php');
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
    .info p {
      margin: 5px 0;
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
  $sql = "SELECT * FROM destinations ORDER BY rating DESC";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<div class='destination'>";
      echo "<h2>" . htmlspecialchars($row['city']) . ", " . htmlspecialchars($row['country']) . "</h2>";
      echo "<div class='info'>";
      echo "<p><strong>Attraction:</strong> " . htmlspecialchars($row['attraction']) . "</p>";
      echo "<p><strong>Best Season:</strong> " . htmlspecialchars($row['best_season']) . "</p>";
      echo "<p><strong>Average Cost:</strong> $" . htmlspecialchars($row['cost']) . "</p>";
      echo "<p class='rating'>⭐ Rating: " . htmlspecialchars($row['rating']) . "</p>";

      // Conditional formatting example
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
