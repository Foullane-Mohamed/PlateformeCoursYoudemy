<?php
session_start();
require_once __DIR__ . '/../../models/User.php';

// Vérification authentification
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'etudiant') {
    header('Location: ../auth/login.php');
    exit();
}

// Récupération données
$user = User::findById($_SESSION['user']['id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil - Youdemy</title>
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
        <h1 class="text-3xl font-bold mb-8">Profil</h1>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-bold mb-4">Informations personnelles</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nom</label>
                    <p class="mt-1 text-gray-900"><?= htmlspecialchars($user['nom']) ?></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <p class="mt-1 text-gray-900"><?= htmlspecialchars($user['email']) ?></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Rôle</label>
                    <p class="mt-1 text-gray-900"><?= htmlspecialchars($user['role']) ?></p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>