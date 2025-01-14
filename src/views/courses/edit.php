<?php
// edit.php

require_once '../../controllers/CourseController.php';

$courseController = new CourseController();

if (isset($_GET['id'])) {
    $courseId = $_GET['id'];
    $course = $courseController->getCourseById($courseId);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseData = [
        'id' => $_POST['id'],
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'content' => $_POST['content'],
        'tags' => $_POST['tags'],
        'category' => $_POST['category']
    ];
    
    $courseController->updateCourse($courseData);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/public/css/app.css" rel="stylesheet">
    <title>Edit Course</title>
</head>
<body>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold">Edit Course</h1>
        <form action="edit.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $course->id; ?>">
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="<?php echo $course->title; ?>" required>
            </div>
            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" required><?php echo $course->description; ?></textarea>
            </div>
            <div>
                <label for="content">Content</label>
                <textarea name="content" id="content" required><?php echo $course->content; ?></textarea>
            </div>
            <div>
                <label for="tags">Tags</label>
                <input type="text" name="tags" id="tags" value="<?php echo implode(', ', $course->tags); ?>">
            </div>
            <div>
                <label for="category">Category</label>
                <input type="text" name="category" id="category" value="<?php echo $course->category; ?>" required>
            </div>
            <button type="submit">Update Course</button>
        </form>
    </div>
</body>
</html>