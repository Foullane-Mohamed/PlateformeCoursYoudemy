<?php
require_once __DIR__ . '/../config/connection.php';

class Tag
{
    public $id; // تم تعديل الخاصية لتكون عامة
    protected $nom;

    public function __construct($nom)
    {
        $this->nom = $nom;
    }

    public function create()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("INSERT INTO tags (nom) VALUES (:nom)");
        $stmt->bindParam(':nom', $this->nom);
        $stmt->execute();

        return $conn->lastInsertId();
    }

    public static function getTagByName($nom)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM tags WHERE nom = :nom");
        $stmt->bindParam(':nom', $nom);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllTags()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT id_tag, nom FROM tags");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
