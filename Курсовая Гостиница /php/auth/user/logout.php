<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../connect/connect.php';


session_start();

// Удаляем все переменные сессии
$_SESSION = array();

// Если требуется уничтожить сессию, то удаляем и сессионную cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Наконец уничтожаем сессию
session_destroy();

header("Location: /index.php"); //перенаправляем пользователя на главную страницу или страницу входа
exit;