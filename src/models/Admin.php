<?php
require_once '../config/Connection.php';
require_once 'User.php';

class Admin extends User
{
    public function validateTeacher($userId)
    {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE utilisateurs SET status = 'actif' WHERE id = :userId AND role = 'enseignant'");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
    }

    public function suspendUser($userId)
    {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE utilisateurs SET status = 'inactif' WHERE id = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
    }

    public function deleteUser($userId)
    {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
    }

    public function getAllUsers()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM utilisateurs");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



}