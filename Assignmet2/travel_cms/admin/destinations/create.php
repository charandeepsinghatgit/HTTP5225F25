<?php
require_once __DIR__ . '/../../db_connect.php';
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../includes/admin_header.php';
require_once __DIR__ . '/../includes/functions.php';

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
        $stmt = $conn->prepare("INSERT INTO destinations (name,country,description,rating,date_added,image,youtube_id) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param('sssdsss', $name, $country, $desc, $rating, $date_added, $uploaded, $youtube_id);
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
  <h3>Create Destination</h3>
  <?php foreach($errors as $e): ?><div class="alert alert-danger"><?php echo e($e); ?></div><?php endforeach; ?>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3"><label class="form-label">Name</label><input name="name" class="form-control" value="<?php echo e($_POST['name'] ?? ''); ?>"></div>
    <div class="mb-3"><label class="form-label">Country</label><input name="country" class="form-control" value="<?php echo e($_POST['country'] ?? ''); ?>"></div>
    <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control"><?php echo e($_POST['description'] ?? ''); ?></textarea></div>
    <div class="mb-3"><label class="form-label">Rating</label><input name="rating" type="number" step="0.1" class="form-control" value="<?php echo e($_POST['rating'] ?? ''); ?>"></div>
    <div class="mb-3"><label class="form-label">Date Added</label><input name="date_added" type="date" class="form-control" value="<?php echo e($_POST['date_added'] ?? date('Y-m-d')); ?>"></div>
    <div class="mb-3"><label class="form-label">Main Image</label><input type="file" name="image" accept="image/*" class="form-control"></div>
    <div class="mb-3"><label class="form-label">YouTube Video ID (optional)</label><input name="youtube_id" class="form-control" value="<?php echo e($_POST['youtube_id'] ?? ''); ?>"></div>
    <button class="btn btn-primary">Create</button>
    <a class="btn btn-secondary" href="/admin/destinations/index.php">Cancel</a>
  </form>
</div>
<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>
