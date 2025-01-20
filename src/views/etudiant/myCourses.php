<?php
session_start();
require_once __DIR__ . '/../../models/Etudiant.php';
require_once __DIR__ . '/../../models/User.php';

// Vérification authentification
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'etudiant') {
    header('Location: ../auth/login.php');
    exit();
}

// Récupération données
$user = User::findById($_SESSION['user']['id']);
$etudiant = new Etudiant();
$courses = $etudiant->getMesCours($_SESSION['user']['id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes cours - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <span class="text-2xl font-bold text-indigo-600">Youdemy</span>
            <div class="flex items-center gap-6">
                <a href="dashboard.php" class="hover:text-indigo-600">Dashboard</a>
                <a href="../auth/logout.php" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">Déconnexion</a>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Mes cours</h1>

        <?php if (empty($courses)): ?>
            <div class="text-center py-16 bg-white rounded-xl shadow-sm">
                <div class="max-w-md mx-auto">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium">Aucun cours suivi</h3>
                    <p class="mt-1 text-gray-600">Commencez par explorer notre catalogue de cours</p>
                    <div class="mt-6">
                        <a 
                            href="allCourses.php" 
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
                        >
                            Parcourir les cours →
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($courses as $course): ?>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2 truncate"><?= htmlspecialchars($course['titre']) ?></h3>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">
                                    Inscrit le <?= date('d/m/Y', strtotime($course['date_inscription'])) ?>
                                </span>
                                <a 
                                    href="course_details.php?id=<?= $course['id'] ?>" 
                                    class="text-indigo-600 hover:underline"
                                >
                                    Continuer →
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>