<?php
require_once __DIR__ . '/../db_connect.php';
include __DIR__ . '/header.php';

$top = $conn->query("SELECT * FROM destinations ORDER BY rating DESC LIMIT 3")->fetch_all(MYSQLI_ASSOC);
?>
<div class="hero mb-4">
  <div class="container">
    <h1>Discover Amazing Destinations</h1>
    <p>Curated travel destinations managed from our CMS.</p>
    <a href="/frontend/destinations.php" class="btn btn-primary">Explore</a>
  </div>
</div>

<h3>Top Destinations</h3>
<div class="row">
  <?php foreach($top as $d): ?>
  <div class="col-md-4 mb-3">
    <div class="card">
      <?php if ($d['image']): ?>
        <img class="card-img-top" src="/uploads/destinations/<?php echo e($d['image']); ?>" alt="">
      <?php endif; ?>
      <div class="card-body">
        <h5 class="card-title"><?php echo e($d['name']); ?></h5>
        <p class="card-text"><?php echo e($d['country']); ?> — Rating: <?php echo e($d['rating']); ?></p>
        <a href="/frontend/destination.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-outline-primary">View</a>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<?php include __DIR__ . '/footer.php'; ?>
