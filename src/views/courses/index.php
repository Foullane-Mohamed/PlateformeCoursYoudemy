<!-- <?php
require_once '../../config/database.php';
require_once '../../controllers/CourseController.php';

$courseController = new CourseController();
$courses = $courseController->getAllCourses();

include '../layouts/app.php';
?>

<div class="container mx-auto mt-5">
    <h1 class="text-2xl font-bold">Liste des Cours</h1>
    <table class="min-w-full mt-4 border">
        <thead>
            <tr>
                <th class="border px-4 py-2">Titre</th>
                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($course['title']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($course['description']); ?></td>
                    <td class="border px-4 py-2">
                        <a href="show.php?id=<?php echo $course['id']; ?>" class="text-blue-500">Voir</a>
                        <a href="edit.php?id=<?php echo $course['id']; ?>" class="text-yellow-500 ml-2">Modifier</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div> -->