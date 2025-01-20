<?php
session_start();

require_once __DIR__ . '/../../config/connection.php';
require_once __DIR__ . '/../../models/Admin.php';
require_once __DIR__ . '/../../models/Course.php';
require_once __DIR__ . '/../../models/Category.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$message = '';
$messageType = '';

// Handle course status updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
  $courseId = $_POST['course_id'];
  $status = $_POST['status'];
  $courseModel = new Course(null, null, null, null, null, null, null);
  $result = $courseModel->updateCourseStatus($courseId, $status);
  if ($result) {
    $message = "Statut du cours mis à jour avec succès";
    $messageType = 'success';
  } else {
    $message = "Erreur lors de la mise à jour du statut du cours";
    $messageType = 'error';
  }
}

try {
  $admin = new Admin(
    $_SESSION['user']['nom'],
    $_SESSION['user']['email'],
    '',
    'admin',
    'actif'
  );

  $allUsers = $admin->getAllUsers();
  $totalStudents = count(array_filter($allUsers, function ($user) {
    return $user['role'] === 'etudiant';
  }));

  $totalTeachers = count(array_filter($allUsers, function ($user) {
    return $user['role'] === 'enseignant';
  }));

  $activeTeachers = count(array_filter($allUsers, function ($user) {
    return $user['role'] === 'enseignant' && $user['status'] === 'actif';
  }));

  $pendingTeachers = count(array_filter($allUsers, function ($user) {
    return $user['role'] === 'enseignant' && $user['status'] === 'en_attente';
  }));

  $pendingValidations = array_filter($allUsers, function ($user) {
    return $user['role'] === 'enseignant' && $user['status'] === 'en_attente';
  });

  $categories = Category::getAllCategoriesWithStats();

  // Fetch only inactive courses
  $courseModel = new Course(null, null, null, null, null, null, null);
  $inactiveCourses = $courseModel->getCoursesByStatus('inactif');
} catch (Exception $e) {
  die("Erreur: " . $e->getMessage());
}

if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
  $messageType = $_SESSION['messageType'];
  unset($_SESSION['message']);
  unset($_SESSION['messageType']);
}
?>
<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-100">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de Bord Administrateur - Youdemy</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body class="h-full">
  <div class="min-h-full">
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-200 fixed w-full z-30 top-0">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <!-- Logo et liens de navigation -->
          <div class="flex">
            <div class="flex-shrink-0 flex items-center">
              <h2 class="text-xl ">Youdemy</h2>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
              <a href="#" class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                <i class="fas fa-chart-line mr-2"></i>
                Tableau de Bord
              </a>
          
              <a href="all_courses.php" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200">
                <i class="fas fa-graduation-cap mr-2"></i>
                Tous les Cours
              </a>
            
              <a href="gestionTag.php" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200">
                <i class="fas fa-folder mr-2"></i>
                Tags
              </a>
            </div>
          </div>

          <!-- Section droite avec recherche, notifications et profil -->
          <div class="hidden sm:ml-6 sm:flex sm:items-center">
        

          

            <!-- Menu profil -->
            <div class="ml-3 relative">
              <div class="flex items-center">
                <button type="button" class="bg-white flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 items-center" id="user-menu-button" aria-expanded="false" aria-haspopup="true" onclick="toggleProfileDropdown()">
                  <span class="sr-only">Open user menu</span>
                  <img class="h-8 w-8 rounded-full object-cover border-2 border-gray-200" src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user']['nom']); ?>&background=random" alt="">
                  <span class="ml-2 text-gray-700 font-medium"><?php echo htmlspecialchars($_SESSION['user']['nom']); ?></span>
                  <i class="fas fa-chevron-down ml-2 text-gray-400"></i>
                </button>
              </div>
              <!-- Menu déroulant du profil -->
              <div id="profile-dropdown" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu">
                <!-- <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                  <i class="fas fa-user mr-2"></i>
                  Mon Profil
                </a>
               -->
                <hr class="my-1">
                                  <a href="../auth/logout.php" class="block px-4 py-2 text-sm text-red-700 hover:bg-red-50" role="menuitem" onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?');">
                      <i class="fas fa-sign-out-alt mr-2"></i>
                      Déconnexion
                  </a>
              </div>
            </div>
          </div>

          <!-- Bouton menu mobile -->
          <div class="flex items-center sm:hidden">
            <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false" onclick="toggleMobileMenu()">
              <span class="sr-only">Open main menu</span>
              <i class="fas fa-bars text-xl"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Menu mobile -->
      <div class="sm:hidden hidden" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
          <a href="#" class="bg-indigo-50 border-indigo-500 text-indigo-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
            <i class="fas fa-chart-line mr-2"></i>
            Tableau de Bord
          </a>
        
          <a href="all_courses.php" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
            <i class="fas fa-graduation-cap mr-2"></i>
            Tous les Cours
          </a>
        
        </div>
        <div class="pt-4 pb-3 border-t border-gray-200">
          <div class="flex items-center px-4">
            <div class="flex-shrink-0">
              <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user']['nom']); ?>&background=random" alt="">
            </div>
            <div class="ml-3">
              <div class="text-base font-medium text-gray-800"><?php echo htmlspecialchars($_SESSION['user']['nom']); ?></div>
              <div class="text-sm font-medium text-gray-500"><?php echo htmlspecialchars($_SESSION['user']['email']); ?></div>
            </div>
          </div>
          <div class="mt-3 space-y-1">
            <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
              <i class="fas fa-user mr-2"></i>
              Mon Profil
            </a>
            <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
              <i class="fas fa-cog mr-2"></i>
              Paramètres
            </a>
            <a href="../auth/logout.php" class="block px-4 py-2 text-base font-medium text-red-600 hover:text-red-800 hover:bg-red-50" onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?');">
              <i class="fas fa-sign-out-alt mr-2"></i>
              Déconnexion
            </a>
          </div>
        </div>
      </div>
    </nav>

