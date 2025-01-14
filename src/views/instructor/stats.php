<?php
// stats.php

require_once '../../controllers/InstructorController.php';

$instructorController = new InstructorController();
$statistics = $instructorController->getInstructorStatistics();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/app.css">
    <title>Instructor Statistics</title>
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Instructor Statistics</h1>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-2">Statistics Overview</h2>
            <ul>
                <li>Total Courses: <?php echo $statistics['total_courses']; ?></li>
                <li>Total Students Enrolled: <?php echo $statistics['total_students']; ?></li>
                <li>Average Rating: <?php echo $statistics['average_rating']; ?></li>
            </ul>
        </div>
    </div>
</body>
</html>