<?php
// users.php - Admin view for managing users

require_once '../../controllers/AdminController.php';

$adminController = new AdminController();
$users = $adminController->getAllUsers();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/app.css">
    <title>Gestion des Utilisateurs</title>
</head>
<body>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold my-4">Gestion des Utilisateurs</h1>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border-b-2 border-gray-300 px-4 py-2">ID</th>
                    <th class="border-b-2 border-gray-300 px-4 py-2">Nom</th>
                    <th class="border-b-2 border-gray-300 px-4 py-2">Email</th>
                    <th class="border-b-2 border-gray-300 px-4 py-2">Rôle</th>
                    <th class="border-b-2 border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="border-b border-gray-300 px-4 py-2"><?php echo htmlspecialchars($user['id']); ?></td>
                        <td class="border-b border-gray-300 px-4 py-2"><?php echo htmlspecialchars($user['name']); ?></td>
                        <td class="border-b border-gray-300 px-4 py-2"><?php echo htmlspecialchars($user['email']); ?></td>
                        <td class="border-b border-gray-300 px-4 py-2"><?php echo htmlspecialchars($user['role']); ?></td>
                        <td class="border-b border-gray-300 px-4 py-2">
                            <a href="edit.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="text-blue-500">Modifier</a>
                            <a href="delete.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="text-red-500">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>