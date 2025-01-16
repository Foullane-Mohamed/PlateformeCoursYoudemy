<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Tags Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .tag-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
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
                        <i class="fas fa-graduation-cap text-white"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-900">Youdemy</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-8 overflow-y-auto">
                <!-- Main Navigation -->
                <div>
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Main</h3>
                    <div class="mt-4 space-y-1">
                        <a href="dashboard.php" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-chart-line w-5 h-5"></i>
                            <span class="ml-3">Dashboard</span>
                        </a>
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="fas fa-tags w-5 h-5"></i>
                            <span class="ml-3">Tags</span>
                        </a>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="lg:pl-72 flex flex-col flex-1">
            <!-- Top Navigation -->
            <header class="sticky top-0 z-10 bg-white border-b border-gray-200">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <!-- Search and Filters -->
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <input type="text" 
                                       placeholder="Search tags..." 
                                       class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                            </div>
                            
                        
                        </div>

                        <!-- Add New Tag Button -->
                        <button class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-plus mr-2"></i>
                            Add New Tag
                        </button>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6">
                <!-- Page Header -->
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-900">Tags Management</h1>
                  
                </div>

                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Total Tags -->
                    <div class="bg-white p-6 rounded-xl border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Tags</p>
                                <p class="text-2xl font-bold text-gray-900 mt-1">248</p>
                            </div>
                            <div class="p-3 bg-indigo-50 rounded-lg">
                                <i class="fas fa-tags text-indigo-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Most Used Tags -->
                    <div class="bg-white p-6 rounded-xl border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Most Used</p>
                                <p class="text-2xl font-bold text-gray-900 mt-1">Programming</p>
                            </div>
                            <div class="p-3 bg-green-50 rounded-lg">
                                <i class="fas fa-chart-line text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Unused Tags -->
                    <div class="bg-white p-6 rounded-xl border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Unused Tags</p>
                                <p class="text-2xl font-bold text-gray-900 mt-1">12</p>
                            </div>
                            <div class="p-3 bg-amber-50 rounded-lg">
                                <i class="fas fa-exclamation-circle text-amber-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

          

                <!-- Tags Grid -->
                <div class="tag-grid">
                    <!-- Tag Card -->
                    <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 text-sm font-medium">
                                Programming
                            </span>
                            <div class="flex items-center gap-2">
                                <button class="text-gray-400 hover:text-gray-500">
                                    <i class="fas fa-pencil"></i>
                                </button>
                                <button class="text-gray-400 hover:text-red-500">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <h3 class="font-semibold text-gray-900">JavaScript</h3>
                        <p class="text-sm text-gray-500 mt-1">Used in 156 courses</p>
                        <div class="mt-4">
                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <i class="fas fa-book mr-2"></i>
                                    156 Courses
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-users mr-2"></i>
                                    1.2k Students
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Tag Card -->
                    <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-full bg-purple-50 text-purple-600 text-sm font-medium">
                                Design
                            </span>
                            <div class="flex items-center gap-2">
                                <button class="text-gray-400 hover:text-gray-500">
                                    <i class="fas fa-pencil"></i>
                                </button>
                                <button class="text-gray-400 hover:text-red-500">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <h3 class="font-semibold text-gray-900">UI/UX Design</h3>
                        <p class="text-sm text-gray-500 mt-1">Used in 89 courses</p>
                        <div class="mt-4">
                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <i class="fas fa-book mr-2"></i>
                                    89 Courses
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-users mr-2"></i>
                                    876 Students
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Tag Card -->
                    <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-sm font-medium">
                                Business
                            </span>
                            <div class="flex items-center gap-2">
                                <button class="text-gray-400 hover:text-gray-500">
                                    <i class="fas fa-pencil"></i>
                                </button>
                                <button class="text-gray-400 hover:text-red-500">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <h3 class="font-semibold text-gray-900">Marketing Strategy</h3>
                        <p class="text-sm text-gray-500 mt-1">Used in 67 courses</p>
                        <div class="mt-4">
                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <i class="fas fa-book mr-2"></i>
                                    67 Courses
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-users mr-2"></i>
                                    543 Students
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Add more tag cards as needed -->
                </div>
            </main>
        </div>
    </div>

    <!-- Add Tag Modal (Hidden by default) -->
  <!-- Add Tag Modal (Hidden by default) -->
  <div id="addTagModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900">Add New Tag</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="px-6 py-4">
                <form id="tagForm" onsubmit="handleSubmit(event)">
                    <!-- Tag Name Input -->
                    <div class="mb-4">
                        <label for="tagName" class="block text-sm font-medium text-gray-700 mb-2">
                            Tag Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="tagName" 
                               name="tagName" 
                               required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="Enter tag name">
                    </div>

                
                

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                  placeholder="Enter tag description"></textarea>
                    </div>

                    <!-- Color Selection -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tag Color
                        </label>
                        <div class="flex flex-wrap gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="tagColor" value="indigo" class="hidden" checked>
                                <div class="w-8 h-8 rounded-full bg-indigo-500 ring-2 ring-offset-2 ring-indigo-500"></div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="tagColor" value="purple" class="hidden">
                                <div class="w-8 h-8 rounded-full bg-purple-500 ring-2 ring-offset-2 ring-transparent"></div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="tagColor" value="blue" class="hidden">
                                <div class="w-8 h-8 rounded-full bg-blue-500 ring-2 ring-offset-2 ring-transparent"></div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="tagColor" value="green" class="hidden">
                                <div class="w-8 h-8 rounded-full bg-green-500 ring-2 ring-offset-2 ring-transparent"></div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="tagColor" value="red" class="hidden">
                                <div class="w-8 h-8 rounded-full bg-red-500 ring-2 ring-offset-2 ring-transparent"></div>
                            </label>
                        </div>
                    </div>

                    <!-- Additional Settings -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Settings
                        </label>
                        <div class="space-y-3">
                            <label class="flex items-center">
                                <input type="checkbox" 
                                       name="searchable" 
                                       class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-600">Make tag searchable</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" 
                                       name="featured" 
                                       class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-600">Feature this tag</span>
                            </label>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                        <button type="button" 
                                onclick="closeModal()"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Add Tag
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </body>
    </html>