<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEEK 5</title>
</head>
<body>
    <?php
    $connect = mysqli_connect(
        'localhost',
        'root',
        '',
        'CSV_DB 12');
        if(!$connect){
            die("Connection failed" . mysqli_connect_error());
        }

        $query = "SELECT * FROM colors";
        $colors = mysqli_query($connect, $query);

        echo "<pre>";
        print_r($colors);
        echo "</pre>";
    ?>
</body>
</html>