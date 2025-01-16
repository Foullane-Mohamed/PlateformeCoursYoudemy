<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy My Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
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

                <div>
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Content</h3>
                    <div class="mt-4 space-y-1">
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-plus-circle w-5 h-5"></i>
                            <span class="ml-3">Create Course</span>
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
                    <h1 class="text-2xl font-bold text-gray-900">My Courses</h1>
                    <p class="mt-2 text-sm text-gray-600">Manage your courses and view details.</p>
                </div>

                <!-- Courses List -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Course Card -->
                    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-all">
                        <img src="https://via.placeholder.com/300x200" alt="Course Image" class="w-full h-48 object-cover rounded-t-xl">
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-900">React Fundamentals</h3>
                            <p class="text-gray-600 mt-2">Learn the basics of React and build your first application.</p>
                            <div class="flex items-center mt-4">
                                <span class="text-sm text-gray-500">Tags:</span>
                                <div class="flex space-x-2 ml-2">
                                    <span class="bg-indigo-100 text-indigo-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">React</span>
                                    <span class="bg-indigo-100 text-indigo-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">JavaScript</span>
                                </div>
                            </div>
                            <div class="flex justify-between mt-4">
                                <a href="edit_course.html?id=1" class="text-indigo-600 hover:text-indigo-500">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="text-red-600 hover:text-red-500" onclick="deleteCourse(1)">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Course Card -->
                    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-all">
                        <img src="https://via.placeholder.com/300x200" alt="Course Image" class="w-full h-48 object-cover rounded-t-xl">
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-900">Node.js Mastery</h3>
                            <p class="text-gray-600 mt-2">Master Node.js and build scalable server-side applications.</p>
                            <div class="flex items-center mt-4">
                                <span class="text-sm text-gray-500">Tags:</span>
                                <div class="flex space-x-2 ml-2">
                                    <span class="bg-indigo-100 text-indigo-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Node.js</span>
                                    <span class="bg-indigo-100 text-indigo-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Backend</span>
                                </div>
                            </div>
                            <div class="flex justify-between mt-4">
                                <a href="edit_course.html?id=2" class="text-indigo-600 hover:text-indigo-500">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="text-red-600 hover:text-red-500" onclick="deleteCourse(2)">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
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

        // Function to delete a course
        function deleteCourse(courseId) {
            if (confirm('Are you sure you want to delete this course?')) {
                window.location.href = 'delete_course.php?id=' + courseId;
            }
        }
    </script>
</body>
</html>
