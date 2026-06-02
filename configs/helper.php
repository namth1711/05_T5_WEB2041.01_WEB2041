<?php

if (!function_exists('redirect')) {
    function redirect($url) {
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $current = $scheme . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $normalizedCurrent = rtrim($current, '/');
        $normalizedUrl = rtrim($url, '/');
        if ($normalizedCurrent === $normalizedUrl) {
            return;
        }
        header("Location: " . $url);
        exit();
    }
}

if (!function_exists('asset')) {
    function asset($path) {
        return BASE_URL . $path;
    }
}

if (!function_exists('renderView')) {
    function renderView($viewFile, $data = [], $layout = 'client/main.php') {
        extract($data);
        
        $viewContent = __DIR__ . '/../views/' . $viewFile . '.php';
        
        require_once __DIR__ . '/../views/' . $layout;
    }
}

if (!function_exists('dd')) {
    function dd($value) {
        echo "<pre style='background:#222; color:#0f0; padding:15px; border-radius:5px;'>";
        var_dump($value);
        echo "</pre>";
        die();
    }
}

