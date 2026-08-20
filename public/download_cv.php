<?php

declare(strict_types=1);

$file = (string) ($_GET['file'] ?? '');

if ($file === '' || !preg_match('/^[a-zA-Z0-9._-]+\.(pdf|doc|docx)$/i', $file)) {
    http_response_code(404);
    echo 'File not found.';
    exit;
}

$storageDir = dirname(__DIR__) . '/storage/cv';
$path = $storageDir . '/' . $file;
$realStorageDir = realpath($storageDir);
$realPath = realpath($path);

if ($realStorageDir === false || $realPath === false || !str_starts_with($realPath, $realStorageDir) || !is_file($realPath)) {
    http_response_code(404);
    echo 'File not found.';
    exit;
}

$extension = strtolower(pathinfo($realPath, PATHINFO_EXTENSION));
$mimeTypes = [
    'pdf' => 'application/pdf',
    'doc' => 'application/msword',
    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
];

header('Content-Type: ' . ($mimeTypes[$extension] ?? 'application/octet-stream'));
header('Content-Length: ' . filesize($realPath));
header('X-Content-Type-Options: nosniff');

if ($extension === 'pdf') {
    header('Content-Disposition: inline; filename="' . basename($realPath) . '"');
} else {
    header('Content-Disposition: attachment; filename="' . basename($realPath) . '"');
}

readfile($realPath);
exit;
