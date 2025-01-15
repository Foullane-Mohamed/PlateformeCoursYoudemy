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

    public function getAllCategories()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCategory($categoryName)
    {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO categories (nom) VALUES (:categoryName)");
        $stmt->bindParam(':categoryName', $categoryName);
        $stmt->execute();
    }

    public function getAllTags()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM tags");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTag($tagName)
    {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO tags (nom) VALUES (:tagName)");
        $stmt->bindParam(':tagName', $tagName);
        $stmt->execute();
    }
}