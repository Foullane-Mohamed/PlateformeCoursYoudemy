<?php
// create.php - View for creating a new course

require_once '../../controllers/CourseController.php';

$courseController = new CourseController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $content = $_POST['content'] ?? '';
    $tags = $_POST['tags'] ?? '';
    $category = $_POST['category'] ?? '';

    $courseController->createCourse($title, $description, $content, $tags, $category);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/public/css/app.css" rel="stylesheet">
    <title>Create Course</title>
</head>
<body>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Create New Course</h1>
        <form action="" method="POST" class="space-y-4">
            <div>
                <label for="title" class="block">Title:</label>
                <input type="text" name="title" id="title" required class="border p-2 w-full">
            </div>
            <div>
                <label for="description" class="block">Description:</label>
                <textarea name="description" id="description" required class="border p-2 w-full"></textarea>
            </div>
            <div>
                <label for="content" class="block">Content:</label>
                <textarea name="content" id="content" required class="border p-2 w-full"></textarea>
            </div>
            <div>
                <label for="tags" class="block">Tags:</label>
                <input type="text" name="tags" id="tags" class="border p-2 w-full">
            </div>
            <div>
                <label for="category" class="block">Category:</label>
                <input type="text" name="category" id="category" required class="border p-2 w-full">
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2">Create Course</button>
        </form>
    </div>
</body>
</html>