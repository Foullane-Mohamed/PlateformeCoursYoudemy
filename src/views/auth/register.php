<?php
// register.php

require_once '../../controllers/AuthController.php';

$authController = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $result = $authController->register($username, $email, $password, $role);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/public/css/app.css" rel="stylesheet">
    <title>Inscription</title>
</head>
<body>
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold">Créer un compte</h1>
        <form action="" method="POST" class="mt-5">
            <div>
                <label for="username" class="block">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" required class="border p-2 w-full">
            </div>
            <div class="mt-4">
                <label for="email" class="block">Email</label>
                <input type="email" name="email" id="email" required class="border p-2 w-full">
            </div>
            <div class="mt-4">
                <label for="password" class="block">Mot de passe</label>
                <input type="password" name="password" id="password" required class="border p-2 w-full">
            </div>
            <div class="mt-4">
                <label for="role" class="block">Rôle</label>
                <select name="role" id="role" required class="border p-2 w-full">
                    <option value="student">Étudiant</option>
                    <option value="instructor">Enseignant</option>
                </select>
            </div>
            <button type="submit" class="mt-5 bg-blue-500 text-white p-2">S'inscrire</button>
        </form>
    </div>
</body>
</html>