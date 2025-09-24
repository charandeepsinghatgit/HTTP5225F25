<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Directory</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
        }

        .profile-card {
            background: #34495e;
            color: #ecf0f1;
            max-width: 600px;
            border-radius: 10px;
            padding: 25px;
            margin: 20px auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .full-name {
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .email-link {
            display: inline-block;
            margin-bottom: 12px;
            color: #1abc9c;
            text-decoration: none;
        }

        .email-link:hover {
            text-decoration: underline;
        }

        .location {
            font-size: 0.95rem;
            line-height: 1.4;
        }
    </style>
</head>
<body>
    <h1>User Directory</h1>
    <div class="wrapper">

        <?php
        // Fetch user info from API
        function fetchUserList() {
            $endpoint = "https://jsonplaceholder.typicode.com/users";
            $response = file_get_contents($endpoint);
            return json_decode($response, true);
        }

        // Retrieve all users
        $userList = fetchUserList();

        foreach ($userList as $person) {
            $fullName = $person['name'];
            $userEmail = $person['email'];
            $userLocation = $person['address']['street'] . ", " .
                            $person['address']['suite'] . ", " .
                            $person['address']['city'] . " - " .
                            $person['address']['zipcode'];

            echo "
            <div class='profile-card'>
                <div class='full-name'>$fullName</div>
                <a class='email-link' href='mailto:$userEmail'>$userEmail</a>
                <div class='location'>
                    <strong>Location:</strong><br>$userLocation
                </div>
            </div>
            ";
        }
        ?>
    </div>
</body>
</html>
