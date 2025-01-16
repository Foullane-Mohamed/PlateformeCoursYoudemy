<?php
require_once '../config/connection.php';

class Tag
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
        $stmt = $pdo->prepare("INSERT INTO tags (nom) VALUES (:nom)");
        $stmt->bindParam(':nom', $this->nom);
        $stmt->execute();
        $this->id = $pdo->lastInsertId();
    }

    public static function getTagByName($tagName)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM tags WHERE nom = :nom");
        $stmt->bindParam(':nom', $tagName);
        $stmt->execute();
        $tag = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($tag) {
            $tagObject = new Tag($tag['nom']);
            $tagObject->id = $tag['id_tag'];
            return $tagObject;
        }
        return null;
    }

    public static function getAllTags()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM tags");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($newName)
    {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE tags SET nom = :newName WHERE id_tag = :id");
        $stmt->bindParam(':newName', $newName);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $this->nom = $newName;
    }

    public function delete()
    {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM tags WHERE id_tag = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }
}