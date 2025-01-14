<?php
session_start();
require_once '../../config/database.php';
require_once '../../controllers/StudentController.php';

$studentController = new StudentController();
$courses = $studentController->getEnrolledCourses($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../public/css/app.css" rel="stylesheet">
    <title>Student Dashboard</title>
</head>
<body>
    <?php include '../layouts/app.php'; ?>

    <div class="container mx-auto mt-5">
        <h1 class="text-2xl font-bold">Welcome to Your Dashboard</h1>
        <h2 class="text-xl mt-4">Your Enrolled Courses</h2>
        <ul class="mt-2">
            <?php if (empty($courses)): ?>
                <li>No courses enrolled yet.</li>
            <?php else: ?>
                <?php foreach ($courses as $course): ?>
                    <li class="mt-2">
                        <a href="../courses/show.php?id=<?php echo $course['id']; ?>" class="text-blue-500">
                            <?php echo htmlspecialchars($course['title']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>