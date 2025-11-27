<?php
require_once __DIR__ . '/../db_connect.php';
require_once __DIR__ . '/includes/auth_check.php';
require_once __DIR__ . '/includes/admin_header.php';

$counts = [];
$res = $conn->query("SELECT COUNT(*) AS c FROM destinations");
$counts['destinations'] = $res->fetch_assoc()['c'] ?? 0;
$res = $conn->query("SELECT COUNT(*) AS c FROM destination_photos");
$counts['photos'] = $res->fetch_assoc()['c'] ?? 0;
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-12 mb-3">
      <h2>Dashboard</h2>
      <p>Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?></p>
    </div>
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-body">
          <h5><i class="fa fa-map-marker-alt"></i> Destinations</h5>
          <p class="display-6"><?php echo (int)$counts['destinations']; ?></p>
          <a href="/admin/destinations/index.php" class="btn btn-sm btn-outline-primary">Manage</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-body">
          <h5><i class="fa fa-images"></i> Photos</h5>
          <p class="display-6"><?php echo (int)$counts['photos']; ?></p>
          <a href="/admin/photos/index.php" class="btn btn-sm btn-outline-primary">Manage</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/includes/admin_footer.php'; ?>
