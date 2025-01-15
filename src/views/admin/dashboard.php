<?php
session_start();

require_once __DIR__ . '/../../config/connection.php';
require_once __DIR__ . '/../../models/Admin.php';
require_once __DIR__ . '/../../models/Course.php';
require_once __DIR__ . '/../../models/Category.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit();
}

try {
    $admin = new Admin(
        $_SESSION['user']['nom'],
        $_SESSION['user']['email'],
        '',
        'admin',
        'actif'
    );

    $allUsers = $admin->getAllUsers();
    $totalStudents = count(array_filter($allUsers, function($user) {
        return $user['role'] === 'etudiant';
    }));

    $totalTeachers = count(array_filter($allUsers, function($user) {
        return $user['role'] === 'enseignant';
    }));

    $activeTeachers = count(array_filter($allUsers, function($user) {
        return $user['role'] === 'enseignant' && $user['status'] === 'actif';
    }));

    $pendingTeachers = count(array_filter($allUsers, function($user) {
        return $user['role'] === 'enseignant' && $user['status'] === 'en_attente';
    }));

    $pendingValidations = array_filter($allUsers, function($user) {
        return $user['role'] === 'enseignant' && $user['status'] === 'en_attente';
    });

    $categories = $admin->getAllCategories();

} catch (Exception $e) {
    die("Erreur: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="h-full">
    <div class="min-h-full">
        <!-- Navigation -->
        <nav class="bg-white border-b border-gray-200 fixed w-full z-30 top-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo et liens de navigation -->
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <img class="h-10 w-auto" src="/path/to/your/logo.png" alt="Youdemy">
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="#" class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        <i class="fas fa-chart-line mr-2"></i>
                        Tableau de Bord
                    </a>
                    <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200">
                        <i class="fas fa-users mr-2"></i>
                        Utilisateurs
                    </a>
                    <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        Cours
                    </a>
                    <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200">
                        <i class="fas fa-folder mr-2"></i>
                        Catégories
                    </a>
                </div>
            </div>

            <!-- Section droite avec recherche, notifications et profil -->
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                <!-- Barre de recherche -->
                <div class="flex-1 flex justify-center px-2 lg:ml-6 lg:justify-end">
                    <div class="max-w-lg w-full lg:max-w-xs">
                        <label for="search" class="sr-only">Rechercher</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input id="search" name="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Rechercher..." type="search">
                        </div>
                    </div>
                </div>

                <!-- Bouton notifications -->
                <button class="bg-white p-2 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 relative">
                    <span class="sr-only">Notifications</span>
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute top-0 right-0 block h-2 w-2 rounded-full ring-2 ring-white bg-red-400"></span>
                </button>

                <!-- Menu profil -->
                <div class="ml-3 relative">
                    <div class="flex items-center">
                        <button type="button" class="bg-white flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 items-center" id="user-menu-button" aria-expanded="false" aria-haspopup="true" onclick="toggleProfileDropdown()">
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full object-cover border-2 border-gray-200" src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user']['nom']); ?>&background=random" alt="">
                            <span class="ml-2 text-gray-700 font-medium"><?php echo htmlspecialchars($_SESSION['user']['nom']); ?></span>
                            <i class="fas fa-chevron-down ml-2 text-gray-400"></i>
                        </button>
                    </div>
                    <!-- Menu déroulant du profil -->
                    <div id="profile-dropdown" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                            <i class="fas fa-user mr-2"></i>
                            Mon Profil
                        </a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                            <i class="fas fa-cog mr-2"></i>
                            Paramètres
                        </a>
                        <hr class="my-1">
                        <a href="#" class="block px-4 py-2 text-sm text-red-700 hover:bg-red-50" role="menuitem">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Déconnexion
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bouton menu mobile -->
            <div class="flex items-center sm:hidden">
                <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false" onclick="toggleMobileMenu()">
                    <span class="sr-only">Open main menu</span>
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu mobile -->
    <div class="sm:hidden hidden" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            <a href="#" class="bg-indigo-50 border-indigo-500 text-indigo-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                <i class="fas fa-chart-line mr-2"></i>
                Tableau de Bord
            </a>
            <a href="#" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                <i class="fas fa-users mr-2"></i>
                Utilisateurs
            </a>
            <a href="#" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                <i class="fas fa-graduation-cap mr-2"></i>
                Cours
            </a>
            <a href="#" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                <i class="fas fa-folder mr-2"></i>
                Catégories
            </a>
        </div>
        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user']['nom']); ?>&background=random" alt="">
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium text-gray-800"><?php echo htmlspecialchars($_SESSION['user']['nom']); ?></div>
                    <div class="text-sm font-medium text-gray-500"><?php echo htmlspecialchars($_SESSION['user']['email']); ?></div>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                    <i class="fas fa-user mr-2"></i>
                    Mon Profil
                </a>
                <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                    <i class="fas fa-cog mr-2"></i>
                    Paramètres
                </a>
                <a href="#" class="block px-4 py-2 text-base font-medium text-red-600 hover:text-red-800 hover:bg-red-50">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Déconnexion
                </a>
            </div>
        </div>
    </div>
</nav>
        <!-- En-tête -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">Tableau de Bord</h1>
            </div>
        </header>

        <!-- Contenu principal -->
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <!-- Cartes statistiques -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Étudiants -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="rounded-md bg-indigo-500 p-3">
                                    <i class="fas fa-users text-white"></i>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Étudiants</dt>
                                    <dd class="text-lg font-semibold text-gray-900"><?php echo $totalStudents; ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Voir tous</a>
                        </div>
                    </div>
                </div>

                <!-- Enseignants -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="rounded-md bg-green-500 p-3">
                                    <i class="fas fa-chalkboard-teacher text-white"></i>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Enseignants Actifs</dt>
                                    <dd class="text-lg font-semibold text-gray-900"><?php echo $activeTeachers; ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-green-600 hover:text-green-500">Voir tous</a>
                        </div>
                    </div>
                </div>

                <!-- Validations en attente -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="rounded-md bg-yellow-500 p-3">
                                    <i class="fas fa-clock text-white"></i>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">En Attente</dt>
                                    <dd class="text-lg font-semibold text-gray-900"><?php echo $pendingTeachers; ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-yellow-600 hover:text-yellow-500">Traiter</a>
                        </div>
                    </div>
                </div>

                <!-- Total Enseignants -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="rounded-md bg-purple-500 p-3">
                                    <i class="fas fa-user-tie text-white"></i>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Enseignants</dt>
                                    <dd class="text-lg font-semibold text-gray-900"><?php echo $totalTeachers; ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-purple-600 hover:text-purple-500">Voir tous</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section des validations en attente -->
            <div class="mt-8">
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                        <div class="flex items-center">
                            <i class="fas fa-user-clock text-yellow-500 text-xl mr-3"></i>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Validations En Attente</h3>
                        </div>
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <?php echo $pendingTeachers; ?> en attente
                        </span>
                    </div>
                    <div class="border-t border-gray-200">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enseignant</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php foreach ($pendingValidations as $teacher): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <img class="h-10 w-10 rounded-full object-cover" 
                                                     src="https://ui-avatars.com/api/?name=<?php echo urlencode($teacher['nom']); ?>&background=random" 
                                                     alt="<?php echo htmlspecialchars($teacher['nom']); ?>">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <?php echo htmlspecialchars($teacher['nom']); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"><?php echo htmlspecialchars($teacher['email']); ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                En Attente
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form method="POST" action="validate_teacher.php" class="inline-flex space-x-2">
                                                <input type="hidden" name="teacher_id" value="<?php echo $teacher['id']; ?>">
                                                <button type="submit" name="action" value="approve" 
                                                        class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                    <i class="fas fa-check mr-2"></i>
                                                    Approuver
                                                </button>
                                                <button type="submit" name="action" value="reject" 
                                                        class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    <i class="fas fa-times mr-2"></i>
                                                    Refuser
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section des catégories -->
            <div class="mt-8">
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                        <div class="flex items-center">
                            <i class="fas fa-folder text-blue-500 text-xl mr-3"></i>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Distribution des Catégories</h3>
                        </div>
                        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i>
                            Ajouter une catégorie
                        </button>
                    </div>
                    <div class="border-t border-gray-200">
                        <div class="p-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            <?php foreach ($categories as $category): ?>
                            <div class="bg-gray-50 rounded-lg p-4 hover:shadow-md transition-all">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas <?php echo $category['icon'] ?? 'fa-folder'; ?> text-blue-500"></i>
                                        </div>
                                        <h4 class="ml-3 text-lg font-medium text-gray-900">
                                            <?php echo htmlspecialchars($category['nom']); ?>
                                        </h4>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button class="text-gray-400 hover:text-blue-500">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-gray-400 hover:text-red-500">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <span><?php echo $category['cours_count'] ?? '0'; ?> cours</span>
                                    <span><?php echo $category['students_count'] ?? '0'; ?> étudiants</span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pied de page -->
            <footer class="mt-8 text-center text-sm text-gray-500">
                <p>&copy; 2025 Youdemy. Tous droits réservés.</p>
            </footer>
        </main>
    </div>

    <!-- Scripts -->
    <script>
        // Menu mobile toggle
      

        // Notifications
        function toggleNotifications() {
            const notifications = document.querySelector('#notifications-menu');
            notifications.classList.toggle('hidden');
        }

        // Profile dropdown
        function toggleProfileDropdown() {
            const dropdown = document.querySelector('#profile-dropdown');
            dropdown.classList.toggle('hidden');
        }
        function toggleProfileDropdown() {
    const dropdown = document.getElementById('profile-dropdown');
    dropdown.classList.toggle('hidden');
}

function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenu.classList.toggle('hidden');
}
    </script>
</body>
</html>