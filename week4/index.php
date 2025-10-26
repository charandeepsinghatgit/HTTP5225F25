<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEEK 5 - Colors Display</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .color-box {
            width: 100%;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            font-weight: bold;
            color: white;
        }
    </style>
</head>
<body>
    <?php
    // Database connection
    $connect = mysqli_connect('localhost', 'root', '', 'CSV_DB 12');
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query all colors
    $query = "SELECT * FROM colors";
    $result = mysqli_query($connect, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['Name'];
            $hex = $row['HEX'];

            $r = hexdec(substr($hex, 1, 2));
            $g = hexdec(substr($hex, 3, 2));
            $b = hexdec(substr($hex, 5, 2));
            $brightness = ($r * 299 + $g * 587 + $b * 114) / 1000;
            $textColor = ($brightness > 128) ? 'black' : 'white';

            echo "<div class='color-box' style='background-color: $hex; color: $textColor;'>$name ($hex)</div>";
        }
    } else {
        echo "<p>No colors found in the database.</p>";
    }

    mysqli_close($connect);
    ?>
</body>
</html>
