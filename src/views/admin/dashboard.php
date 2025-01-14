<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
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
                        <i class="fas fa-graduation-cap text-white"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-900">Youdemy</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-8 overflow-y-auto">
                <!-- Main Navigation -->
                <div>
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Main
                    </h3>
                    <div class="mt-4 space-y-1">
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="fas fa-chart-line w-5 h-5"></i>
                            <span class="ml-3">Dashboard</span>
                        </a>
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-users w-5 h-5"></i>
                            <span class="ml-3">Users</span>
                        </a>
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-book w-5 h-5"></i>
                            <span class="ml-3">Courses</span>
                        </a>
                    </div>
                </div>

                <!-- Management Navigation -->
                <div>
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Management
                    </h3>
                    <div class="mt-4 space-y-1">
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-tags w-5 h-5"></i>
                            <span class="ml-3">Tags</span>
                        </a>
                        <a href="#" class="flex items-center justify-between px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <div class="flex items-center">
                                <i class="fas fa-user-check w-5 h-5"></i>
                                <span class="ml-3">Teacher Validation</span>
                            </div>
                            <span class="bg-red-100 text-red-600 px-2.5 py-0.5 rounded-full text-xs font-medium">
                                New
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Settings Navigation -->
                <div>
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Settings
                    </h3>
                    <div class="mt-4 space-y-1">
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-cog w-5 h-5"></i>
                            <span class="ml-3">General</span>
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
                    <img src="https://ui-avatars.com/api/?name=Admin+User" alt="Admin" class="w-8 h-8 rounded-lg">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">Admin User</p>
                        <p class="text-xs text-gray-500 truncate">admin@youdemy.com</p>
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
                        <!-- Left side -->
                        <div class="flex items-center gap-3">
                            <button class="lg:hidden text-gray-500 hover:text-gray-600">
                                <i class="fas fa-bars text-xl"></i>
                            </button>
                            <div class="hidden sm:block">
                                <div class="relative">
                                    <input type="text" 
                                           placeholder="Search courses, users..." 
                                           class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right side -->
                        <div class="flex items-center gap-4">
                            <button class="relative p-2 text-gray-400 hover:text-gray-500">
                                <i class="fas fa-bell"></i>
                                <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500"></span>
                            </button>
                            
                            <!-- Profile Dropdown -->
                            <div class="relative">
                                <button class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-50">
                                    <img src="https://ui-avatars.com/api/?name=Admin+User" alt="Admin" class="w-8 h-8 rounded-lg">
                                    <span class="hidden sm:block font-medium text-sm text-gray-700">Admin</span>
                                    <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6">
                <!-- Welcome Section -->
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-900">Dashboard Overview</h1>
                    <p class="mt-2 text-sm text-gray-600">Monitor and manage your platform's performance.</p>
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
                                12%
                            </span>
                        </div>
                        <h3 class="text-gray-900 font-semibold">Total Students</h3>
                        <p class="text-3xl font-bold text-gray-900 mt-2">3,427</p>
                        <p class="text-sm text-gray-500 mt-2">+350 this month</p>
                    </div>

                    <!-- Total Courses -->
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
                        <h3 class="text-gray-900 font-semibold">Total Courses</h3>
                        <p class="text-3xl font-bold text-gray-900 mt-2">256</p>
                        <p class="text-sm text-gray-500 mt-2">+12 this month</p>
                    </div>

                    <!-- Active Teachers -->
                    <div class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-lg transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center justify-center w-12 h-12 bg-purple-50 text-purple-600 rounded-lg">
                                <i class="fas fa-chalkboard-teacher text-xl"></i>
                            </div>
                            <span class="flex items-center text-green-600 text-sm font-medium">
                                <i class="fas fa-arrow-up mr-1 text-xs"></i>
                                15%
                            </span>
                        </div>
                        <h3 class="text-gray-900 font-semibold">Active Teachers</h3>
                        <p class="text-3xl font-bold text-gray-900 mt-2">82</p>
                        <p class="text-sm text-gray-500 mt-2">+8 this month</p>
                    </div>

                    <!-- Pending Reviews -->
                    <div class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-lg transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center justify-center w-12 h-12 bg-amber-50 text-amber-600 rounded-lg">
                                <i class="fas fa-clock text-xl"></i>
                            </div>
                            <span class="flex items-center text-red-600 text-sm font-medium">
                                <i class="fas fa-arrow-up mr-1 text-xs"></i>
                                4
                            </span>
                        </div>
                        <h3 class="text-gray-900 font-semibold">Pending Reviews</h3>
                        <p class="text-3xl font-bold text-gray-900 mt-2">12</p>
                        <p class="text-sm text-gray-500 mt-2">Action needed</p>
                    </div>
                </div>

                <!-- Teacher Validations Section -->
                <div class="bg-white rounded-xl border border-gray-200 mb-8">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-bold text-gray-900">Pending Teacher Validations</h2>
                            <button class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                View all
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Teacher
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Subject
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Applied Date
                                        </th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <img class="h-10 w-10 rounded-lg" src="https://ui-avatars.com/api/?name=John+Doe" alt="">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">John Doe</div>
                                                    <div class="text-sm text-gray-500">john@example.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Web Development
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending Review
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Jan 14, 2025
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button class="text-green-600 hover:text-green-900 mr-3">
                                                Approve
                                            </button>
                                            <button class="text-red-600 hover:text-red-900">
                                                Reject
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <img class="h-10 w-10 rounded-lg" src="https://ui-avatars.com/api/?name=Sarah+Smith" alt="">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Sarah Smith</div>
                                                    <div class="text-sm text-gray-500">sarah@example.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                                Data Science
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending Review
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Jan 13, 2025
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button class="text-green-600 hover:text-green-900 mr-3">
                                                Approve
                                            </button>
                                            <button class="text-red-600 hover:text-red-900">
                                                Reject
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Course Statistics -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Popular Courses -->
                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-bold text-gray-900">Popular Courses</h2>
                            <div class="relative">
                                <select class="text-sm text-gray-500 border border-gray-300 rounded-lg px-3 py-1.5 pr-8 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option>Last 7 days</option>
                                    <option>Last 30 days</option>
                                    <option>Last 3 months</option>
                                </select>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <!-- Course Item -->
                            <div class="p-4 hover:bg-gray-50 rounded-lg transition-colors">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-medium text-gray-900">Complete Web Development</h3>
                                        <p class="text-sm text-gray-500 mt-1">by John Doe</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-semibold text-gray-900">1,234</p>
                                        <p class="text-sm text-gray-500">students</p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-indigo-600 h-2 rounded-full" style="width: 85%"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Course Item -->
                            <div class="p-4 hover:bg-gray-50 rounded-lg transition-colors">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-medium text-gray-900">Data Science Masterclass</h3>
                                        <p class="text-sm text-gray-500 mt-1">by Sarah Smith</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-semibold text-gray-900">987</p>
                                        <p class="text-sm text-gray-500">students</p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-indigo-600 h-2 rounded-full" style="width: 65%"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Course Item -->
                            <div class="p-4 hover:bg-gray-50 rounded-lg transition-colors">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-medium text-gray-900">Mobile App Development</h3>
                                        <p class="text-sm text-gray-500 mt-1">by Mike Johnson</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-semibold text-gray-900">756</p>
                                        <p class="text-sm text-gray-500">students</p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-indigo-600 h-2 rounded-full" style="width: 45%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category Distribution -->
                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-bold text-gray-900">Category Distribution</h2>
                            <button class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                Download Report
                            </button>
                        </div>
                        <div class="space-y-6">
                            <!-- Category Item -->
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <h3 class="font-medium text-gray-900">Web Development</h3>
                                        <p class="text-sm text-gray-500">45 courses</p>
                                    </div>
                                    <span class="text-lg font-semibold text-gray-900">45%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 h-2 rounded-full" style="width: 45%"></div>
                                </div>
                            </div>

                            <!-- Category Item -->
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <h3 class="font-medium text-gray-900">Data Science</h3>
                                        <p class="text-sm text-gray-500">32 courses</p>
                                    </div>
                                    <span class="text-lg font-semibold text-gray-900">30%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 h-2 rounded-full" style="width: 30%"></div>
                                </div>
                            </div>

                            <!-- Category Item -->
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <h3 class="font-medium text-gray-900">Mobile Development</h3>
                                        <p class="text-sm text-gray-500">28 courses</p>
                                    </div>
                                    <span class="text-lg font-semibold text-gray-900">25%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 h-2 rounded-full" style="width: 25%"></div>
                                </div>
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