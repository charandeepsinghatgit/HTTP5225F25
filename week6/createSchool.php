<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fields = [
        'Board Name', 'School Number', 'School Name', 'School Level', 'School Language',
        'School Type', 'School Special Conditions', 'Street', 'City', 'Province',
        'Postal Code', 'Phone', 'Fax', 'Grade Range', 'Date Open', 'Email', 'Website', 'Board Website'
    ];

    $values = [];
    foreach ($fields as $field) {
        $values[$field] = $conn->real_escape_string($_POST[$field]);
    }

    $columns = "`" . implode("`, `", $fields) . "`";
    $vals = "'" . implode("', '", $values) . "'";

    $sql = "INSERT INTO schools ($columns) VALUES ($vals)";
    if ($conn->query($sql)) {
        echo "<p style='color:green'>School added successfully!</p>";
    } else {
        echo "<p style='color:red'>Error: " . $conn->error . "</p>";
    }
}
?>

<form method="POST">
    <h2>Add New School</h2>
    <?php
    foreach ([
        'Board Name', 'School Number', 'School Name', 'School Level', 'School Language',
        'School Type', 'School Special Conditions', 'Street', 'City', 'Province',
        'Postal Code', 'Phone', 'Fax', 'Grade Range', 'Date Open', 'Email', 'Website', 'Board Website'
    ] as $field): ?>
        <label><?= $field ?>:</label><br>
        <input type="text" name="<?= $field ?>" required><br><br>
    <?php endforeach; ?>
    <button type="submit">Create</button>
</form>
