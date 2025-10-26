<?php
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM users WHERE id=$id");
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);

    $update_sql = "UPDATE users SET name='$name', email='$email'";

    // Password update
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $update_sql .= ", password='$password'";
    }

    // Image upload
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir);
        $image = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $update_sql .= ", image='$image'";
    }

    $update_sql .= " WHERE id=$id";

    if ($conn->query($update_sql)) {
        echo "<p style='color:green;'>User updated successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }
}
?>

<h2>Update User</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>

    <label>Password (leave blank to keep current):</label><br>
    <input type="password" name="password"><br><br>

    <label>Image:</label><br>
    <input type="file" name="image" accept="image/*"><br>
    <?php if ($user['image']): ?>
        <img src="uploads/<?= $user['image'] ?>" width="80"><br>
    <?php endif; ?>
    <br>

    <button type="submit">Update</button>
</form>

<a href="readUsers.php">Back to Users</a>
