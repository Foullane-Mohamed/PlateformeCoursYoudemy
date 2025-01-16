<?php
// Use correct paths relative to the models directory
require_once __DIR__ . '/../config/connection.php';
require_once __DIR__ . '/User.php';

class Auth
{
    public static function register($nom, $email, $password, $role)
    {
        $user = self::getUserByEmail($email);
        if ($user) {
            return ['error' => 'Cet email est déjà utilisé.'];
        }

        $user = new User($nom, $email, sha1($password), $role, 'en_attente');
        $user->register();

        return ['success' => 'Votre compte a été créé avec succès. Veuillez patienter pendant que votre compte est validé.'];
    }

    public static function login($email, $password)
    {
        $user = User::login($email, sha1($password));
        if ($user && $user['status'] == 'actif') {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user'] = $user;
            return ['success' => 'Vous êtes maintenant connecté.'];
        } elseif ($user && $user['status'] == 'en_attente') {
            return ['error' => 'Votre compte est en attente de validation.'];
        } else {
            return ['error' => 'Identifiants invalides.'];
        }
    }

    public static function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        return ['success' => 'Vous avez été déconnecté avec succès.'];
    }

    private static function getUserByEmail($email)
    {
        // Implement this method if not already implemented in User class
        return User::findByEmail($email);
    }
}