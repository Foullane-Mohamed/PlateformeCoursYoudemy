<?php
session_start();
require_once __DIR__ . '/../../models/Course.php';
require_once __DIR__ . '/../../models/User.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'etudiant') {
    header('Location: ../auth/login.php');
    exit();
}

$search = filter_input(INPUT_GET, 'search', FILTER_DEFAULT);
$categoryId = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);

$courseModel = new Course();
$courses = $courseModel->getAllCoursesWithDetails($categoryId, $search);
$categories = $courseModel->getAllCategories();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <!-- Navigation améliorée -->
    <nav class="bg-white/90 backdrop-blur-sm shadow-md sticky top-0 z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <a href="dashboard.php" class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                    Youdemy
                </a>
                <div class="flex items-center space-x-8">
                    <a href="dashboard.php" class="text-gray-700 hover:text-indigo-600 transition-colors font-medium">
                        Dashboard
                    </a>
                    <a href="myCourses.php" class="text-gray-700 hover:text-indigo-600 transition-colors font-medium">
                        Mes cours
                    </a>
                    <div class="w-px h-6 bg-gray-200"></div>
                    <a href="../auth/logout.php" class="px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-full hover:shadow-lg transition-all duration-300 font-medium">
                        Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="mb-12">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Catalogue des cours</h1>
            <p class="text-gray-600">Découvrez notre sélection de cours et commencez votre apprentissage</p>
        </div>

    <!-- Formulaire de recherche -->
<form method="GET" action="" class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 mb-8">
    <div class="flex flex-col md:flex-row gap-4">
        <input 
            type="text" 
            name="search" 
            placeholder="Rechercher un cours..." 
            class="flex-1 px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none"
            value="<?= isset($search) ? htmlspecialchars($search) : '' ?>"
        >
        <select 
            name="category_id" 
            class="w-full md:w-64 px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none"
        >
            <option value="">Toutes catégories</option>
            <?php if (isset($categories) && is_array($categories)): ?>
                <?php foreach ($categories as $cat): ?>
                    <option 
                        value="<?= $cat['id_categorie'] ?>"
                        <?= (isset($categoryId) && $cat['id_categorie'] == $categoryId) ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($cat['nom']) ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <button type="submit" class="w-full md:w-auto px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all duration-300">
            <span class="flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Rechercher
            </span>
        </button>
    </div>
</form>

        <!-- Liste des cours -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($courses as $course): ?>
                <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 overflow-hidden group">
                    <div class="p-6 space-y-4">
                        <h3 class="text-xl font-bold text-gray-800 truncate">
                            <?= htmlspecialchars($course['titre']) ?>
                        </h3>
                        <p class="text-gray-600 text-sm line-clamp-3">
                            <?= htmlspecialchars($course['description']) ?>
                        </p>
                        <div class="flex items-center justify-between pt-4">
                            <span class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-full text-sm font-medium">
                                <?= htmlspecialchars($course['category_name']) ?>
                            </span>
                            <a href="course_details.php?id=<?= $course['id'] ?>" 
                               class="inline-flex items-center text-indigo-600 hover:text-purple-600 font-medium group-hover:translate-x-1 transition-all duration-300">
                                Voir détails
                                <span class="ml-2">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>