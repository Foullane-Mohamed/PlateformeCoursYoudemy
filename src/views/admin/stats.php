<?php
// stats.php

require_once '../../controllers/AdminController.php';

$adminController = new AdminController();
$statistics = $adminController->getStatistics();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/app.css">
    <title>Statistiques - Youdemy</title>
</head>
<body>
    <?php include '../layouts/app.php'; ?>

    <div class="container mx-auto mt-5">
        <h1 class="text-2xl font-bold">Statistiques</h1>
        <div class="mt-4">
            <h2 class="text-xl">Nombre total de cours: <?php echo $statistics['total_courses']; ?></h2>
            <h2 class="text-xl">Nombre total d'étudiants: <?php echo $statistics['total_students']; ?></h2>
            <h2 class="text-xl">Nombre total d'enseignants: <?php echo $statistics['total_instructors']; ?></h2>
            <h2 class="text-xl">Cours avec le plus d'étudiants: <?php echo $statistics['most_enrolled_course']; ?></h2>
            <h2 class="text-xl">Top 3 enseignants:</h2>
            <ul>
                <?php foreach ($statistics['top_instructors'] as $instructor): ?>
                    <li><?php echo $instructor; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>
</html>