<?php
include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM schools WHERE id=$id");
$school = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fields = [
        'Board Name', 'School Number', 'School Name', 'School Level', 'School Language',
        'School Type', 'School Special Conditions', 'Street', 'City', 'Province',
        'Postal Code', 'Phone', 'Fax', 'Grade Range', 'Date Open', 'Email', 'Website', 'Board Website'
    ];

    $updates = [];
    foreach ($fields as $field) {
        $value = $conn->real_escape_string($_POST[$field]);
        $updates[] = "`$field` = '$value'";
    }

    $sql = "UPDATE schools SET " . implode(", ", $updates) . " WHERE id=$id";
    if ($conn->query($sql)) {
        echo "<p style='color:green'>School updated successfully!</p>";
    } else {
        echo "<p style='color:red'>Error: " . $conn->error . "</p>";
    }
}
?>

<h2>Update School</h2>
<form method="POST">
    <?php foreach ($school as $key => $value):
        if ($key == "id") continue; ?>
        <label><?= $key ?>:</label><br>
        <input type="text" name="<?= $key ?>" value="<?= htmlspecialchars($value) ?>"><br><br>
    <?php endforeach; ?>
    <button type="submit">Update</button>
</form>
