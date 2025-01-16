<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Ajouter un Cours</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <aside class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-800">
            <div class="mb-8 px-4">
                <h2 class="text-2xl font-bold text-white">Youdemy</h2>
            </div>
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="#" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group">
                        <i class="fa-solid fa-gauge-high w-5 h-5"></i>
                        <span class="ml-3">Tableau de bord</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group">
                        <i class="fa-solid fa-book w-5 h-5"></i>
                        <span class="ml-3">Mes cours</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-white bg-gray-700 rounded-lg group">
                        <i class="fa-solid fa-plus w-5 h-5"></i>
                        <span class="ml-3">Ajouter un cours</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group">
                        <i class="fa-solid fa-chart-line w-5 h-5"></i>
                        <span class="ml-3">Statistiques</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group">
                        <i class="fa-solid fa-users w-5 h-5"></i>
                        <span class="ml-3">Étudiants inscrits</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="p-4 sm:ml-64">
        <!-- Top Navigation -->
        <nav class="bg-white p-4 rounded-lg shadow-sm mb-6 flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-xl font-semibold">Ajouter un nouveau cours</h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button class="flex items-center space-x-2 text-gray-600 hover:text-gray-800">
                        <img src="/api/placeholder/40/40" alt="Profile" class="w-8 h-8 rounded-full"/>
                        <span>John Doe</span>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Add Course Form -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <form action="process-course.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                <!-- Basic Information -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold border-b pb-2">Informations de base</h2>
                    
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Titre du cours*</label>
                        <input type="text" id="title" name="title" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description*</label>
                        <textarea id="description" name="description" rows="4" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Catégorie*</label>
                            <select id="category" name="category" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionner une catégorie</option>
                                <option value="web">Développement Web</option>
                                <option value="mobile">Développement Mobile</option>
                                <option value="data">Science des Données</option>
                                <option value="design">Design</option>
                            </select>
                        </div>

                        <div>
                            <label for="level" class="block text-sm font-medium text-gray-700 mb-1">Niveau*</label>
                            <select id="level" name="level" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionner un niveau</option>
                                <option value="beginner">Débutant</option>
                                <option value="intermediate">Intermédiaire</option>
                                <option value="advanced">Avancé</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold border-b pb-2">Contenu du cours</h2>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type de contenu*</label>
                        <div class="flex space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="content_type" value="video" class="form-radio" checked>
                                <span class="ml-2">Vidéo</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="content_type" value="document" class="form-radio">
                                <span class="ml-2">Document</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Fichier du cours*</label>
                        <input type="file" id="content" name="content" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="mt-1 text-sm text-gray-500">Formats acceptés: .mp4, .pdf, .docx (Max: 500MB)</p>
                    </div>

                    <div>
                        <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-1">Image de couverture*</label>
                        <input type="file" id="thumbnail" name="thumbnail" accept="image/*" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="mt-1 text-sm text-gray-500">Format recommandé: 16:9, minimum 1280x720px (Max: 2MB)</p>
                    </div>
                </div>

                <!-- Tags Section -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold border-b pb-2">Tags</h2>
                    
                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags (séparés par des virgules)</label>
                        <input type="text" id="tags" name="tags" placeholder="php, web, programmation"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="mt-1 text-sm text-gray-500">Ajoutez jusqu'à 5 tags pour améliorer la visibilité de votre cours</p>
                    </div>
                </div>

                <!-- Pricing Section -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold border-b pb-2">Tarification</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Prix (€)*</label>
                            <input type="number" id="price" name="price" min="0" step="0.01" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Durée (heures)*</label>
                            <input type="number" id="duration" name="duration" min="0" step="0.5" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4 pt-4">
                    <button type="button" class="px-4 py-2 text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none">
                        Publier le cours
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>