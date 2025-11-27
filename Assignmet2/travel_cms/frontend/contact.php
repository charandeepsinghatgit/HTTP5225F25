<?php
include __DIR__ . '/header.php';
$sent = false;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    if ($name === '' || $email === '' || $message === '') $errors[] = 'All fields required';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email';
    if (empty($errors)) {
        $sent = true;
    }
}
?>
<h1>Contact</h1>
<?php if ($sent): ?><div class="alert alert-success">Thanks — message received (not actually emailed in this demo).</div><?php else: ?>
  <?php foreach($errors as $e): ?><div class="alert alert-danger"><?php echo e($e); ?></div><?php endforeach; ?>
  <form method="post" class="mb-4">
    <div class="mb-3"><label>Name</label><input name="name" class="form-control" value="<?php echo e($_POST['name'] ?? ''); ?>"></div>
    <div class="mb-3"><label>Email</label><input name="email" class="form-control" value="<?php echo e($_POST['email'] ?? ''); ?>"></div>
    <div class="mb-3"><label>Message</label><textarea name="message" class="form-control"><?php echo e($_POST['message'] ?? ''); ?></textarea></div>
    <button class="btn btn-primary">Send</button>
  </form>
<?php endif; ?>
<?php include __DIR__ . '/footer.php'; ?>
