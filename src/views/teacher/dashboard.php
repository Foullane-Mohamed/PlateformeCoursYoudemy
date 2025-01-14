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
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
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
                        <p class="text-3xl font-bold text-gray-900 mt-2">842</p>
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
                        <p class="text-3xl font-bold text-gray-900 mt-2">12</p>
                        <p class="text-sm text-gray-500 mt-2">2 in draft</p>
                    </div>

                    <!-- Average Rating -->
                    <div class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-lg transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center justify-center w-12 h-12 bg-yellow-50 text-yellow-600 rounded-lg">
                                <i class="fas fa-star text-xl"></i>
                            </div>
                            <span class="flex items-center text-green-600 text-sm font-medium">
                                <i class="fas fa-arrow-up mr-1 text-xs"></i>
                                4.2%
                            </span>
                        </div>
                        <h3 class="text-gray-900 font-semibold">Average Rating</h3>
                        <p class="text-3xl font-bold text-gray-900 mt-2">4.8</p>
                        <p class="text-sm text-gray-500 mt-2">From 235 reviews</p>
                    </div>

                    <!-- Total Revenue -->
                    <div class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-lg transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center justify-center w-12 h-12 bg-green-50 text-green-600 rounded-lg">
                                <i class="fas fa-dollar-sign text-xl"></i>
                            </div>
                            <span class="flex items-center text-green-600 text-sm font-medium">
                                <i class="fas fa-arrow-up mr-1 text-xs"></i>
                                12%
                            </span>
                        </div>
                        <h3 class="text-gray-900 font-semibold">Total Revenue</h3>
                        <p class="text-3xl font-bold text-gray-900 mt-2">$8,425</p>
                        <p class="text-sm text-gray-500 mt-2">+$1,200 this month</p>
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
                        <div class="p-4 hover:bg-gray-50 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-medium text-gray-900">React Fundamentals</h3>
                                        <p class="text-sm text-gray-500 mt-1">256 students</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-semibold text-gray-900">4.7</p>
                                        <div class="flex text-yellow-400 text-sm">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Course Item -->
                            <div class="p-4 hover:bg-gray-50 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-medium text-gray-900">Node.js Mastery</h3>
                                        <p class="text-sm text-gray-500 mt-1">178 students</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-semibold text-gray-900">4.8</p>
                                        <div class="flex text-yellow-400 text-sm">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Reviews -->
                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-bold text-gray-900">Recent Reviews</h2>
                            <button class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                View all
                            </button>
                        </div>
                        <div class="space-y-6">
                            <!-- Review Item -->
                            <div class="space-y-3">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Alex+Johnson" alt="" class="w-10 h-10 rounded-full">
                                        <div>
                                            <h3 class="font-medium text-gray-900">Alex Johnson</h3>
                                            <p class="text-sm text-gray-500">Advanced JavaScript</p>
                                        </div>
                                    </div>
                                    <div class="flex text-yellow-400 text-sm">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600">"Great course! The instructor explains complex concepts in a very clear way. Highly recommended!"</p>
                            </div>

                            <!-- Review Item -->
                            <div class="space-y-3">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Sarah+Williams" alt="" class="w-10 h-10 rounded-full">
                                        <div>
                                            <h3 class="font-medium text-gray-900">Sarah Williams</h3>
                                            <p class="text-sm text-gray-500">React Fundamentals</p>
                                        </div>
                                    </div>
                                    <div class="flex text-yellow-400 text-sm">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600">"The content is very comprehensive and well-structured. Looking forward to the advanced course!"</p>
                            </div>

                            <!-- Review Item -->
                            <div class="space-y-3">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Mike+Brown" alt="" class="w-10 h-10 rounded-full">
                                        <div>
                                            <h3 class="font-medium text-gray-900">Mike Brown</h3>
                                            <p class="text-sm text-gray-500">Node.js Mastery</p>
                                        </div>
                                    </div>
                                    <div class="flex text-yellow-400 text-sm">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600">"Excellent course with practical examples. The project-based approach really helped me understand the concepts."</p>
                            </div>
                        </div>
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