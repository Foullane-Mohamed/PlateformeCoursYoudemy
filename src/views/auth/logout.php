<?php
require_once __DIR__ . '/../../models/Auth.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$auth = new Auth();
$result = $auth->logout();

header("Location: login.php");
exit();