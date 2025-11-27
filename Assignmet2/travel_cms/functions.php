<?php
// functions.php (shared helpers)
function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function is_valid_youtube_id($id) {
    return preg_match('/^[a-zA-Z0-9_-]{8,20}$/', $id);
}

function upload_image($file_input_name, $target_dir, &$error_out) {
    $error_out = '';
    if (!isset($_FILES[$file_input_name]) || $_FILES[$file_input_name]['error'] === UPLOAD_ERR_NO_FILE) {
        return null; // no file uploaded
    }
    $f = $_FILES[$file_input_name];
    if ($f['error'] !== UPLOAD_ERR_OK) { $error_out = 'Upload error'; return null; }

    $validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $f['tmp_name']);
    finfo_close($finfo);
    if (!in_array($mime, $validTypes)) { $error_out = 'Invalid image type'; return null; }

    if ($f['size'] > 4 * 1024 * 1024) { $error_out = 'File too large (max 4MB)'; return null; }

    $ext = pathinfo($f['name'], PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8)) . '.' . $ext;
    $target = rtrim($target_dir, '/') . '/' . $basename;
    if (!move_uploaded_file($f['tmp_name'], $target)) { $error_out = 'Could not move uploaded file'; return null; }

    return $basename;
}
