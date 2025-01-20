<?php
session_start();
require_once __DIR__ . '/../../models/Etudiant.php';

// Vérification authentification et rôle
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'etudiant') {
    header('Location: ../auth/login.php');
    exit();
}

// Validation données
$courseId = filter_input(INPUT_POST, 'course_id', FILTER_VALIDATE_INT);
if (!$courseId) {
    $_SESSION['error'] = "Cours invalide";
    header('Location: allCourses.php');
    exit();
}

// Récupérer l'ID de l'étudiant depuis la session
$idEtudiant = $_SESSION['user']['id'];
if (!$idEtudiant) {
    $_SESSION['error'] = "ID étudiant non trouvé";
    header('Location: allCourses.php');
    exit();
}

// Traitement inscription
try {
    $etudiant = new Etudiant();
    $result = $etudiant->inscriptionCours($idEtudiant, $courseId);
    
    if ($result['success']) {
        $_SESSION['success'] = $result['message'];
    } else {
        $_SESSION['error'] = $result['message'];
    }
} catch (PDOException $e) {
    $_SESSION['error'] = "Erreur technique : " . $e->getMessage();
}

// Redirection
header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'allCourses.php'));
exit();