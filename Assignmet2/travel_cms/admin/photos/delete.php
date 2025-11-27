<?php
require_once __DIR__ . '/../../db_connect.php';
require_once __DIR__ . '/../includes/auth_check.php';
$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    $stmt = $conn->prepare("SELECT image FROM destination_photos WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $file = $res->fetch_assoc()['image'] ?? null;
    if ($file) {
        @unlink(__DIR__ . '/../../uploads/photos/' . $file);
    }
    $stmt = $conn->prepare("DELETE FROM destination_photos WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
}
header('Location: /admin/photos/index.php');
exit;
