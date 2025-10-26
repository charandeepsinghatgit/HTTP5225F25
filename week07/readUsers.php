<?php
include 'db.php';

// Protect page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM users");

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM users WHERE id=$id");
    header("Location: readUsers.php");
    exit();
}
?>

<h2>All Users</h2>
<a href="createUser.php">Add New User</a>
<a href="deleteUser.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this user?')">Delete</a> |
<a href="logout.php">Logout</a>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td>
                <?php if ($row['image']): ?>
                    <img src="uploads/<?= $row['image'] ?>" width="60">
                <?php endif; ?>
            </td>
            <td>
                <a href="updateUser.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this user?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
