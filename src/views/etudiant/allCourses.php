<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des Cours - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        .custom-gradient {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        }
        .course-card {
            transition: all 0.3s ease;
            transform-origin: center;
        }
        .course-card:hover {
            transform: scale(1.03);
            box-shadow: 0 15px 30px -10px rgba(41, 41, 119, 0.2);
        }
        .badge-gradient {
            background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <header class="sticky top-0 z-50 bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <div class="custom-gradient text-white p-2.5 rounded-lg mr-3">
                            <i class="fas fa-graduation-cap text-xl"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-900">Youdemy</span>
                    </div>

                    <!-- Navigation -->
                    <nav class="hidden md:flex items-center space-x-6">
                        <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors">Accueil</a>
                        <a href="#" class="text-indigo-600 font-semibold border-b-2 border-indigo-600">Cours</a>
                        <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors">Catégories</a>
                    </nav>

                    <!-- Actions -->
                    <div class="flex items-center space-x-4">
                        <div class="relative hidden md:block">
                            <input type="text" 
                                   placeholder="Rechercher des cours..." 
                                   class="pl-10 pr-4 py-2 w-64 border border-gray-300 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <button class="bg-indigo-600 text-white px-4 py-2 rounded-full text-sm hover:bg-indigo-700 transition-colors">
                            Connexion
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
            <!-- Page Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Catalogue des Cours</h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Explorez une variété de cours de haute qualité et développez vos compétences dans différents domaines.</p>
            </div>

            <!-- Filters -->
            <div class="mb-10 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="flex space-x-4 w-full md:w-auto">
                    <select class="flex-grow md:w-auto bg-white border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option>Toutes les Catégories</option>
                        <option>Développement Web</option>
                        <option>Data Science</option>
                        <option>Design</option>
                    </select>
                    <select class="flex-grow md:w-auto bg-white border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option>Tous Niveaux</option>
                        <option>Débutant</option>
                        <option>Intermédiaire</option>
                        <option>Avancé</option>
                    </select>
                </div>
                <select class="w-full md:w-auto bg-white border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option>Trier par</option>
                    <option>Les plus populaires</option>
                    <option>Mieux notés</option>
                    <option>Nouveautés</option>
                    <option>Prix croissant</option>
                    <option>Prix décroissant</option>
                </select>
            </div>

            <!-- Courses Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Course Card Template -->
                <div class="course-card bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name=Cours+Web" alt="Course" class="w-full h-56 object-cover">
                        <div class="absolute top-4 right-4">
                            <span class="badge-gradient text-white px-3 py-1 rounded-full text-xs font-semibold">
                                Développement
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Développement Web Complet</h3>
                        <p class="text-gray-600 mb-4 h-12 overflow-hidden">
                            Maîtrisez le développement web moderne de A à Z avec HTML, CSS, JavaScript et React
                        </p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <img src="https://ui-avatars.com/api/?name=John+Doe" class="w-10 h-10 rounded-full mr-3" alt="Instructeur">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">John Doe</p>
                                    <p class="text-xs text-gray-500">Expert Web</p>
                                </div>
                            </div>
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-medium">
                                Débutant
                            </span>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <span class="text-xl font-bold text-indigo-600">49,99 €</span>
                            <button class="custom-gradient text-white px-5 py-2 rounded-full text-sm font-semibold hover:opacity-90 transition-opacity">
                                Détails du Cours
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Repeat similar structure for other course cards -->
                <div class="course-card bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name=Data+Science" alt="Course" class="w-full h-56 object-cover">
                        <div class="absolute top-4 right-4">
                            <span class="badge-gradient text-white px-3 py-1 rounded-full text-xs font-semibold">
                                Data Science
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Python pour Data Science</h3>
                        <p class="text-gray-600 mb-4 h-12 overflow-hidden">
                            Apprenez l'analyse de données, le machine learning et la visualisation avec Python
                        </p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <img src="https://ui-avatars.com/api/?name=Sarah+Smith" class="w-10 h-10 rounded-full mr-3" alt="Instructeur">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Sarah Smith</p>
                                    <p class="text-xs text-gray-500">Data Scientist</p>
                                </div>
                            </div>
                            <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs font-medium">
                                Intermédiaire
                            </span>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <span class="text-xl font-bold text-indigo-600">59,99 €</span>
                            <button class="custom-gradient text-white px-5 py-2 rounded-full text-sm font-semibold hover:opacity-90 transition-opacity">
                                Détails du Cours
                            </button>
                        </div>
                    </div>
                </div>

                <div class="course-card bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name=React" alt="Course" class="w-full h-56 object-cover">
                        <div class="absolute top-4 right-4">
                            <span class="badge-gradient text-white px-3 py-1 rounded-full text-xs font-semibold">
                                Frontend
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Développement React Moderne</h3>
                        <p class="text-gray-600 mb-4 h-12 overflow-hidden">
                            Créez des applications web dynamiques et performantes avec React et ses écosystèmes
                        </p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <img src="https://ui-avatars.com/api/?name=Mike+Johnson" class="w-10 h-10 rounded-full mr-3" alt="Instructeur">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Mike Johnson</p>
                                    <p class="text-xs text-gray-500">Expert Frontend</p>
                                </div>
                            </div>
                            <span class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full text-xs font-medium">
                                Avancé
                            </span>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <span class="text-xl font-bold text-indigo-600">54,99 €</span>
                            <button class="custom-gradient text-white px-5 py-2 rounded-full text-sm font-semibold hover:opacity-90 transition-opacity">
                                Détails du Cours
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                <nav aria-label="Page navigation" class="inline-flex space-x-2">
                    <button class="px-4 py-2 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                        Précédent
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                        1
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg border border-indigo-600">
                        2
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                        3
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                        Suivant
                    </button>
                </nav>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-lg font-bold mb-4">Youdemy</h3>
                        <p class="text-gray-600">Plateforme d'apprentissage en ligne pour développer vos compétences.</p>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-4">Liens Rapides</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-indigo-600">Cours</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-indigo-600">Catégories</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-indigo-600">Instructeurs</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-4">Support</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-indigo-600">Contact</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-indigo-600">FAQ</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-indigo-600">Aide</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-4">Suivez-nous</h4>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-600 hover:text-indigo-600"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="text-gray-600 hover:text-indigo-600"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-gray-600 hover:text-indigo-600"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-gray-600 hover:text-indigo-600"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Simple mobile menu toggle (for demonstration)
        document.addEventListener('DOMContentLoaded', () => {
            const menuToggle = document.querySelector('.mobile-menu-toggle');
            const mobileMenu = document.querySelector('.mobile-menu');
            
            if (menuToggle && mobileMenu) {
                menuToggle.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>