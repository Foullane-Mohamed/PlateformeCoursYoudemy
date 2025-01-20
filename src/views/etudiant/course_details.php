<?php
session_start();
require_once __DIR__ . '/../../models/Course.php';
require_once __DIR__ . '/../../models/Etudiant.php';

// Vérification authentification
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'etudiant') {
    header('Location: ../auth/login.php');
    exit();
}

// Validation ID cours
$courseId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$courseId) {
    header('Location: allCourses.php');
    exit();
}

// Récupération données
$courseModel = new Course();
$course = $courseModel->getCourseWithDetails($courseId);

// Création de l'objet Etudiant avec les données de l'utilisateur
$user = $_SESSION['user'];
$etudiant = new Etudiant($user['nom'], $user['email'], $user['password'], $user['role'], $user['status']);

$isEnrolled = $courseModel->isEnrolled($_SESSION['user']['id'], $courseId);

// Gestion inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$isEnrolled) {
    $result = $etudiant->inscriptionCours($_SESSION['user']['id'], $courseId);
    
    if ($result['success']) {
        $_SESSION['success'] = $result['message'];
        header('Refresh:0'); // Recharger la page
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
    <title><?= htmlspecialchars($course['titre']) ?> - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="dashboard.php" class="text-2xl font-bold text-indigo-600">Youdemy</a>
            <div class="flex items-center gap-4">
                <a href="allCourses.php" class="hover:text-indigo-600">Catalogue</a>
                <a href="../auth/logout.php" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">Déconnexion</a>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="max-w-4xl mx-auto px-4 py-8">
        <!-- Messages flash -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                <?= $_SESSION['success'] ?>
                <?php unset($_SESSION['success']) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                <?= $_SESSION['error'] ?>
                <?php unset($_SESSION['error']) ?>
            </div>
        <?php endif; ?>

        <!-- Fiche cours -->
        <div class="bg-white rounded-xl shadow-md p-8">
            <h1 class="text-3xl font-bold mb-6"><?= htmlspecialchars($course['titre']) ?></h1>
            
            <div class="grid md:grid-cols-2 gap-8 mb-8">
                <div>
                    <h2 class="text-lg font-semibold mb-2">Description</h2>
                    <p class="text-gray-600"><?= htmlspecialchars($course['description']) ?></p>
                </div>
                
                <div>
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold mb-2">Enseignant</h2>
                        <p><?= htmlspecialchars($course['enseignant_nom']) ?></p>
                    </div>
                    
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold mb-2">Statistiques</h2>
                        <p><?= $course['nombre_etudiants'] ?> étudiants inscrits</p>
                    </div>
                </div>
            </div>

            <!-- Contenu pédagogique -->
            <div class="mb-8">
                <?php if ($course['type_contenu'] === 'video'): ?>
                    <div class="aspect-video bg-gray-200 rounded-xl overflow-hidden">
                        <iframe 
                            src="https://www.youtube.com/embed/<?= $course['contenu'] ?>"
                            class="w-full h-full"
                            allowfullscreen>
                        </iframe>
                    </div>
                <?php else: ?>
                    <div class="p-6 bg-gray-50 rounded-lg">
                        <a 
                            href="<?= $course['contenu'] ?>" 
                            class="text-indigo-600 hover:underline flex items-center gap-2"
                            target="_blank"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Télécharger les ressources du cours
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Bouton d'inscription -->
            <?php if ($isEnrolled): ?>
                <div class="p-4 bg-green-100 text-green-700 rounded-lg text-center">
                    Vous êtes déjà inscrit à ce cours
                </div>
            <?php else: ?>
              <form method="POST">
    <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
    <button 
        type="submit"
        class="w-full bg-indigo-600 text-white py-4 rounded-xl hover:bg-indigo-700 transition-colors"
    >
        S'inscrire maintenant
    </button>
</form>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>