<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM schools WHERE id=$id";
    if ($conn->query($sql)) {
        echo "<p style='color:green'>School deleted successfully.</p>";
    } else {
        echo "<p style='color:red'>Error deleting school: " . $conn->error . "</p>";
    }
}
echo "<a href='readSchools.php'>Back to List</a>";
?>
