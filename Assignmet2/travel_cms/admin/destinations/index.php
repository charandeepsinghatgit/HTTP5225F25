<?php
require_once __DIR__ . '/../../db_connect.php';
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../includes/admin_header.php';
require_once __DIR__ . '/../includes/functions.php';

$q = "SELECT * FROM destinations ORDER BY rating DESC, date_added DESC";
$res = $conn->query($q);
?>
<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Destinations</h3>
    <a class="btn btn-success" href="/admin/destinations/create.php"><i class="fa fa-plus"></i> Add Destination</a>
  </div>

  <table class="table table-striped">
    <thead><tr>
      <th>ID</th><th>Name</th><th>Country</th><th>Rating</th><th>Date Added</th><th>Actions</th>
    </tr></thead>
    <tbody>
    <?php while ($row = $res->fetch_assoc()): ?>
      <tr>
        <td><?php echo (int)$row['id']; ?></td>
        <td><?php echo e($row['name']); ?></td>
        <td><?php echo e($row['country']); ?></td>
        <td><?php echo e($row['rating']); ?></td>
        <td><?php echo e($row['date_added']); ?></td>
        <td>
          <a class="btn btn-sm btn-primary" href="/admin/destinations/edit.php?id=<?php echo $row['id']; ?>">Edit</a>
          <a class="btn btn-sm btn-danger" href="/admin/destinations/delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete?')">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div>
<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>
