<?php
require_once __DIR__ . '/../../db_connect.php';
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../includes/admin_header.php';

$q = "SELECT p.*, d.name AS destination_name FROM destination_photos p LEFT JOIN destinations d ON p.destination_id = d.id ORDER BY uploaded_at DESC";
$res = $conn->query($q);
?>
<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Destination Photos</h3>
    <a class="btn btn-success" href="/admin/photos/create.php"><i class="fa fa-plus"></i> Add Photo</a>
  </div>

  <table class="table table-striped">
    <thead><tr><th>ID</th><th>Destination</th><th>Image</th><th>Caption</th><th>Uploaded</th><th>Actions</th></tr></thead>
    <tbody>
    <?php while ($row = $res->fetch_assoc()): ?>
      <tr>
        <td><?php echo (int)$row['id']; ?></td>
        <td><?php echo e($row['destination_name']); ?></td>
        <td><img src="/uploads/photos/<?php echo e($row['image']); ?>" style="max-width:120px"></td>
        <td><?php echo e($row['caption']); ?></td>
        <td><?php echo e($row['uploaded_at']); ?></td>
        <td>
          <a class="btn btn-sm btn-danger" href="/admin/photos/delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete?')">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div>
<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>
