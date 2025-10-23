<?php
include 'db.php';
$result = $conn->query("SELECT * FROM schools");
?>

<h2>All Schools</h2>
<a href="createSchool.php">Add New School</a>
<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>School Name</th>
        <th>City</th>
        <th>Province</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['School Name'] ?></td>
            <td><?= $row['City'] ?></td>
            <td><?= $row['Province'] ?></td>
            <td>
                <a href="updateSchool.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="deleteSchool.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this school?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