<!-- En-tête -->
<header class="bg-white shadow mt-16">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">Tableau de Bord</h1>
      </div>
    </header>

    <!-- Contenu principal -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <!-- Alert Message -->
      <?php if ($message): ?>
        <div class="mb-4 rounded-md p-4 <?php echo $messageType === 'success' ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800'; ?>">
          <?php echo htmlspecialchars($message); ?>
        </div>
      <?php endif; ?>

      <!-- Cartes statistiques -->
      <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Étudiants -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
          <div class="p-5">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="rounded-md bg-indigo-500 p-3">
                  <i class="fas fa-users text-white"></i>
                </div>
              </div>
              <div class="ml-5 w-0 flex-1">
                <dl>
                  <dt class="text-sm font-medium text-gray-500 truncate">Total Étudiants</dt>
                  <dd class="text-lg font-semibold text-gray-900"><?php echo $totalStudents; ?></dd>
                </dl>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
              <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Voir tous</a>
            </div>
          </div>
        </div>

        <!-- Enseignants -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
          <div class="p-5">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="rounded-md bg-green-500 p-3">
                  <i class="fas fa-chalkboard-teacher text-white"></i>
                </div>
              </div>
              <div class="ml-5 w-0 flex-1">
                <dl>
                  <dt class="text-sm font-medium text-gray-500 truncate">Enseignants Actifs</dt>
                  <dd class="text-lg font-semibold text-gray-900"><?php echo $activeTeachers; ?></dd>
                </dl>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
              <a href="allEnseignement.php" class="font-medium text-green-600 hover:text-green-500">Voir tous</a>
            </div>
          </div>
        </div>

        <!-- Validations en attente -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
          <div class="p-5">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="rounded-md bg-yellow-500 p-3">
                  <i class="fas fa-clock text-white"></i>
                </div>
              </div>
              <div class="ml-5 w-0 flex-1">
                <dl>
                  <dt class="text-sm font-medium text-gray-500 truncate">En Attente</dt>
                  <dd class="text-lg font-semibold text-gray-900"><?php echo $pendingTeachers; ?></dd>
                </dl>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
              <a href="allEnseignement.php" class="font-medium text-yellow-600 hover:text-yellow-500">Voir tous</a>
            </div>
          </div>
        </div>

        <!-- Total Enseignants -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
          <div class="p-5">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="rounded-md bg-purple-500 p-3">
                  <i class="fas fa-user-tie text-white"></i>
                </div>
              </div>
              <div class="ml-5 w-0 flex-1">
                <dl>
                  <dt class="text-sm font-medium text-gray-500 truncate">Total Enseignants</dt>
                  <dd class="text-lg font-semibold text-gray-900"><?php echo $totalTeachers; ?></dd>
                </dl>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
              <a href="allEnseignement.php" class="font-medium text-purple-600 hover:text-purple-500">Voir tous</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Section des cours inactifs -->
      <div class="mt-8">
        <div class="bg-white shadow rounded-lg">
          <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <div class="flex items-center">
              <i class="fas fa-book text-red-500 text-xl mr-3"></i>
              <h3 class="text-lg leading-6 font-medium text-gray-900">Cours Inactifs</h3>
            </div>
            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
              <?php echo count($inactiveCourses); ?> cours inactifs
            </span>
          </div>
          <div class="border-t border-gray-200">
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enseignant</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <?php foreach ($inactiveCourses as $course): ?>
                    <tr class="hover:bg-gray-50">
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($course['titre']); ?></div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?php echo htmlspecialchars($course['description']); ?></div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?php echo htmlspecialchars($course['enseignant_nom']); ?></div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                          <?php echo htmlspecialchars($course['statut']); ?>
                        </span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <form method="POST" class="inline-flex space-x-2">
                          <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                          <button type="submit" name="status" value="actif"
                            class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <i class="fas fa-check mr-2"></i>
                            Activer
                          </button>
                          <button type="submit" name="status" value="brouillon"
                            class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            <i class="fas fa-pencil-alt mr-2"></i>
                            Brouillon
                          </button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script>
    function toggleProfileDropdown() {
      const dropdown = document.getElementById('profile-dropdown');
      dropdown.classList.toggle('hidden');
    }

    function toggleMobileMenu() {
      const mobileMenu = document.getElementById('mobile-menu');
      mobileMenu.classList.toggle('hidden');
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
      const profileDropdown = document.getElementById('profile-dropdown');
      const profileButton = document.getElementById('user-menu-button');

      if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
        profileDropdown.classList.add('hidden');
      }
    });

    // Search functionality
    const searchInput = document.getElementById('search');
    if (searchInput) {
      searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        // Add your search logic here
      });
    }

  // Add smooth transition for alerts
  const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
      setTimeout(() => {
        alert.classList.add('opacity-0');
        setTimeout(() => {
          alert.remove();
        }, 300);
      }, 3000);
    });
  </script>
</body>
</html>