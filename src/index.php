<?php
require_once __DIR__ . '/config/connection.php';
require_once __DIR__ . '/models/Course.php';

// Initialize Course model
$courseModel = new Course();

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$coursesPerPage = 6;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $coursesPerPage;

// Récupérer le nombre total de cours correspondant à la recherche
$totalCourses = $courseModel->getTotalCourses($search);
$totalPages = ceil($totalCourses / $coursesPerPage);

// Récupérer les cours pour la page actuelle
$courses = $courseModel->getAllCoursesWithDetails(null, $search, $coursesPerPage, $offset);








?>

<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Online Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full">
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <div class="bg-indigo-600 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-bold mb-4">Welcome to Youdemy</h1>
              
                    <div class="flex justify-center gap-4">
                        <a href="views/auth/register.php" class="bg-white text-indigo-600 px-6 py-3 rounded-lg font-medium hover:bg-indigo-50">
                            Sign Up 
                        </a>
                        <a href="views/auth/login.php" class="bg-indigo-500 text-white px-6 py-3 rounded-lg font-medium hover:bg-indigo-400">
                            Login
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <form method="GET" action="" class="relative">
                <input
                    type="text"
                    name="search"
                    placeholder="Search courses..."
                    value="<?php echo htmlspecialchars($search); ?>"
                    class="w-full px-4 py-3 pl-12 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
                <i class="fas fa-search absolute left-4 top-4 text-gray-400"></i>
                <button type="submit" class="absolute right-4 top-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-500">
                    Search
                </button>
            </form>
        </div>

        <!-- Course Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <?php if (empty($courses)): ?>
                <div class="text-center py-8">
                    <p class="text-gray-500 text-lg">No courses found.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($courses as $course): ?>
                        <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-2"><?php echo htmlspecialchars($course['titre']); ?></h3>
                                <p class="text-gray-600 mb-4 line-clamp-2"><?php echo htmlspecialchars($course['description']); ?></p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500"><?php echo htmlspecialchars($course['category_name'] ?? 'Uncategorized'); ?></span>
                                    <a 
                                        href="views/etudiant/course_details.php?id=<?php echo $course['id']; ?>"
                                        class="text-indigo-600 hover:text-indigo-500 font-medium text-sm"
                                    >
                                        Learn More
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                    <div class="flex justify-center space-x-2 mt-8">
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="?page=<?php echo $i; ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?>" 
                               class="px-4 py-2 rounded <?php echo $currentPage === $i ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'; ?>">
                                <?php echo $i; ?>
                            </a>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>