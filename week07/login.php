<?php
include 'db.php';

$message = "";

// ----------------------------
// LOGIN SECTION
// ----------------------------
if (isset($_POST['login'])) {
    $email = $conn->real_escape_string($_POST['login_email']);
    $password = $_POST['login_password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: readUsers.php");
            exit();
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "No user found with that email.";
    }
}

// ----------------------------
// SIGNUP SECTION
// ----------------------------
if (isset($_POST['signup'])) {
    $name = $conn->real_escape_string($_POST['signup_name']);
    $email = $conn->real_escape_string($_POST['signup_email']);
    $password = password_hash($_POST['signup_password'], PASSWORD_DEFAULT);

    // Handle image upload
    $image = "";
    if (!empty($_FILES["signup_image"]["name"])) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir);
        $image = basename($_FILES["signup_image"]["name"]);
        $target_file = $target_dir . $image;
        move_uploaded_file($_FILES["signup_image"]["tmp_name"], $target_file);
    }

    // Insert user
    $sql = "INSERT INTO users (name, email, password, image) VALUES ('$name', '$email', '$password', '$image')";
    if ($conn->query($sql)) {
        $message = "✅ Account created! You can now log in.";
    } else {
        $message = "❌ Error creating user: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login / Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            padding-top: 50px;
        }
        .container {
            background: white;
            border-radius: 12px;
            padding: 20px 40px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        button {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 6px;
        }
        button:hover {
            background: #0056b3;
        }
        .message {
            text-align: center;
            color: red;
            margin-bottom: 15px;
        }
        hr {
            margin: 25px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome to LMSPHP</h2>
    <?php if ($message): ?>
        <p class="message"><?= $message ?></p>
    <?php endif; ?>

    <!-- LOGIN FORM -->
    <form method="POST">
        <h3>Login</h3>
        <label>Email:</label>
        <input type="email" name="login_email" required>
        <label>Password:</label>
        <input type="password" name="login_password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <hr>

    <!-- SIGNUP FORM -->
    <form method="POST" enctype="multipart/form-data">
        <h3>Create an Account</h3>
        <label>Name:</label>
        <input type="text" name="signup_name" required>
        <label>Email:</label>
        <input type="email" name="signup_email" required>
        <label>Password:</label>
        <input type="password" name="signup_password" required>
        <label>Profile Image:</label>
        <input type="file" name="signup_image" accept="image/*">
        <button type="submit" name="signup">Sign Up</button>
    </form>
</div>

</body>
</html>
