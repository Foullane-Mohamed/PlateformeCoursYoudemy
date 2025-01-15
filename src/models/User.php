<?php
require_once 'connection.php';

class User
{
    private $id;
    private $nom;
    private $email;
    private $password;
    private $role;
    private $status;

    public function __construct($nom, $email, $password, $role, $status)
    {
        $this->nom = $nom;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->status = $status;
    }

    public function register()
    {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, password, role, status) VALUES (:nom, :email, :password, :role, :status)");
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':status', $this->status);
        $stmt->execute();
    }

    public static function login($email, $password)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
}