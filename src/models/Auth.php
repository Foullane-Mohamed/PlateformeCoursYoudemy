<?php
require_once 'connection.php';
require_once 'User.php';

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
            session_start();
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
  
        session_start();
        session_destroy();
        return ['success' => 'Vous avez été déconnecté avec succès.'];
    }

}