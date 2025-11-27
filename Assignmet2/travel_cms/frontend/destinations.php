<?php
require_once __DIR__ . '/../db_connect.php';
include __DIR__ . '/header.php';

$country = $_GET['country'] ?? '';
$country_param = "%" . $country . "%";
$stmt = $conn->prepare("SELECT * FROM destinations WHERE country LIKE ? ORDER BY rating DESC");
$stmt->bind_param('s', $country_param);
$stmt->execute();
$res = $stmt->get_result();
$items = $res->fetch_all(MYSQLI_ASSOC);
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>All Destinations</h3>
  <form method="get" class="d-flex">
    <input name="country" placeholder="Filter by country" value="<?php echo e($_GET['country'] ?? ''); ?>" class="form-control me-2">
    <button class="btn btn-outline-secondary">Filter</button>
  </form>
</div>

<div class="row">
<?php foreach($items as $d): ?>
  <div class="col-md-4 mb-3">
    <div class="card">
      <?php if ($d['image']): ?><img class="card-img-top" src="/uploads/destinations/<?php echo e($d['image']); ?>"><?php endif; ?>
      <div class="card-body">
        <h5><?php echo e($d['name']); ?></h5>
        <p><?php echo e($d['country']); ?> — Rating: <?php echo e($d['rating']); ?></p>
        <a href="/frontend/destination.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-primary">View</a>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>

<?php include __DIR__ . '/footer.php'; ?>
