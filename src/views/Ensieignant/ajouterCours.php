<?php
session_start();
require_once __DIR__ . '/../../models/Course.php';
require_once __DIR__ . '/../../models/Category.php';
require_once __DIR__ . '/../../models/Tag.php';
require_once __DIR__ . '/../../models/Enseignant.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'enseignant') {
    header('Location: ../auth/login.php');
    exit();
}

$courseModel = new Course(null, null, null, null, null, null, null);
$categories = $courseModel->getAllCategories();
$tagModel = new Tag(null);
$tags = $tagModel->getAllTags();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'] ?? '';
    $description = $_POST['description'] ?? '';
    $contenu = $_POST['contenu'] ?? '';
    $type_contenu = $_POST['type_contenu'] ?? '';
    $id_categorie = $_POST['id_categorie'] ?? '';
    $tags = $_POST['tags'] ?? [];

    if (!empty($titre) && !empty($description) && !empty($contenu) && !empty($type_contenu) && !empty($id_categorie) && !empty($tags)) {
        $enseignant = new Enseignant(null, null, null, null, null);
        $enseignant->id = $_SESSION['user']['id']; // Set the enseignant ID
        $courseId = $enseignant->ajouterCours($titre, $description, $contenu, $type_contenu, $id_categorie, $tags);

        header('Location: dashboard.php');
        exit();
    } else {
        $error = 'Please fill in all fields';
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Add Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full">
    <div class="min-h-screen bg-gray-50 flex">
        <!-- Sidebar -->
        <aside class="hidden lg:flex lg:flex-col lg:w-72 lg:fixed lg:inset-y-0 bg-white border-r border-gray-200">
            <!-- Logo -->
            <div class="flex items-center h-16 px-6 border-b border-gray-200 bg-white">
                <div class="flex items-center gap-2">
                    <div class="bg-indigo-600 p-2 rounded-lg">
                        <i class="fas fa-chalkboard-teacher text-white"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-900">Youdemy</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-8 overflow-y-auto">
                <div>
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Main</h3>
                    <div class="mt-4 space-y-1">
                        <a href="dashboard.php" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-chart-line w-5 h-5"></i>
                            <span class="ml-3">Dashboard</span>
                        </a>
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-book w-5 h-5"></i>
                            <span class="ml-3">My Courses</span>
                        </a>
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-users w-5 h-5"></i>
                            <span class="ml-3">Students</span>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Content</h3>
                    <div class="mt-4 space-y-1">
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="fas fa-plus-circle w-5 h-5"></i>
                            <span class="ml-3">Create Course</span>
                        </a>
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-comments w-5 h-5"></i>
                            <span class="ml-3">Reviews</span>
                        </a>
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-certificate w-5 h-5"></i>
                            <span class="ml-3">Certificates</span>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Settings</h3>
                    <div class="mt-4 space-y-1">
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-cog w-5 h-5"></i>
                            <span class="ml-3">Profile</span>
                        </a>
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-bell w-5 h-5"></i>
                            <span class="ml-3">Notifications</span>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Profile Section -->
            <div class="border-t border-gray-200 p-4">
                <div class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50">
                    <img src="https://ui-avatars.com/api/?name=John+Doe" alt="Teacher" class="w-8 h-8 rounded-lg">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">John Doe</p>
                        <p class="text-xs text-gray-500 truncate">Web Development</p>
                    </div>
                    <button class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-cog"></i>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="lg:pl-72 flex flex-col flex-1">
            <!-- Top Navigation -->
            <header class="sticky top-0 z-10 bg-white border-b border-gray-200">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <button class="lg:hidden text-gray-500 hover:text-gray-600">
                                <i class="fas fa-bars text-xl"></i>
                            </button>
                            <div class="hidden sm:block">
                                <input type="text"
                                       placeholder="Search your courses..."
                                       class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <button class="relative p-2 text-gray-400 hover:text-gray-500">
                                <i class="fas fa-bell"></i>
                                <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500"></span>
                            </button>
                            <button class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-50">
                                <img src="https://ui-avatars.com/api/?name=John+Doe" alt="Teacher" class="w-8 h-8 rounded-lg">
                                <span class="hidden sm:block font-medium text-sm text-gray-700">John Doe</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6">
                <!-- Welcome Section -->
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-900">Add New Course</h1>
                    <p class="mt-2 text-sm text-gray-600">Fill in the details to create a new course.</p>
                </div>

                <!-- Add Course Form -->
                <form action="ajouterCours.php" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl border border-gray-200">
                    <div class="mb-4">
                        <label for="titre" class="block text-sm font-medium text-gray-700">Course Title</label>
                        <input type="text" id="titre" name="titre" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="description" name="description" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" rows="4" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="contenu" class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea id="contenu" name="contenu" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" rows="6" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="type_contenu" class="block text-sm font-medium text-gray-700">Content Type</label>
                        <select id="type_contenu" name="type_contenu" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" required>
                            <option value="video">Video</option>
                            <option value="document">Document</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="id_categorie" class="block text-sm font-medium text-gray-700">Category</label>
                        <select id="id_categorie" name="id_categorie" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['id_categorie']; ?>"><?php echo htmlspecialchars($category['nom']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                        <select id="tags" name="tags[]" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" multiple required>
                            <?php foreach ($tags as $tag): ?>
                                <option value="<?php echo $tag['id_tag']; ?>"><?php echo htmlspecialchars($category['nom']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="w-full bg-indigo-600 text-white p-2 rounded-lg hover:bg-indigo-700">Create Course</button>
                    </div>
                </form>
            </main>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const menuButton = document.querySelector('button');
        const sidebar = document.querySelector('aside');

        menuButton.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!sidebar.contains(e.target) && !menuButton.contains(e.target)) {
                sidebar.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
