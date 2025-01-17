<?php
require_once __DIR__ . '/../config/connection.php';

class Course
{
    protected $id;
    protected $titre;
    protected $description;
    protected $contenu;
    protected $type_contenu;
    protected $id_categorie;
    protected $id_enseignant;
    protected $statut;

    public function __construct($titre, $description, $contenu, $type_contenu, $id_categorie, $id_enseignant, $statut)
    {
        $this->titre = $titre;
        $this->description = $description;
        $this->contenu = $contenu;
        $this->type_contenu = $type_contenu;
        $this->id_categorie = $id_categorie;
        $this->id_enseignant = $id_enseignant;
        $this->statut = $statut;
    }

    public function create()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("INSERT INTO cours (titre, description, contenu, type_contenu, id_categorie, id_enseignant, statut) VALUES (:titre, :description, :contenu, :type_contenu, :id_categorie, :id_enseignant, :statut)");
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

    public function getAllCategories()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT id_categorie, nom FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
