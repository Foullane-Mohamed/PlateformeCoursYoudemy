<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - My Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #f8fafc; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 5px; }
    </style>
</head>
<body class="h-full">
    <div class="min-h-screen bg-gray-50 flex">
        <!-- Sidebar - Same as teacher dashboard -->
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
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-chart-line w-5 h-5"></i>
                            <span class="ml-3">Dashboard</span>
                        </a>
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="fas fa-book w-5 h-5"></i>
                            <span class="ml-3">My Courses</span>
                        </a>
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-users w-5 h-5"></i>
                            <span class="ml-3">Students</span>
                        </a>
                    </div>
                </div>

                <!-- Rest of the sidebar same as teacher dashboard -->
                <!-- ... -->
            </nav>

            <!-- Profile Section -->
            <div class="border-t border-gray-200 p-4">
                <div class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50">
                    <img src="https://ui-avatars.com/api/?name=John+Doe" alt="Teacher" class="w-8 h-8 rounded-lg">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">John Doe</p>
                        <p class="text-xs text-gray-500 truncate">Web Development</p>
                    </div>
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
                                <div class="relative">
                                    <input type="text" 
                                           placeholder="Search your courses..." 
                                           class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <i class="fas fa-plus mr-2"></i>
                                Create New Course
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6">
                <!-- Filters and Sorting -->
                <div class="mb-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">My Courses</h1>
                            <p class="mt-1 text-sm text-gray-600">Manage and track your course content</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option>All Categories</option>
                                <option>Web Development</option>
                                <option>JavaScript</option>
                                <option>React</option>
                                <option>Node.js</option>
                            </select>
                            <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option>Sort by: Recent</option>
                                <option>Most Popular</option>
                                <option>Highest Rated</option>
                                <option>Title A-Z</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Course Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Course Card - Active -->
                    <div class="bg-white rounded-xl border border-gray-200 hover:shadow-lg transition-all">
                        <div class="relative">
                            <img src="/api/placeholder/400/200" alt="Course thumbnail" class="w-full h-48 object-cover rounded-t-xl">
                            <span class="absolute top-4 right-4 px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                Active
                            </span>
                        </div>
                        <div class="p-6">
                            <h3 class="font-semibold text-lg text-gray-900">Advanced JavaScript Course</h3>
                            <p class="text-sm text-gray-600 mt-2">Master modern JavaScript with advanced concepts and real-world projects.</p>
                            <div class="flex items-center gap-4 mt-4">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-users text-gray-400"></i>
                                    <span class="text-sm text-gray-600">342 students</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <span class="text-sm text-gray-600">4.9 (128 reviews)</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mt-6">
                                <span class="text-lg font-bold text-gray-900">$99.99</span>
                                <button class="text-indigo-600 hover:text-indigo-500 font-medium text-sm">
                                    Edit Course
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Course Card - Draft -->
                    <div class="bg-white rounded-xl border border-gray-200 hover:shadow-lg transition-all opacity-75">
                        <div class="relative">
                            <img src="/api/placeholder/400/200" alt="Course thumbnail" class="w-full h-48 object-cover rounded-t-xl">
                            <span class="absolute top-4 right-4 px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">
                                Draft
                            </span>
                        </div>
                        <div class="p-6">
                            <h3 class="font-semibold text-lg text-gray-900">React Performance Optimization</h3>
                            <p class="text-sm text-gray-600 mt-2">Learn advanced techniques to optimize React applications for better performance.</p>
                            <div class="flex items-center gap-4 mt-4">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-clock text-gray-400"></i>
                                    <span class="text-sm text-gray-600">Last edited 2 days ago</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mt-6">
                                <span class="text-lg font-bold text-gray-900">$89.99</span>
                                <button class="text-indigo-600 hover:text-indigo-500 font-medium text-sm">
                                    Continue Editing
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Course Card - Under Review -->
                    <div class="bg-white rounded-xl border border-gray-200 hover:shadow-lg transition-all">
                        <div class="relative">
                            <img src="/api/placeholder/400/200" alt="Course thumbnail" class="w-full h-48 object-cover rounded-t-xl">
                            <span class="absolute top-4 right-4 px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">
                                Under Review
                            </span>
                        </div>
                        <div class="p-6">
                            <h3 class="font-semibold text-lg text-gray-900">Node.js Microservices</h3>
                            <p class="text-sm text-gray-600 mt-2">Build scalable applications with microservices architecture using Node.js</p>
                            <div class="flex items-center gap-4 mt-4">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-clock text-gray-400"></i>
                                    <span class="text-sm text-gray-600">Submitted 1 day ago</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mt-6">
                                <span class="text-lg font-bold text-gray-900">$129.99</span>
                                <button class="text-indigo-600 hover:text-indigo-500 font-medium text-sm">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Add New Course Card -->
                    <div class="bg-gray-50 rounded-xl border border-dashed border-gray-300 hover:border-indigo-500 transition-all cursor-pointer p-6 flex flex-col items-center justify-center min-h-[400px]">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-plus text-2xl text-indigo-600"></i>
                        </div>
                        <h3 class="font-semibold text-lg text-gray-900">Create New Course</h3>
                        <p class="text-sm text-gray-600 text-center mt-2">Start building your next awesome course</p>
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