<?php
require_once __DIR__ . '/../db_connect.php';
include __DIR__ . '/header.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) { echo "Invalid destination"; include __DIR__ . '/footer.php'; exit; }
$stmt = $conn->prepare("SELECT * FROM destinations WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) { echo "Not found"; include __DIR__ . '/footer.php'; exit; }
$d = $res->fetch_assoc();

$photos_stmt = $conn->prepare("SELECT * FROM destination_photos WHERE destination_id = ? ORDER BY uploaded_at DESC");
$photos_stmt->bind_param('i', $id);
$photos_stmt->execute();
$photos = $photos_stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<div class="row">
  <div class="col-md-7">
    <?php if ($d['image']): ?><img src="/uploads/destinations/<?php echo e($d['image']); ?>" class="img-fluid mb-3"><?php endif; ?>
    <h2><?php echo e($d['name']); ?> — <?php echo e($d['country']); ?></h2>
    <p><strong>Rating:</strong> <?php echo e($d['rating']); ?> | <strong>Date added:</strong> <?php echo e($d['date_added']); ?></p>
    <p><?php echo nl2br(e($d['description'])); ?></p>

    <?php if ($d['youtube_id']): ?>
      <div class="ratio ratio-16x9 mb-3">
        <iframe src="https://www.youtube.com/embed/<?php echo e($d['youtube_id']); ?>" allowfullscreen></iframe>
      </div>
    <?php endif; ?>

    <?php if ($photos): ?>
      <h5>Gallery</h5>
      <div class="row">
        <?php foreach($photos as $p): ?>
          <div class="col-6 mb-3"><img src="/uploads/photos/<?php echo e($p['image']); ?>" class="img-fluid" alt=""></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
  <div class="col-md-5">
    <div class="card p-3">
      <h5>Quick Info</h5>
      <p><strong>Country:</strong> <?php echo e($d['country']); ?></p>
      <p><strong>Rating:</strong> <?php echo e($d['rating']); ?></p>
      <p><strong>Date added:</strong> <?php echo e($d['date_added']); ?></p>
    </div>
  </div>
</div>

<?php include __DIR__ . '/footer.php'; ?>
