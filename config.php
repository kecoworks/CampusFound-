<?php
session_start();
$host = 'localhost';
$db   = 'campus_lost_found';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];
try { $pdo = new PDO($dsn, $user, $pass, $options); }
catch (PDOException $e) { die("Database connection failed. Check config.php and import database.sql."); }

function e($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function logged_in() { return isset($_SESSION['user_id']); }
function require_login() {
    if (!logged_in()) { header('Location: login.php?next=report.php'); exit; }
}
function current_user() {
    return $_SESSION['user_name'] ?? 'Guest';
}
function flash($message, $type='success') {
    $_SESSION['flash'] = ['message'=>$message, 'type'=>$type];
}
function show_flash() {
    if (!empty($_SESSION['flash'])) {
        $f = $_SESSION['flash']; unset($_SESSION['flash']);
        echo '<div class="notice '.e($f['type']).'">'.e($f['message']).'</div>';
    }
}
?>
