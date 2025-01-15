<?php
require_once 'connection.php';

class Category
{
    private $id;
    private $nom;

    public function __construct($nom)
    {
        $this->nom = $nom;
    }

    public function create()
    {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO categories (nom) VALUES (:nom)");
        $stmt->bindParam(':nom', $this->nom);
        $stmt->execute();
        $this->id = $pdo->lastInsertId();
    }

    public static function getCategoryByName($categoryName)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM categories WHERE nom = :nom");
        $stmt->bindParam(':nom', $categoryName);
        $stmt->execute();
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($category) {
            $categoryObject = new Category($category['nom']);
            $categoryObject->id = $category['id_categorie'];
            return $categoryObject;
        }
        return null;
    }

    public static function getAllCategories()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($newName)
    {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE categories SET nom = :newName WHERE id_categorie = :id");
        $stmt->bindParam(':newName', $newName);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $this->nom = $newName;
    }

    public function delete()
    {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM categories WHERE id_categorie = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }
}