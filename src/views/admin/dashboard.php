<?php
// dashboard.php

session_start();
require_once '../../config/database.php';
require_once '../../controllers/AdminController.php';

$adminController = new AdminController();
$stats = $adminController->getStatistics();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/app.css">
    <title>Tableau de bord Administrateur</title>
</head>
<body>
    <?php include '../layouts/app.php'; ?>

    <div class="container mx-auto mt-5">
        <h1 class="text-2xl font-bold">Tableau de bord Administrateur</h1>
        <div class="mt-4">
            <h2 class="text-xl">Statistiques</h2>
            <ul>
                <li>Nombre total d'utilisateurs: <?php echo $stats['total_users']; ?></li>
                <li>Nombre total de cours: <?php echo $stats['total_courses']; ?></li>
                <li>Nombre d'étudiants inscrits: <?php echo $stats['total_students']; ?></li>
                <li>Nombre d'enseignants: <?php echo $stats['total_instructors']; ?></li>
            </ul>
        </div>
    </div>
</body>
</html>