<?php
session_start();
require_once __DIR__ . '/../../models/Course.php';
require_once __DIR__ . '/../../models/Etudiant.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'etudiant') {
    header('Location: ../auth/login.php');
    exit();
}

$courseId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$courseId) {
    header('Location: allCourses.php');
    exit();
}

$courseModel = new Course();
$course = $courseModel->getCourseWithDetails($courseId);

$user = $_SESSION['user'];
$etudiant = new Etudiant($user['nom'], $user['email'], $user['password'], $user['role'], $user['status']);

$isEnrolled = $courseModel->isEnrolled($_SESSION['user']['id'], $courseId);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$isEnrolled) {
    $result = $etudiant->inscriptionCours($_SESSION['user']['id'], $courseId);
    
    if ($result['success']) {
        $_SESSION['success'] = $result['message'];
        header('Refresh:0');
        exit();
    } else {
        $_SESSION['error'] = $result['message'];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($course['titre']) ?> - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white/90 backdrop-blur-sm shadow-md sticky top-0 z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <a href="dashboard.php" class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                    Youdemy
                </a>
                <div class="flex items-center space-x-8">
                    <a href="allCourses.php" class="text-gray-700 hover:text-indigo-600 transition-colors font-medium">
                        Catalogue
                    </a>
                    <a href="../auth/logout.php" class="px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-full hover:shadow-lg transition-all duration-300 font-medium">
                        Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="max-w-4xl mx-auto px-6 py-12">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <?= $_SESSION['success'] ?>
                <?php unset($_SESSION['success']) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <?= $_SESSION['error'] ?>
                <?php unset($_SESSION['error']) ?>
            </div>
        <?php endif; ?>

        <!-- Fiche cours -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-6"><?= htmlspecialchars($course['titre']) ?></h1>
                
                <div class="grid md:grid-cols-2 gap-8 mb-8">
                    <div class="space-y-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 mb-2">Description</h2>
                            <p class="text-gray-600"><?= htmlspecialchars($course['description']) ?></p>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Informations du cours</h2>
                            <div class="space-y-4">
                                <div>
                                    <span class="text-sm text-gray-500">Enseignant</span>
                                    <p class="text-gray-800 font-medium"><?= htmlspecialchars($course['enseignant_nom']) ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Étudiants inscrits</span>
                                    <p class="text-gray-800 font-medium"><?= $course['nombre_etudiants'] ?> étudiants</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

              <!-- Contenu pédagogique -->
<div class="mb-8">
    <?php if ($course['type_contenu'] === 'video'): ?>
        <div class="aspect-video bg-gray-100 rounded-xl overflow-hidden">
            <iframe 
                src="https://www.youtube.com/embed/<?= $course['contenu'] ?>"
                class="w-full h-full"
                allowfullscreen>
            </iframe>
        </div>
    <?php else: ?>
        <div class="p-6 bg-gray-50 rounded-xl border border-gray-200">
            <a 
                href="<?= $course['contenu'] ?>" 
                class="inline-flex items-center text-indigo-600 hover:text-purple-600 font-medium group"
                target="_blank"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Télécharger les ressources du cours
                <span class="ml-2 group-hover:translate-x-1 transition-transform duration-300">→</span>
            </a>
        </div>
    <?php endif; ?>
</div>

<!-- Bouton d'inscription -->
<div class="border-t border-gray-100 pt-8">
    <?php if ($isEnrolled): ?>
        <div class="p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-center">
            <div class="flex items-center justify-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M5 13l4 4L19 7"/>
                </svg>
                <span class="font-medium">Vous êtes déjà inscrit à ce cours</span>
            </div>
        </div>
    <?php else: ?>
        <form method="POST" class="text-center">
            <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
            <button 
                type="submit"
                class="w-full py-4 px-6 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:shadow-lg transition-all duration-300 font-medium"
            >
                S'inscrire maintenant
            </button>
            <p class="mt-3 text-sm text-gray-500">
                Rejoignez <?= $course['nombre_etudiants'] ?> autres étudiants dans ce cours
            </p>
        </form>
    <?php endif; ?>
</div>

            </div>
        </div>
    </main>
</body>
</html>