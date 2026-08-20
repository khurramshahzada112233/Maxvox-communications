<?php

declare(strict_types=1);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

if (!isset($_FILES['cv']) || ($_FILES['cv']['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
    echo json_encode(['success' => true, 'url' => '', 'fileName' => '']);
    exit;
}

$cv = $_FILES['cv'];
$maxSize = 5 * 1024 * 1024;
$allowedExtensions = ['pdf', 'doc', 'docx'];
$allowedMimeTypes = [
    'application/pdf',
    'application/msword',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'application/octet-stream',
];

if (($cv['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'CV upload failed.']);
    exit;
}

if (($cv['size'] ?? 0) > $maxSize) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'CV must be 5 MB or smaller.']);
    exit;
}

$extension = strtolower(pathinfo((string) $cv['name'], PATHINFO_EXTENSION));
if (!in_array($extension, $allowedExtensions, true)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Only PDF, DOC, and DOCX files are accepted.']);
    exit;
}

$detectedMime = is_uploaded_file($cv['tmp_name']) ? (mime_content_type($cv['tmp_name']) ?: '') : '';
if ($detectedMime !== '' && !in_array($detectedMime, $allowedMimeTypes, true)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Uploaded CV file type is not accepted.']);
    exit;
}

$uploadDir = dirname(__DIR__) . '/storage/cv';
if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Unable to prepare upload directory.']);
    exit;
}

$baseName = pathinfo((string) $cv['name'], PATHINFO_FILENAME);
$safeName = preg_replace('/[^a-zA-Z0-9_-]+/', '-', strtolower($baseName)) ?: 'cv';
$storedFileName = $safeName . '-' . date('Ymd-His') . '-' . bin2hex(random_bytes(4)) . '.' . $extension;
$storedPath = $uploadDir . '/' . $storedFileName;

if (!is_uploaded_file($cv['tmp_name']) || !move_uploaded_file($cv['tmp_name'], $storedPath)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Unable to save uploaded CV.']);
    exit;
}

$configuredUrl = '';
$envPath = dirname(__DIR__) . '/.env';
if (is_file($envPath)) {
    foreach (file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [] as $line) {
        if (preg_match('/^APP_URL=(.*)$/', trim($line), $matches)) {
            $configuredUrl = trim($matches[1], " \t\n\r\0\x0B\"'");
            break;
        }
    }
}

if ($configuredUrl !== '' && !str_contains($configuredUrl, 'localhost') && !str_contains($configuredUrl, '127.0.0.1')) {
    $baseUrl = rtrim($configuredUrl, '/');
} else {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
    $baseUrl = $scheme . '://' . $host . ($basePath === '' ? '' : $basePath);
}

$url = $baseUrl . '/download_cv.php?file=' . rawurlencode($storedFileName);

echo json_encode([
    'success' => true,
    'url' => $url,
    'fileName' => $storedFileName,
]);
