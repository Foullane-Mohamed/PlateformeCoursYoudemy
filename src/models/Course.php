<?php
require_once __DIR__ . '/../config/connection.php';

class Course {
    private $id;
    private $titre;
    private $description;
    private $contenu;
    private $type_contenu;
    private $id_categorie;
    private $id_enseignant;
    private $statut;

    public function __construct($titre, $description, $contenu, $type_contenu, $id_categorie, $id_enseignant, $statut = 'brouillon') {
        $this->titre = $titre;
        $this->description = $description;
        $this->contenu = $contenu;
        $this->type_contenu = $type_contenu;
        $this->id_categorie = $id_categorie;
        $this->id_enseignant = $id_enseignant;
        $this->statut = $statut;
    }

    public function create() {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        
        $stmt = $conn->prepare("INSERT INTO cours (titre, description, contenu, type_contenu, id_categorie, id_enseignant, statut) 
                               VALUES (:titre, :description, :contenu, :type_contenu, :id_categorie, :id_enseignant, :statut)");
        
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':contenu', $this->contenu);
        $stmt->bindParam(':type_contenu', $this->type_contenu);
        $stmt->bindParam(':id_categorie', $this->id_categorie);
        $stmt->bindParam(':id_enseignant', $this->id_enseignant);
        $stmt->bindParam(':statut', $this->statut);
        
        $stmt->execute();
        return $conn->lastInsertId();
    }

    public static function getAllCourses() {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        
        $stmt = $conn->query("SELECT * FROM cours");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCourseById($id) {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        
        $stmt = $conn->prepare("SELECT * FROM cours WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}