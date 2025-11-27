<?php
require_once __DIR__ . '/../../db_connect.php';
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../includes/admin_header.php';
require_once __DIR__ . '/../includes/functions.php';

$errors = [];
$dest_q = $conn->query("SELECT id, name FROM destinations ORDER BY name ASC");
$destinations = $dest_q->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $destination_id = (int)($_POST['destination_id'] ?? 0);
    $caption = trim($_POST['caption'] ?? '');
    if ($destination_id <= 0) $errors[] = 'Choose destination';
    $img_error = '';
    $uploaded = upload_image('image', __DIR__ . '/../../uploads/photos', $img_error);
    if ($img_error) $errors[] = $img_error;
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO destination_photos (destination_id, image, caption) VALUES (?,?,?)");
        $stmt->bind_param('iss', $destination_id, $uploaded, $caption);
        if ($stmt->execute()) {
            header('Location: /admin/photos/index.php');
            exit;
        } else {
            $errors[] = 'DB error: ' . $stmt->error;
        }
    }
}
?>
<div class="container">
  <h3>Upload Photo</h3>
  <?php foreach($errors as $e): ?><div class="alert alert-danger"><?php echo e($e); ?></div><?php endforeach; ?>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Destination</label>
      <select name="destination_id" class="form-control">
        <option value="">Select destination</option>
        <?php foreach ($destinations as $d): ?>
          <option value="<?php echo (int)$d['id']; ?>" <?php if(isset($_POST['destination_id']) && $_POST['destination_id']==$d['id']) echo 'selected'; ?>><?php echo e($d['name']); ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3"><label class="form-label">Caption</label><input name="caption" class="form-control" value="<?php echo e($_POST['caption'] ?? ''); ?>"></div>
    <div class="mb-3"><label class="form-label">Image</label><input type="file" name="image" accept="image/*" class="form-control"></div>
    <button class="btn btn-primary">Upload</button>
    <a class="btn btn-secondary" href="/admin/photos/index.php">Cancel</a>
  </form>
</div>
<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>
