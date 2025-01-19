<?php
require_once __DIR__ . '/../config/connection.php';
require_once __DIR__ . '/User.php';

class Auth
{
    public function register($nom, $email, $password, $role)
    {
        $user = $this->getUserByEmail($email);
        if ($user) {
            return ['error' => 'Cet email est déjà utilisé.'];
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new User($nom, $email, $hashedPassword, $role, 'en_attente');
        
        if ($user->register()) {
            return ['success' => 'Votre compte a été créé avec succès. Veuillez patienter pendant que votre compte est validé.'];
        }
        
        return ['error' => 'Une erreur est survenue lors de la création du compte.'];
    }

    public function login($email, $password)
    {
        $userModel = new User(null, null, null, null, null);
        $user = $userModel->login($email);

        if ($user && password_verify($password, $user['password'])) {
            if ($user['status'] === 'actif' || $user['status'] === 'en_attente') {  // السماح بتسجيل الدخول حتى لو كانت الحالة "en_attente"
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user'] = $user;
                return ['success' => 'Vous êtes maintenant connecté.'];
            } else {
                return ['error' => 'Votre compte est suspendu.'];
            }
        }
        return ['error' => 'Identifiants invalides.'];
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        return ['success' => 'Vous avez été déconnecté avec succès.'];
    }

    private function getUserByEmail($email)
    {
        return User::findByEmail($email);
    }
}