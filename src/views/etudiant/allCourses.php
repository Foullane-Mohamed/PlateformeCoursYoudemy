<?php
session_start();
require_once __DIR__ . '/../../models/Course.php';
require_once __DIR__ . '/../../models/User.php';

// Vérification authentification étudiant
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'etudiant') {
    header('Location: ../auth/login.php');
    exit();
}

// Gestion des filtres
$search = filter_input(INPUT_GET, 'search', FILTER_DEFAULT); // Utilisation de FILTER_DEFAULT
$categoryId = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);

// Récupération données
$courseModel = new Course();
$courses = $courseModel->getAllCoursesWithDetails($categoryId, $search);
$categories = $courseModel->getAllCategories();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="dashboard.php" class="text-2xl font-bold text-indigo-600">Youdemy</a>
                <div class="flex items-center gap-6">
                    <a href="dashboard.php" class="hover:text-indigo-600">Mes cours</a>
                    <a href="../auth/logout.php" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">Déconnexion</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        <!-- Formulaire de recherche -->
        <form class="mb-8 bg-white p-6 rounded-xl shadow-sm">
            <div class="flex gap-4">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Rechercher un cours..."
                    class="flex-1 p-3 border rounded-lg"
                    value="<?= htmlspecialchars($search) ?>"
                >
                <select 
                    name="category_id" 
                    class="p-3 border rounded-lg w-64"
                >
                    <option value="">Toutes catégories</option>
                    <?php foreach ($categories as $cat): ?>
                        <option 
                            value="<?= $cat['id_categorie'] ?>"
                            <?= $cat['id_categorie'] == $categoryId ? 'selected' : '' ?>
                        >
                            <?= htmlspecialchars($cat['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">
                    Filtrer
                </button>
            </div>
        </form>

        <!-- Liste des cours -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($courses as $course): ?>
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 truncate"><?= htmlspecialchars($course['titre']) ?></h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3"><?= htmlspecialchars($course['description']) ?></p>
                        
                        <div class="flex items-center justify-between text-sm">
                            <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full">
                                <?= htmlspecialchars($course['category_name']) ?>
                            </span>
                            <a 
                                href="course_details.php?id=<?= $course['id'] ?>" 
                                class="text-indigo-600 hover:underline"
                            >
                                Voir détails →
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>