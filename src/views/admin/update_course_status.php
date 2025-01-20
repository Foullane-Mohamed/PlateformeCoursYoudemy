<?php
session_start();

require_once __DIR__ . '/../../config/connection.php';
require_once __DIR__ . '/../../models/Course.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['course_id']) && isset($_POST['action'])) {
    $courseId = $_POST['course_id'];
    $action = $_POST['action'];

    $courseModel = new Course();

    try {
        if ($action === 'approve') {
            $courseModel->updateCourseStatus($courseId, 'actif');
            $_SESSION['message'] = 'Cours approuvé avec succès';
            $_SESSION['messageType'] = 'success';
        } elseif ($action === 'reject') {
            $courseModel->updateCourseStatus($courseId, 'inactif');
            $_SESSION['message'] = 'Cours refusé avec succès';
            $_SESSION['messageType'] = 'success';
        }
    } catch (Exception $e) {
        $_SESSION['message'] = 'Erreur lors de la mise à jour du cours: ' . $e->getMessage();
        $_SESSION['messageType'] = 'error';
    }

    header('Location: dashboard.php');
    exit();
}