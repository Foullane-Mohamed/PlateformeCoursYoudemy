<?php
session_start();
require_once __DIR__ . '/../../models/Course.php';
require_once __DIR__ . '/../../models/Enseignant.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'enseignant') {
    header('Location: ../auth/login.php');
    exit();
}

$enseignant = new Enseignant(null, null, null, null, null);
$enseignantId = $_SESSION['user']['id'];

// Récupérer les statistiques des cours de l'enseignant
$totalStudents = $enseignant->getTotalStudents($enseignantId);
$activeCourses = $enseignant->getActiveCourses($enseignantId);
$draftCourses = $enseignant->getDraftCourses($enseignantId);
$coursePerformance = $enseignant->getCoursePerformance($enseignantId);
?>

<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Teacher Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #f8fafc; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 5px; }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
        }
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
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg bg-indigo-50 text-indigo-600">
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
                        <a href="ajouterCours.php" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
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
                    <h1 class="text-2xl font-bold text-gray-900">Teacher Dashboard</h1>
                    <p class="mt-2 text-sm text-gray-600">Monitor your courses and student engagement.</p>
                </div>

                <!-- Stats Grid -->
                <div class="stats-grid mb-8">
                    <!-- Total Students -->
                    <div class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-lg transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center justify-center w-12 h-12 bg-indigo-50 text-indigo-600 rounded-lg">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <span class="flex items-center text-green-600 text-sm font-medium">
                                <i class="fas fa-arrow-up mr-1 text-xs"></i>
                                15%
                            </span>
                        </div>
                        <h3 class="text-gray-900 font-semibold">Total Students</h3>
                        <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo $totalStudents; ?></p>
                        <p class="text-sm text-gray-500 mt-2">+56 this month</p>
                    </div>

                    <!-- Active Courses -->
                    <div class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-lg transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center justify-center w-12 h-12 bg-blue-50 text-blue-600 rounded-lg">
                                <i class="fas fa-book text-xl"></i>
                            </div>
                            <span class="flex items-center text-green-600 text-sm font-medium">
                                <i class="fas fa-arrow-up mr-1 text-xs"></i>
                                8%
                            </span>
                        </div>
                        <h3 class="text-gray-900 font-semibold">Active Courses</h3>
                        <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo $activeCourses; ?></p>
                        <p class="text-sm text-gray-500 mt-2"><?php echo $draftCourses; ?> in draft</p>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Course Performance -->
                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-bold text-gray-900">Course Performance</h2>
                            <select class="text-sm text-gray-500 border border-gray-300 rounded-lg px-3 py-1.5">
                                <option>Last 7 days</option>
                                <option>Last 30 days</option>
                                <option>Last 3 months</option>
                            </select>
                        </div>
                        <div class="space-y-4">
                            <!-- Course Item -->
                            <?php foreach ($coursePerformance as $course): ?>
                                <div class="p-4 hover:bg-gray-50 rounded-lg">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="font-medium text-gray-900"><?php echo $course['titre']; ?></h3>
                                            <p class="text-sm text-gray-500 mt-1"><?php echo $course['nombre_etudiants']; ?> students</p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Course Management -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 mt-8">
                    <h2 class="text-lg font-bold text-gray-900 mb-6">Manage Courses</h2>
                    <div class="space-y-4">
                        <!-- Add Course Form -->
                        <form action="ajouterCours.php" method="POST" class="space-y-4">
                            <div>
                                <label for="titre" class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" id="titre" name="titre" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                            </div>
                            <div>
                                <label for="contenu" class="block text-sm font-medium text-gray-700">Content (Video or Document)</label>
                                <input type="file" id="contenu" name="contenu" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                                <input type="text" id="tags" name="tags" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="categorie" class="block text-sm font-medium text-gray-700">Category</label>
                                <select id="categorie" name="categorie" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <?php foreach ($enseignant->getAllCategories() as $category): ?>
                                        <option value="<?php echo $category['id_categorie']; ?>"><?php echo $category['nom']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Add Course
                                </button>
                            </div>
                        </form>

                        <!-- Edit Course Form -->
                        <form action="modifierCours.php" method="POST" class="space-y-4">
                            <input type="hidden" name="idCours" value="">
                            <div>
                                <label for="edit_titre" class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" id="edit_titre" name="edit_titre" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="edit_description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="edit_description" name="edit_description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                            </div>
                            <div>
                                <label for="edit_contenu" class="block text-sm font-medium text-gray-700">Content (Video or Document)</label>
                                <input type="file" id="edit_contenu" name="edit_contenu" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="edit_tags" class="block text-sm font-medium text-gray-700">Tags</label>
                                <input type="text" id="edit_tags" name="edit_tags" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="edit_categorie" class="block text-sm font-medium text-gray-700">Category</label>
                                <select id="edit_categorie" name="edit_categorie" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <?php foreach ($enseignant->getAllCategories() as $category): ?>
                                        <option value="<?php echo $category['id_categorie']; ?>"><?php echo $category['nom']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Update Course
                                </button>
                            </div>
                        </form>

                        <!-- Delete Course Form -->
                        <form action="supprimerCours.php" method="POST" class="space-y-4">
                            <input type="hidden" name="idCours" value="">
                            <div>
                                <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Delete Course
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
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
