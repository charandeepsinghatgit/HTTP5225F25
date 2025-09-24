<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 3</title>
</head>
<body>
    <?php
        echo "Magic Number Game<br>";
        $number = rand(1,1000);
        echo "The input number is ". $number."<br>";
        if(($number % 3 == 0)&&($number % 5 == 0)){
            echo "The magic number is FizzBuzz";
        }
        else if($number % 3 == 0){
            echo "The magic number is Fizz";
        }
        else if($number % 5 == 0){
            echo "The magic number is Buzz";
        }
        else{
            echo "The magic number is ". $number;
        }
    ?>
</body>
</html>