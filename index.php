<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/configs/env.php';
require_once __DIR__ . '/configs/helper.php';

$action = isset($_GET['act']) ? trim($_GET['act']) : '';
if ($action === '') {
    header('Location: ' . '?act=home');
    exit;
}

if (strpos($action, 'admin-') === 0) {
    require_once __DIR__ . '/routes/admin.php';
} else {
    require_once __DIR__ . '/routes/client.php';
}

