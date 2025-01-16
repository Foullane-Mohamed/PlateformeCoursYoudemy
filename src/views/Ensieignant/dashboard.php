<?php

require_once __DIR__ . '/../../config/connection.php';
require_once __DIR__ . '/../../models/Admin.php';
require_once __DIR__ . '/../../models/Course.php';
require_once __DIR__ . '/../../models/Category.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Dashboard Enseignant</title>
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
                    <a href="#" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group">
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
                <h1 class="text-xl font-semibold">Tableau de bord</h1>
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

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fa-solid fa-book text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500">Total Cours</p>
                        <h3 class="text-2xl font-bold">12</h3>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fa-solid fa-users text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500">Étudiants</p>
                        <h3 class="text-2xl font-bold">248</h3>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <i class="fa-solid fa-star text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500">Note moyenne</p>
                        <h3 class="text-2xl font-bold">4.8</h3>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fa-solid fa-certificate text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500">Certifications</p>
                        <h3 class="text-2xl font-bold">156</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Courses and Students -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Courses -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold mb-4">Cours récents</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <img src="/api/placeholder/48/48" alt="Course" class="w-12 h-12 rounded"/>
                            <div class="ml-4">
                                <h3 class="font-medium">Introduction au PHP</h3>
                                <p class="text-sm text-gray-500">32 étudiants inscrits</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 text-sm text-green-600 bg-green-100 rounded-full">Actif</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <img src="/api/placeholder/48/48" alt="Course" class="w-12 h-12 rounded"/>
                            <div class="ml-4">
                                <h3 class="font-medium">HTML & CSS Avancé</h3>
                                <p class="text-sm text-gray-500">28 étudiants inscrits</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 text-sm text-green-600 bg-green-100 rounded-full">Actif</span>
                    </div>
                </div>
            </div>

            <!-- Recent Students -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold mb-4">Étudiants récents</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="/api/placeholder/40/40" alt="Student" class="w-10 h-10 rounded-full"/>
                            <div class="ml-4">
                                <h3 class="font-medium">Marie Dubois</h3>
                                <p class="text-sm text-gray-500">Inscrit à: Introduction au PHP</p>
                            </div>
                        </div>
                        <span class="text-sm text-gray-500">Il y a 2h</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="/api/placeholder/40/40" alt="Student" class="w-10 h-10 rounded-full"/>
                            <div class="ml-4">
                                <h3 class="font-medium">Pierre Martin</h3>
                                <p class="text-sm text-gray-500">Inscrit à: HTML & CSS Avancé</p>
                            </div>
                        </div>
                        <span class="text-sm text-gray-500">Il y a 4h</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>