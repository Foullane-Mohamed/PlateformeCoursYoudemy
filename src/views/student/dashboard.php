<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Tableau de Bord Étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
        }
        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .shadow-soft {
            box-shadow: 0 10px 25px -10px rgba(108, 108, 193, 0.2);
        }
        .progress-bar {
            background: linear-gradient(to right, #4338ca, #6366f1);
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="hidden lg:flex lg:flex-col lg:w-72 bg-white shadow-xl">
            <!-- Logo -->
            <div class="px-6 py-5 border-b border-gray-200 gradient-bg">
                <div class="flex items-center">
                    <div class="bg-white bg-opacity-20 p-3 rounded-lg mr-3">
                        <i class="fas fa-graduation-cap text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-white">Youdemy</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-grow py-6 px-4 space-y-2">
                <!-- Main Navigation -->
                <div>
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">
                        Mon Parcours
                    </h3>
                    <div class="space-y-1">
                        <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg text-indigo-600 bg-indigo-50 hover:bg-indigo-100 transition-all">
                            <i class="fas fa-home w-5 h-5 mr-3 text-indigo-500 group-hover:text-indigo-600"></i>
                            Tableau de Bord
                        </a>
                        <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition-all">
                            <i class="fas fa-book w-5 h-5 mr-3 text-gray-400 group-hover:text-indigo-500"></i>
                            Mes Cours
                        </a>
                        <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition-all">
                            <i class="fas fa-certificate w-5 h-5 mr-3 text-gray-400 group-hover:text-indigo-500"></i>
                            Certificats
                        </a>
                    </div>
                </div>

                <!-- Découverte -->
                <div class="mt-6">
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">
                        Découverte
                    </h3>
                    <div class="space-y-1">
                        <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition-all">
                            <i class="fas fa-search w-5 h-5 mr-3 text-gray-400 group-hover:text-indigo-500"></i>
                            Catalogue des Cours
                        </a>
                        <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition-all">
                            <i class="fas fa-tags w-5 h-5 mr-3 text-gray-400 group-hover:text-indigo-500"></i>
                            Catégories
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Profile Section -->
            <div class="border-t border-gray-200 p-4">
                <div class="flex items-center bg-gray-50 p-3 rounded-lg hover:bg-gray-100 transition-all">
                    <img src="https://ui-avatars.com/api/?name=Jean+Dupont" alt="Étudiant" class="w-10 h-10 rounded-full mr-3 shadow-md">
                    <div class="flex-grow">
                        <p class="text-sm font-semibold text-gray-900">Jean Dupont</p>
                        <p class="text-xs text-gray-500">jean.dupont@example.com</p>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600 transition-all">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-grow bg-gray-100">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm sticky top-0 z-10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <!-- Search -->
                        <div class="flex-grow max-w-xl mr-6">
                            <div class="relative">
                                <input type="text" 
                                       placeholder="Rechercher des cours..." 
                                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Notifications -->
                        <div class="flex items-center">
                            <button class="relative p-2 text-gray-500 hover:text-indigo-600 transition-all mr-4">
                                <i class="fas fa-bell text-lg"></i>
                                <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500"></span>
                            </button>

                            <button class="flex items-center bg-indigo-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-indigo-700 transition-all">
                                <i class="fas fa-plus mr-2"></i>
                                Nouveau Cours
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Welcome Section -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Bonjour, Jean Dupont</h1>
                    <p class="text-gray-600">Continuez votre apprentissage et atteignez vos objectifs.</p>
                </div>

                <!-- Progress Overview -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-5 rounded-xl shadow-soft hover:shadow-lg transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <div class="bg-green-100 text-green-600 p-3 rounded-lg">
                                <i class="fas fa-book-open text-xl"></i>
                            </div>
                            <span class="text-green-600 font-medium text-sm flex items-center">
                                <i class="fas fa-arrow-up mr-1"></i>12%
                            </span>
                        </div>
                        <h3 class="text-gray-500 text-sm mb-1">Cours Terminés</h3>
                        <p class="text-2xl font-bold text-gray-900">8</p>
                    </div>
                    <div class="bg-white p-5 rounded-xl shadow-soft hover:shadow-lg transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <div class="bg-blue-100 text-blue-600 p-3 rounded-lg">
                                <i class="fas fa-clock text-xl"></i>
                            </div>
                            <span class="text-green-600 font-medium text-sm flex items-center">
                                <i class="fas fa-arrow-up mr-1"></i>5%
                            </span>
                        </div>
                        <h3 class="text-gray-500 text-sm mb-1">Temps d'Étude</h3>
                        <p class="text-2xl font-bold text-gray-900">42h</p>
                    </div>
                    <div class="bg-white p-5 rounded-xl shadow-soft hover:shadow-lg transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <div class="bg-purple-100 text-purple-600 p-3 rounded-lg">
                                <i class="fas fa-certificate text-xl"></i>
                            </div>
                            <span class="text-green-600 font-medium text-sm flex items-center">
                                <i class="fas fa-arrow-up mr-1"></i>3
                            </span>
                        </div>
                        <h3 class="text-gray-500 text-sm mb-1">Certificats</h3>
                        <p class="text-2xl font-bold text-gray-900">5</p>
                    </div>
                    <div class="bg-white p-5 rounded-xl shadow-soft hover:shadow-lg transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <div class="bg-red-100 text-red-600 p-3 rounded-lg">
                                <i class="fas fa-chart-line text-xl"></i>
                            </div>
                            <span class="text-green-600 font-medium text-sm flex items-center">
                                <i class="fas fa-arrow-up mr-1"></i>8%
                            </span>
                        </div>
                        <h3 class="text-gray-500 text-sm mb-1">Progression</h3>
                        <p class="text-2xl font-bold text-gray-900">65%</p>
                    </div>
                </div>

                <!-- Cours en Cours -->
                <section class="mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Mes Cours en Cours</h2>
                        <a href="#" class="text-indigo-600 hover:text-indigo-700 font-medium transition-all">
                            Voir tous les cours
                        </a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Cours Card 1 -->
                        <div class="bg-white rounded-xl overflow-hidden shadow-soft hover:shadow-lg transition-all group">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name=Web+Dev" alt="Cours" class="w-full h-48 object-cover">
                                <div class="absolute top-4 right-4 bg-white bg-opacity-80 px-3 py-1 rounded-full text-sm font-medium text-gray-800">
                                    65% Terminé
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Développement Web Complet</h3>
                                <p class="text-gray-500 text-sm mb-4">Maîtrisez le développement web de A à Z</p>
                                <div class="mb-4">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="progress-bar h-2.5 rounded-full" style="width: 65%"></div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <img src="https://ui-avatars.com/api/?name=John+Doe" class="w-8 h-8 rounded-full mr-2" alt="Instructeur">
                                        <span class="text-sm text-gray-600">John Doe</span>
                                    </div>
                                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition-all">
                                        Continuer
                                    </button>
                                </div>
                            </div>
                        </div>

                      
                        <!-- Cours Card 3 -->
                        <div class="bg-white rounded-xl overflow-hidden shadow-soft hover:shadow-lg transition-all group">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name=Mobile+Dev" alt="Cours" class="w-full h-48 object-cover">
                                <div class="absolute top-4 right-4 bg-white bg-opacity-80 px-3 py-1 rounded-full text-sm font-medium text-gray-800">
                                    25% Terminé
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Développement Mobile</h3>
                                <p class="text-gray-500 text-sm mb-4">Création d'applications mobiles modernes</p>
                                <div class="mb-4">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="progress-bar h-2.5 rounded-full" style="width: 25%"></div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <img src="https://ui-avatars.com/api/?name=Mike+Johnson" class="w-8 h-8 rounded-full mr-2" alt="Instructeur">
                                        <span class="text-sm text-gray-600">Mike Johnson</span>
                                    </div>
                                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition-all">
                                        Continuer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Recommandations de Cours -->
                <section>
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Recommandations de Cours</h2>
                        <a href="#" class="text-indigo-600 hover:text-indigo-700 font-medium transition-all">
                            Explorer plus de cours
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Cours Recommandé 1 -->
                        <div class="bg-white rounded-xl overflow-hidden shadow-soft hover:shadow-lg transition-all group">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name=JavaScript" alt="Cours JavaScript" class="w-full h-48 object-cover">
                                <div class="absolute top-4 right-4 bg-white bg-opacity-80 px-3 py-1 rounded-full text-sm font-medium text-gray-800">
                                    Nouveau
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">JavaScript Avancé</h3>
                                <p class="text-gray-500 text-sm mb-4">Maîtrisez les techniques modernes de développement</p>
                                <div class="flex items-center justify-between">
                                    <div class="text-lg font-bold text-indigo-600">49,99 €</div>
                                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition-all">
                                        Découvrir
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cours Recommandé 2 -->
                        <div class="bg-white rounded-xl overflow-hidden shadow-soft hover:shadow-lg transition-all group">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name=Python" alt="Cours Python" class="w-full h-48 object-cover">
                                <div class="absolute top-4 right-4 bg-white bg-opacity-80 px-3 py-1 rounded-full text-sm font-medium text-gray-800">
                                    Top Vendu
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Python pour Data Science</h3>
                                <p class="text-gray-500 text-sm mb-4">Analyse et visualisation de données</p>
                                <div class="flex items-center justify-between">
                                    <div class="text-lg font-bold text-indigo-600">59,99 €</div>
                                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition-all">
                                        Découvrir
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cours Recommandé 3 -->
                        <div class="bg-white rounded-xl overflow-hidden shadow-soft hover:shadow-lg transition-all group">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name=React" alt="Cours React" class="w-full h-48 object-cover">
                                <div class="absolute top-4 right-4 bg-white bg-opacity-80 px-3 py-1 rounded-full text-sm font-medium text-gray-800">
                                    Populaire
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Développement React</h3>
                                <p class="text-gray-500 text-sm mb-4">Création d'applications web modernes</p>
                                <div class="flex items-center justify-between">
                                    <div class="text-lg font-bold text-indigo-600">54,99 €</div>
                                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition-all">
                                        Découvrir
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <script>
        // Mobile menu toggle (simplified for this example)
        document.addEventListener('DOMContentLoaded', () => {
            const menuButton = document.querySelector('button[aria-label="Toggle menu"]');
            const sidebar = document.querySelector('aside');
            
            if (menuButton && sidebar) {
                menuButton.addEventListener('click', () => {
                    sidebar.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
                  