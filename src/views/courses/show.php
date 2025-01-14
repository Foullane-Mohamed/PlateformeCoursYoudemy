<?php
// show.php

require_once '../../controllers/CourseController.php';

$courseController = new CourseController();
$courseId = $_GET['id'] ?? null;

if ($courseId) {
    $course = $courseController->show($courseId);
} else {
    // Redirect to courses index if no course ID is provided
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/app.css">
    <title><?php echo htmlspecialchars($course->title); ?></title>
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold"><?php echo htmlspecialchars($course->title); ?></h1>
        <p class="mt-2"><?php echo htmlspecialchars($course->description); ?></p>
        <h2 class="mt-4 text-xl">Details:</h2>
        <ul>
            <li><strong>Instructor:</strong> <?php echo htmlspecialchars($course->instructor->name); ?></li>
            <li><strong>Category:</strong> <?php echo htmlspecialchars($course->category->name); ?></li>
            <li><strong>Tags:</strong> <?php echo implode(', ', array_map('htmlspecialchars', $course->tags)); ?></li>
        </ul>
        <a href="index.php" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Back to Courses</a>
    </div>
</body>
</html>