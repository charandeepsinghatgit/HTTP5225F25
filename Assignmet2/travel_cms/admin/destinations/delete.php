<?php
require_once __DIR__ . '/../../db_connect.php';
require_once __DIR__ . '/../includes/auth_check.php';
$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM destinations WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
}
header('Location: /admin/destinations/index.php');
exit;
