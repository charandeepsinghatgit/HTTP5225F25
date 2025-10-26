<?php
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Delete user
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Get image filename to delete from folder
    $result = $conn->query("SELECT image FROM users WHERE id=$id");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (!empty($user['image']) && file_exists("uploads/" . $user['image'])) {
            unlink("uploads/" . $user['image']);
        }
    }

    // Delete record from database
    $delete = $conn->query("DELETE FROM users WHERE id=$id");

    if ($delete) {
        echo "<p style='color:green;'>User deleted successfully.</p>";
    } else {
        echo "<p style='color:red;'>Error deleting user: " . $conn->error . "</p>";
    }

    echo "<a href='readUsers.php'>Back to Users</a>";
} else {
    echo "<p style='color:red;'>No user ID provided.</p>";
    echo "<a href='readUsers.php'>Back to Users</a>";
}
?>
