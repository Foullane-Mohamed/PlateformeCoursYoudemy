<?php
session_start();
require_once __DIR__ . '/../../models/Etudiant.php';
require_once __DIR__ . '/../../models/User.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'etudiant') {
    header('Location: ../auth/login.php');
    exit();
}

$user = User::findById($_SESSION['user']['id']);
$etudiant = new Etudiant();
$courses = $etudiant->getMesCours($_SESSION['user']['id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .card-hover:hover { transform: translateY(-5px); }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <!-- Navigation améliorée -->
    <nav class="bg-white/90 backdrop-blur-sm shadow-md sticky top-0 z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-8">
                    <a href="dashboard.php" class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                        Youdemy
                    </a>
                </div>
                <div class="flex items-center space-x-8">
                    <a href="myCourses.php" class="text-gray-700 hover:text-indigo-600 transition-colors font-medium">
                        Mes cours
                    </a>
                    <a href="allCourses.php" class="text-gray-700 hover:text-indigo-600 transition-colors font-medium">
                        Catalogue
                    </a>
                    <div class="h-6 w-px bg-gray-200"></div>
                    <div class="flex items-center space-x-3">
                        <span class="text-gray-600"><?= htmlspecialchars($user['nom']) ?></span>
                    </div>
                    <a href="../auth/logout.php" class="px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-full hover:shadow-lg transition-all duration-300 font-medium">
                        Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="max-w-7xl mx-auto px-6 py-12">
        <!-- En-tête avec bienvenue -->
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">
                Bienvenue, <?= htmlspecialchars($user['nom']) ?> 
            </h1>
          
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Cours suivis</h2>
                    <div class="p-2 bg-indigo-50 rounded-lg">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                    <?= count($courses) ?>
                </p>
                <p class="text-sm text-gray-500 mt-2">cours au total</p>
            </div>

            <!-- Vous pouvez ajouter d'autres cartes de statistiques ici -->
        </div>

        <!-- Liste des cours récents -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Mes cours récents</h2>
            
            <?php if (empty($courses)): ?>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                    <div class="max-w-md mx-auto">
                        <div class="bg-indigo-50 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Aucun cours suivi</h3>
                        <p class="text-gray-600 mb-8">
                            Commencez votre apprentissage en explorant notre catalogue de cours
                        </p>
                    
                    </div>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($courses as $course): ?>
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 overflow-hidden group card-hover">
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-4 truncate">
                                    <?= htmlspecialchars($course['titre']) ?>
                                </h3>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">
                                        Inscrit le <?= date('d/m/Y', strtotime($course['date_inscription'])) ?>
                                    </span>
                                    <a href="course_details.php?id=<?= $course['id'] ?>" 
                                       class="inline-flex items-center text-indigo-600 hover:text-purple-600 font-medium transition-colors duration-300">
                                        Continuer
                                        <span class="ml-2 group-hover:translate-x-1 transition-transform duration-300">→</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Bouton d'action -->
        <div class="text-center mt-12">
            <a href="allCourses.php" 
               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-full hover:shadow-lg transition-all duration-300 font-medium group">
                Découvrir plus de cours
                <span class="ml-2 group-hover:translate-x-1 transition-transform duration-300">→</span>
            </a>
        </div>
    </main>
</body>
</html>