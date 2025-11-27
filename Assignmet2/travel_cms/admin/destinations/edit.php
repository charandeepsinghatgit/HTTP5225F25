<?php
require_once __DIR__ . '/../../db_connect.php';
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../includes/admin_header.php';
require_once __DIR__ . '/../includes/functions.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) { header('Location: index.php'); exit; }
$stmt = $conn->prepare("SELECT * FROM destinations WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) { echo "Not found"; exit; }
$row = $res->fetch_assoc();

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $country = trim($_POST['country'] ?? '');
    $desc = trim($_POST['description'] ?? '');
    $rating = floatval($_POST['rating'] ?? 0);
    $date_added = $_POST['date_added'] ?? date('Y-m-d');
    $youtube_id = trim($_POST['youtube_id'] ?? '');
    if ($name === '' || $country === '') $errors[] = 'Name and country required.';
    if ($youtube_id !== '' && !is_valid_youtube_id($youtube_id)) $errors[] = 'Invalid YouTube ID';

    $img_error = '';
    $uploaded = upload_image('image', __DIR__ . '/../../uploads/destinations', $img_error);
    if ($img_error) $errors[] = $img_error;

    if (empty($errors)) {
        $image_to_store = $uploaded ? $uploaded : $row['image'];
        $stmt = $conn->prepare("UPDATE destinations SET name=?,country=?,description=?,rating=?,date_added=?,image=?,youtube_id=? WHERE id=?");
        $stmt->bind_param('sssdsssi', $name, $country, $desc, $rating, $date_added, $image_to_store, $youtube_id, $id);
        if ($stmt->execute()) {
            header('Location: /admin/destinations/index.php');
            exit;
        } else {
            $errors[] = 'Database error: ' . $stmt->error;
        }
    }
}
?>
<div class="container">
  <h3>Edit Destination #<?php echo $row['id']; ?></h3>
  <?php foreach($errors as $e): ?><div class="alert alert-danger"><?php echo e($e); ?></div><?php endforeach; ?>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3"><label class="form-label">Name</label><input name="name" class="form-control" value="<?php echo e($_POST['name'] ?? $row['name']); ?>"></div>
    <div class="mb-3"><label class="form-label">Country</label><input name="country" class="form-control" value="<?php echo e($_POST['country'] ?? $row['country']); ?>"></div>
    <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control"><?php echo e($_POST['description'] ?? $row['description']); ?></textarea></div>
    <div class="mb-3"><label class="form-label">Rating</label><input name="rating" type="number" step="0.1" class="form-control" value="<?php echo e($_POST['rating'] ?? $row['rating']); ?>"></div>
    <div class="mb-3"><label class="form-label">Date Added</label><input name="date_added" type="date" class="form-control" value="<?php echo e($_POST['date_added'] ?? $row['date_added']); ?>"></div>
    <div class="mb-3">
      <label class="form-label">Main Image</label>
      <?php if ($row['image']): ?><div class="mb-2"><img src="/uploads/destinations/<?php echo e($row['image']); ?>" style="max-width:200px"></div><?php endif; ?>
      <input type="file" name="image" accept="image/*" class="form-control">
    </div>
    <div class="mb-3"><label class="form-label">YouTube Video ID (optional)</label><input name="youtube_id" class="form-control" value="<?php echo e($_POST['youtube_id'] ?? $row['youtube_id']); ?>"></div>
    <button class="btn btn-primary">Save</button>
    <a class="btn btn-secondary" href="/admin/destinations/index.php">Cancel</a>
  </form>
</div>
<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>
