<?php
session_start();
require_once '../../config/database.php';
require_once '../../controllers/InstructorController.php';

$instructorController = new InstructorController();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'instructor') {
    header('Location: /auth/login.php');
    exit();
}

$courses = $instructorController->getCoursesByInstructor($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/public/css/app.css" rel="stylesheet">
    <title>Instructor Dashboard</title>
</head>
<body>
    <?php include '../layouts/app.php'; ?>
    
    <div class="container mx-auto mt-5">
        <h1 class="text-2xl font-bold">Instructor Dashboard</h1>
        <div class="mt-4">
            <h2 class="text-xl">My Courses</h2>
            <ul class="list-disc pl-5">
                <?php foreach ($courses as $course): ?>
                    <li>
                        <a href="/views/courses/show.php?id=<?= $course['id'] ?>" class="text-blue-500"><?= htmlspecialchars($course['title']) ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>
</html>