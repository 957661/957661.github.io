<?php
require_once __DIR__ . "/config.php";

function data_path($name) {
    return __DIR__ . "/data/" . $name . ".json";
}

function load_json($name) {
    $path = data_path($name);
    if (!file_exists($path)) return [];
    $json = file_get_contents($path);
    $arr = json_decode($json, true);
    return is_array($arr) ? $arr : [];
}

function save_json($name, $data) {
    $path = data_path($name);
    $fp = fopen($path, "c+");
    if (!$fp) return false;
    // 获取独占锁
    if (flock($fp, LOCK_EX)) {
        ftruncate($fp, 0);
        fwrite($fp, json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
        fflush($fp);
        flock($fp, LOCK_UN);
        fclose($fp);
        return true;
    } else {
        fclose($fp);
        return false;
    }
}

function ensure_session() {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function is_logged_in() {
    ensure_session();
    return !empty($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function require_login() {
    if (!is_logged_in()) {
        header("Location: admin.php");
        exit;
    }
}

function csrf_token() {
    ensure_session();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['csrf_token'];
}

function check_csrf() {
    ensure_session();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
            http_response_code(400);
            die("CSRF 验证失败");
        }
    }
}